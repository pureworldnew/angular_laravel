<?php namespace App\BokaKanot;


use App\BokaKanot\Billing\KlarnaAdminNotifierBookingDetailsAbstract;
use App\BokaKanot\Interfaces\KlarnaBillingInterface;
use App\BokaKanot\Interfaces\BillingNotifierInterface;
use App\BokaKanot\Interfaces\KlarnaDatabaseInterface;
use Klarna\XMLRPC\Flags;

class Klarna
{
    public $klarnaDatabase;
    /**
     * @var KlarnaService
     */
    public $klarnaService;
    /**
     * @var BillingNotifier
     */
    private $billingNotifier;

    public function __construct(KlarnaDatabaseInterface $klarnaDatabase, KlarnaBillingInterface $klarnaService, BillingNotifierInterface $billingNotifier)
    {
        $this->klarnaDatabase = $klarnaDatabase;
        $this->klarnaService = $klarnaService;
        $this->billingNotifier = $billingNotifier;
    }

    public function returnAmount($invoiceUniqueId, $invoiceId, $discountAmount, $vat, $discountDescription)
    {
        $klarnaReturnAmountService = $this->klarnaService->returnAmount($invoiceId, $discountAmount, $vat, $discountDescription);

        if(!$klarnaReturnAmountService['error'])
        {

            if($this->klarnaDatabase->updateInvoiceRecord($invoiceUniqueId, $discountAmount, $discountDescription, $vat))
            {
                return $klarnaReturnAmountService;
            }
            else
            {
                return [
                    'error' => true,
                    'exception' => "Error updating database",
                    'response' => ""
                ];
            }
        }
        else
        {
            return $klarnaReturnAmountService;
        }
    }

    public function confirmBooking($orderId, $bookingId, KlarnaAdminNotifierBookingDetailsAbstract $klarnaAdminNotifierBookingDetails, $sendEmail = true )
    {

        $order = $this->klarnaService->retrieveCheckout($orderId);

        $klarnaAdminNotifierBookingDetails->email = $order['billing_address']['email'];

        $klarnaSnippet = "";

        //dd($orderId, $order['reservation'], $bookingId);

        if ($order['status'] == "checkout_complete") {

            //dd($order, $orderId, $order['reservation'], $bookingId);
            //echo "<h3>Saving to Database</h3>";

            $this->klarnaDatabase->saveKlarnaOrderIdReservationId($orderId, $order['reservation'], $bookingId, $order['cart_update_allowed']);

            //dd(strpos($_SERVER['HTTP_HOST'], 'localhost'));

            /*if(!strpos($_SERVER['HTTP_HOST'], 'localhost') > -1)
            {
                */
            if($sendEmail)
                $this->billingNotifier->notifyAdmin($klarnaAdminNotifierBookingDetails);
            //}


            $this->klarnaService->notifyKlarnaOrderStatus($order);

            //$klarnaSnippet = $order['gui']['snippet'];

            return $order;
        }

    }

    public function activateBooking ($bookingId)
    {

        $reservationNumber = $this->klarnaDatabase->getReservationNumber($bookingId);

        $this->klarnaDatabase->updateStatus($bookingId, 3);

        $invoiceId = $this->klarnaService->activateOrder($reservationNumber);

        $totalInvoiced = $this->klarnaDatabase->getTotalForMainInvoiceInvoice($bookingId);

        $bookingInvoiceId = $this->klarnaDatabase->updateBookingInvoiceId($invoiceId, $reservationNumber, $totalInvoiced);

        $this->klarnaDatabase->updateBookingProductInvoiceIdStatus($bookingId, $bookingInvoiceId);


    }

    public function refundProduct($quantity, $invoice, $productid, $bookingId, $bookingProductId)
    {
        
        $refundResponse = $this->klarnaService->refundOrderProduct($quantity, $invoice->invoice_id, $productid);

        if($refundResponse) {

            $this->klarnaDatabase->updateOrderProducts_Status(4, $productid, $bookingId, $bookingProductId);

            if($this->klarnaDatabase->checkIfAllProductsOnInvoiceAreRemoved($invoice->id))
            {

                $this->klarnaDatabase->cancelInvoice($invoice->id);
            }
            else
            {
                $this->klarnaDatabase->removeFromInvoice($invoice->id, $bookingProductId);
            }
        }

        //$this->klarnaDatabase->updateMainStatus($bookingId, 4);

        return true;
    }

