<?php namespace App\BokaKanot;

use App\BokaKanot\Interfaces\KlarnaDatabaseInterface;
use App\BokaKanot\Repositories\BookingRepository;
use App\BookingInvoice;
use App\BookingProduct;
use App\Booking;
use Illuminate\Support\Facades\DB;

class KlarnaDatabase implements KlarnaDatabaseInterface
{
    /**
     * @var BookingRepository
     */
    private $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function getReservationNumber($bookingId)
    {
        $query = "SELECT b.klarna_reservationId as reservationNumber from bookings b where id = :bookingId";

        return DB::select($query, ['bookingId' => $bookingId])[0]->reservationNumber;
    }
    
    public function updateInvoiceRecord($invoiceUniqueId, $discountAmount, $discountDescription, $vat)
    {
        return BookingInvoice::where('id', $invoiceUniqueId)
            ->increment('discounted_amount',$discountAmount,[ 'discounted'=> 1, 'discounted_reason' => $discountDescription]);

    }

    public function updateStatus($bookingId, $status)
    {

        Booking::where('id', $bookingId)
            ->update(['status' => $status]);
    }

    public function updateCustomerDetails($bookingId, $street_address, $postal_code, $city, $country, $email, $phone)
    {
        if($country == "se")
        {
            $countryId = 1;
        }
        else if($country == "en")
        {
            $countryId = 2;
        }
        else if($country == "de")
        {
            $countryId = 3;
        }
        else
        {
            $countryId = 0;
        }
        Booking::where('id', $bookingId)
            ->update(["address" => $street_address, "post_code" => $postal_code, "city" => $city,
                "country" => $countryId,
                "email" => $email,
                "telephone" => $phone]);
    }

    public function saveKlarnaOrderIdReservationId($orderId, $reservationId, $bookingId, $cartUpdateAllowed){

        return $this->bookingRepository->updateKlarnaOrderReservationIds($orderId, $reservationId, $bookingId, $cartUpdateAllowed);

    }

    public function updateBookingProductInvoiceIdStatus($bookingId, $bookingInvoiceId) {

         BookingProduct::where('booking_id', $bookingId)
            ->where('booking_invoice_id', null)
            ->update(['booking_invoice_id' => $bookingInvoiceId, 'klarna_product_status' => 3]);
    }

    public function getTotalForMainInvoiceInvoice($bookingId){

        $booking = $this->bookingRepository->getDetails($bookingId);
        $totalPrice = 0;

        foreach ($booking->products as $product)
        {
            if($product->isNew() AND $product->pivot->booking_invoice_id == null)
            {
                $totalPrice = $totalPrice + ($product->pivot->price);
            }
            //dd($product->isNew(), $product->pivot->booking_invoice_id, $totalPrice);
        }

        return $totalPrice;
    }

    public function checkIfAllProductsOnInvoiceAreRemoved($invoiceIdentifier)
    {
        //select from booking_product where booking_invoice_id = $invoiceId
        $bookingProducts = BookingProduct::where('booking_invoice_id', $invoiceIdentifier)->get();

        $allRemoved = true;

        foreach($bookingProducts as $bookingProduct)
        {
            if($bookingProduct->klarna_product_status == Config('booking.status.NEW') or $bookingProduct->klarna_product_status == Config('booking.status.PAID') or $bookingProduct->klarna_product_status == Config('booking.status.ACTIVATED'))
            {
                $allRemoved = false;
            }
        }
        return $allRemoved;
    }

    /*
     * Removes the amount of the removed product from the invoice that the product is on. This is necessary because there could be many products on an invoice
     * if the main activate button is used (as opposed to the activate product button).
     */
    public function removeFromInvoice($invoiceIdentifier, $bookingProductId)
    {
        $bookingProduct = BookingProduct::withTrashed()->find($bookingProductId);
        $invoice = BookingInvoice::find($invoiceIdentifier);
        
        $invoice->partiallyRefundAmount($bookingProduct->price);
    }

    public function updateBookingInvoiceId($invoiceId, $reservationNumber, $totalInvoiced){

        $bookingInvoice = BookingInvoice::create(['invoice_id' => $invoiceId, "amount" => $totalInvoiced]);

        Booking::where('klarna_reservationId', $reservationNumber)
            ->update(['booking_invoice_id' => $bookingInvoice->id]);

        return $bookingInvoice->id;
    }

    public function updateOrderProducts_Status($status, $productid, $bookingId, $bookingProductId)
    {
        if($productid == 0)
        {
            BookingProduct::where('booking_id', $bookingId)
                ->update(['klarna_product_status' => $status]);
        }
        else
        {
            BookingProduct::where('id', $bookingProductId)
                ->update(['klarna_product_status' => $status]);
        }
    }

    public function cancelInvoice($invoiceIdentifier)
    {
        BookingInvoice::find($invoiceIdentifier)->cancelInvoice();
    }
    
    public function updateMainStatus($bookingId, $status)
    {
        if($this->canBeActivated($bookingId) AND $status == 3)
        {
            $this->updateStatus($bookingId, $status);
        }

        if($this->canBeCancelled($bookingId) AND $status == 4)
        {

            $this->updateStatus($bookingId, $status);
        }

    }

    public function canBeActivated($bookingId)
    {
        $query = "SELECT bp.id from booking_product bp where booking_id = :bookingId and klarna_product_status < 3";
        //dd($query);
        //var_dump( empty(DB::select($query, ['bookingId' => $bookingId])));
        /*dd(DB::select($query, ['bookingId' => $bookingId]));
        dd( empty(DB::select($query, ['bookingId' => $bookingId])));*/
        return empty(DB::select($query, ['bookingId' => $bookingId]));

    }

    public function canBeCancelled($bookingId)
    {
        $query = "SELECT bp.id, bp.klarna_product_status from booking_product bp where booking_id = :bookingId and klarna_product_status < 5";

       // dd(!empty(DB::select($query, ['bookingId' => $bookingId])));
//dd(!empty(DB::select($query, ['bookingId' => $bookingId])));
        return !empty(DB::select($query, ['bookingId' => $bookingId]));

    }

    public function updateOrderProducts_InvoiceNo($bookingId, $productId, $invoiceId, $bookingProductId, $price)
    {
        $bookingInvoice = BookingInvoice::create(['invoice_id' => $invoiceId, 'amount' => $price]);
        $bookingInvoiceId = $bookingInvoice->id;

        //Unset main invoice number to recheck after setting the new one below:
        Booking::where('id', $bookingId)
            ->update(['booking_invoice_id' => null]);



        BookingProduct::where('id', $bookingProductId)
            ->update(['booking_invoice_id' => $bookingInvoice->id, 'klarna_product_status' => 3]);

        //Are all products now activated? With the same Invoice number if so write that invoice number into the main booking record
        if(BookingProduct::where('booking_id', $bookingId)
            ->where(function($query) use($invoiceId, $bookingInvoiceId) {
                $query->where('booking_invoice_id', "<>", $bookingInvoiceId);
                $query->where('klarna_product_status', 3);
            })
            ->count() == 0)
        {
            Booking::where('id', $bookingId)
                ->update(['booking_invoice_id' => $bookingInvoiceId]);
        }
    }

    public function updateActiveBookingProducts($bookingId, $status)
    {

        BookingProduct::where('booking_id', $bookingId)
            ->where('klarna_product_status', "<", 4)
            ->update(['klarna_product_status' => $status]);


    }

    public function softDeleteBookingProduct ($productId){

        BookingProduct::where('product_id', $productId)
            ->update(['klarna_product_status' => 4 ]);
    }

}