    public function activateAProduct($productId, $reservationId, $bookingId, $quantity, $bookingProductId, $price)
    {
        
        $invoiceId = $this->klarnaService->activateOrderProduct($reservationId, $productId, $quantity);

        if($invoiceId) {
            $this->klarnaDatabase->updateOrderProducts_InvoiceNo($bookingId, $productId, $invoiceId, $bookingProductId, $price);
        }

        $this->klarnaDatabase->updateMainStatus($bookingId, 3);
    }

    public function activateSelectedProducts ($selectedActivateProducts, $reservationId, $bookingId)
    {
        //dd($selectedActivateProducts, $reservationId, $bookingId);

        $selectedProductIds = $this->klarnaService->getSelectedProductIdsFromCommaList($selectedActivateProducts);

        $invoiceId = $this->klarnaService->activateOrderProducts($reservationId, $selectedProductIds);

        if($invoiceId) {

            foreach(explode(",", $selectedActivateProducts) as $product)
            {

                $productSplit = explode ("|", $product);
                $this->klarnaDatabase->updateOrderProducts_InvoiceNo($bookingId, $productSplit[0], $invoiceId);
            }

            $this->klarnaDatabase->updateMainStatus($bookingId, 3);
        }

    }

    public function refundSelectedProducts ($selectedCancelProducts, $bookingId) {

        /* "5|5|41603632393481671"
        "153"*/
        $selectedProductsByInvoice = $this->klarnaService->selectedProductsByInvoice($selectedCancelProducts);

        foreach($selectedProductsByInvoice as $key => $selectedProductsByInvoice)
        {
            $invoiceId = $this->klarnaService->refundOrderProducts($key, $selectedProductsByInvoice);
        }

        if($invoiceId) {

            foreach(explode(",", $selectedCancelProducts) as $product)
            {
                $productSplit = explode ("|", $product);

                $this->klarnaDatabase->updateOrderProducts_Status(4, $productSplit[0], $bookingId);
            }


        }

        $this->klarnaDatabase->updateMainStatus($bookingId, 4);

    }

    public function refundBooking ($bookingId) {

        /* "5|5|41603632393481671"
        "153"*/
        $selectedProductsByInvoice = $this->klarnaService->selectedProductsByInvoice($selectedCancelProducts);

        foreach($selectedProductsByInvoice as $key => $selectedProductsByInvoice)
        {
            $invoiceId = $this->klarnaService->refundOrderProducts($key, $selectedProductsByInvoice);
        }

        if($invoiceId) {

            foreach(explode(",", $selectedCancelProducts) as $product)
            {
                $productSplit = explode ("|", $product);

                $this->klarnaDatabase->updateOrderProducts_Status(4, $productSplit[0], $bookingId);
            }


        }

        $this->klarnaDatabase->updateMainStatus($bookingId, 4);

    }

    public function cancel ($bookingId, $updateDB = true)
    {
        $reservationNumber = $this->klarnaDatabase->getReservationNumber($bookingId);

        $this->klarnaService->cancel($reservationNumber);

        if($updateDB)
        {
            $this->klarnaDatabase->updateMainStatus($bookingId, 4);
            $this->klarnaDatabase->updateOrderProducts_Status(4, 0, $bookingId);
        }

    }

    public function credit ($bookingId, $invId, $updateDB = true)
    {

        $this->klarnaService->credit($invId);

        if($updateDB)
        {
            $this->klarnaDatabase->updateStatus($bookingId, 5);
            $this->klarnaDatabase->updateActiveBookingProducts($bookingId, 5);
        }

        //$this->session->set_flashdata('adminMessage', 'Order credited');

        
    }

    public function updateCart($klarnaReservationId, $orderId, $bookingProducts, $bookingAddress = false, $bookingFee = 0)
    {
        return $this->klarnaService->updateOrder($klarnaReservationId, $orderId, $bookingProducts, $bookingAddress, $bookingFee);

        return $response = [
            'error' => false,
            'exception' => null,
            'response' => ""
        ];
    }
    
    public function removeProductFromCart($klarnaReservationId, $orderId, $bookingProducts, $bookingProductId, $bookingAddress = false, $bookingFee = 0)
    {
        $response = $this->updateCart($klarnaReservationId, $orderId, $bookingProducts, $bookingAddress, $bookingFee);

        if(!$response['error'])
        {
            $this->klarnaDatabase->softDeleteBookingProduct($bookingProductId);
        }
        
        return $response;
    }

}