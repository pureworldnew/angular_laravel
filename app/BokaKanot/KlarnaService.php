<?php namespace App\BokaKanot;
//require_once("Klarna/Checkout.php");

//require '../vendor/autoload.php';
use App\BokaKanot\Interfaces\KlarnaBillingInterface;

use App\BokaKanot\Klarna\KlarnaAddr;
use Klarna\XMLRPC\Address;
use Klarna_Checkout_Connector;
use Klarna_Checkout_Order;
use Klarna\XMLRPC\Klarna as KlarnaOrderManagement;
use Klarna\XMLRPC\Country;
use Klarna\XMLRPC\Language;
use Klarna\XMLRPC\Currency;
use Klarna\XMLRPC\Flags;
use Mockery\CountValidator\Exception;


/**
 * @property  klarnaLanguage
 */
class KlarnaService implements KlarnaBillingInterface
{
    private $checkout_uri;
    private $confirmation_uri;
    private $push_uri;
    private $terms_uri;
    private $EID;
    private $klarnaLanguage;
    private $klarnaLocale;
    private $klarnaUrl;

    public function __construct($params)
    {
        $this->EID = $params['EID'];
        $this->checkout_uri = $params['checkout_uri'];
        $this->confirmation_uri = $params['confirmation_uri'];
        $this->push_uri = $params['push_uri'];
        $this->terms_uri = $params['terms_uri'];
        $this->sharedSecret = $params['sharedSecret'];
        $this->klarnaLanguage = $this->setLanguage($params['language']);
        $this->klarnaLocale = $this->setLocale($params['language']);

        if($params['testMode'] == true)
        {
            $this->klarnaUrl = Klarna_Checkout_Connector::BASE_TEST_URL;
            $this->klarnaOrderManagementMode = KlarnaOrderManagement::BETA;
        }
        else
        {
            $this->klarnaUrl = Klarna_Checkout_Connector::BASE_URL;
            $this->klarnaOrderManagementMode = KlarnaOrderManagement::LIVE;
        }


        $this->KlarnaOrderManagement = new KlarnaOrderManagement();

        $this->KlarnaOrderManagement->config(
            $this->EID,                    // Merchant ID
            $this->sharedSecret,       // Shared secret
            Country::SE,    // Purchase country
            $this->klarnaLanguage,   // Purchase language
            Currency::SEK,  // Purchase currency
            $this->klarnaOrderManagementMode,         // Server  Klarna::LIVE
            'json',               // PClass storage
            './pclasses.json'     // PClass storage URI path
        );

    }

    public function returnAmount($invoiceNo, $discountAmount, $vat, $description)
    {
        try {
            $response = $this->KlarnaOrderManagement->returnAmount($invoiceNo, $discountAmount, $vat, Flags::INC_VAT, $description);

            return [
                'error' => false,
                'exception' => null,
                'response' => $response
            ];

        }
        catch(\Exception $e)
        {
            return [
                'error' => true,
                'exception' => $e,
                'response' => ""
            ];

        }

    }

    public function updateOrder($klarnaReservationId, $klarnaOrderId, $bookingProducts, $bookingAddress, $bookingFee = 0)
    {

        //dd($klarnaReservationId, $klarnaOrderId, $bookingProducts);
        //$flags = Flags::INC_VAT | Flags::IS_HANDLING;
        $flags = Flags::INC_VAT;

        foreach($bookingProducts as $product)
        {
            //echo "<p>".$product->id."-".str_replace(["-", ":", " "], "", $product->pivot->startDateTime)."-".(int)$product->pivot->quantity."-".$product->id."-".((float)$product->pivot->price)."</p>";
            $this->KlarnaOrderManagement->addArticle(
                (int)$product->pivot->quantity,
                //$product->id."-".str_replace(["-", ":", " "], "", $product->pivot->startDateTime), //(string)$product->pivot->getProductIdentifier(),
               // $product->id . "-" . substr(str_replace(["-", ":", " "], "", $product->pivot->startDateTime), 0, -2)."-".substr(str_replace(["-", ":", " "], "", $product->pivot->endDateTime), 0, -2),
                $product->id . "-" . substr(str_replace(["-", ":", " "], "", $product->pivot->startDateTime), 0, -2)."-".substr(str_replace(["-", ":", " "], "", $product->pivot->endDateTime), 0, -2),
                $product->name,
                //(float)$product->pivot->price * 100,
                floatval($product->pivot->price),
                25,           // 25% VAT
                0,              // Discount
                $flags          // Flags
            );
        }
        if ($bookingFee <> 0)
        {
            $this->KlarnaOrderManagement->addArticle(
                1,
                (string)999,
                "Booking fee",
                floatval($bookingFee),
                25,           // 25% VAT
                0,              // Discount
                $flags
            );

        }
        // Todo: send same address stored in database for this reservation
        if($bookingAddress)
        {
            $addr = new Address(
                $bookingAddress['email'], // Email address
                $bookingAddress['telephone'],                           // Telephone number, only one phone number is needed
                $bookingAddress['cell'],                 // Cell phone number
                $bookingAddress['firstName'],              // First name (given name)
                $bookingAddress['lastName'],                   // Last name (family name)
                $bookingAddress['careOf'],                           // No care of, C/O
                $bookingAddress['address'],                // Street address
                $bookingAddress['post_code'],                      // Zip code
                $bookingAddress['city'],                   // City
                Country::SE,            // Country
                null,                         // House number (AT/DE/NL only)
                null                          // House extension (NL only)
            );

            /*$addr = new Address(
                'sales@djembefola.com', // Email address
                '02123',                           // Telephone number, only one phone number is needed
                '0727117879',                 // Cell phone number
                'James',              // First name (given name)
                'Farrell',                   // Last name (family name)
                '',                           // No care of, C/O
                'Weserstr 12',                // Street address
                '12045',                      // Zip code
                'Berlin',                   // City
                Country::SE,            // Country
                null,                         // House number (AT/DE/NL only)
                null                          // House extension (NL only)
            );*/
        }

        $this->KlarnaOrderManagement->setAddress(Flags::IS_BILLING, $addr);
        $this->KlarnaOrderManagement->setAddress(Flags::IS_SHIPPING, $addr);

        // Set store specific information
        $this->KlarnaOrderManagement->setEstoreInfo(
            $klarnaOrderId     // Internal order ID
        );

        try {

            $response = $this->KlarnaOrderManagement->update($klarnaReservationId);

            return [
                'error' => false,
                'exception' => null,
                'response' => $response
            ];
            
        }
        catch(\Exception $e)
        {
            return [
                'error' => true,
                'exception' => $e,
                'response' => ""
            ];

        }

    }

    public function activateOrderProduct ($reservationId, $productId, $quantity)
    {

        $this->KlarnaOrderManagement->addArtNo($quantity, $productId);

        $result = $this->KlarnaOrderManagement->activate(
            $reservationId,
            null,    // OCR Number
            Flags::RSRV_SEND_BY_EMAIL
        );

        return $result[1];

    }

    //array of products
    public function activateOrderProducts ($reservationId, $products)
    {

        foreach($products as $product)
        {
            $this->KlarnaOrderManagement->addArtNo($product->pivot->quantity, $product);
        }



        $result = $this->KlarnaOrderManagement->activate(
            $reservationId,
            null,    // OCR Number
            Flags::RSRV_SEND_BY_EMAIL
        );

        return $result[1];

    }

    public function selectedProductsByInvoice($products)
    {
        //die(var_dump($products));
        //$products =  "1|OTR120|41603632392942871,2|GRSK01|41603632392942871,3|GRSK04|41603632392942874";

        $productSplit = explode (",", $products);
        $invoiceArray = [];

        foreach($productSplit as $product)
        {

            $productSplit = explode ("|", $product);

            $invoiceArray[$productSplit[2]][] = $productSplit[1];

        }

        return $invoiceArray;
    }

    public function getSelectedProductIdsFromCommaList($products)
    {
        $selectedProducts = explode (",", $products);

        $selectedProductsIds = [];

        foreach($selectedProducts as $product)
        {
            $productSplit = explode ("|", $product);
            $selectedProductsIds[] = $productSplit[1];
        }

        return $selectedProductsIds;

    }

    public function getProductArrayFromCommaList($products)
    {
        $selectedProducts = explode (",", $products);

        $selectedProductsIds = [];

        foreach($selectedProducts as $product)
        {
            $productSplit = explode ("|", $product);
            $selectedProductsIds[] = $productSplit[1];
        }

        return $selectedProductsIds;

    }

    public function refundOrderProducts ($invoiceId, $products)
    {
        foreach($products as $product)
        {
            $this->KlarnaOrderManagement->addArtNo($product->pivot->quantity, $product);
        }

        $result = $this->KlarnaOrderManagement->creditPart(
            $invoiceId
        );

        return $result[1];
    }

    public function refundOrderProduct ($removeQuantity, $invoiceId, $product_number)
    {

        $this->KlarnaOrderManagement->addArtNo((int)$removeQuantity, $product_number);

        $result = $this->KlarnaOrderManagement->creditPart(
            $invoiceId
        );

        return $result[1];

    }

    public function activateOrder($klarna_reservationId)
    {

        $result = $this->KlarnaOrderManagement->activate(
            $klarna_reservationId,
            null,    // OCR Number
            Flags::RSRV_SEND_BY_EMAIL
        );

        return $result[1];

    }

    protected function getConnector() {
        for ($i=0; $i<4; $i++) {
            try {
                $re = Klarna_Checkout_Connector::create(
                    $this->sharedSecret,
                    $this->klarnaUrl
                );
                break;
            }
                // Connection failed, wait a while and try again
            catch (Klarna_Checkout_ConnectionErrorException $e) {
                usleep(400*1000);
            }
        }
        if (empty($re))
            throw new Exception("Connection to Klarna failed");
        return $re;
    }



    public function checkout($cart, $name, $address, $postal_code, $email, $extraRentalDetails)
    {
        $create = array();

        foreach ($cart as $item) {
            $create['cart']['items'][] = $item;
        }

        $names = explode(" ", $name);

        $create['shipping_address']['email'] = $email;
        $create['shipping_address']['postal_code'] = $postal_code;

        $create['purchase_country'] = 'SE';
        $create['purchase_currency'] = 'SEK';
        //$create['locale'] = 'sv-se';

        $create['locale'] = $this->klarnaLocale;

        $create['merchant'] = array(
            'id' => $this->EID,
            'terms_uri' => $this->terms_uri,
            'checkout_uri' => $this->checkout_uri,
            'confirmation_uri' => $this->confirmation_uri.
                '?klarna_order_id={checkout.order.id}',
            'push_uri' => $this->push_uri .
                '?klarna_order_id={checkout.order.id}'
        );
        // below is used on their website $k->setExtraInfo("merchant_data", $merchant_data);
        $create['attachment'] = array(
            'content_type' => 'application/vnd.klarna.internal.emd-v2+json',
            'body' => json_encode($extraRentalDetails)
        );

        //3. Create a checkout order
        try {
            /*$connector = Klarna_Checkout_Connector::create(
                $this->sharedSecret,
                Klarna_Checkout_Connector::BASE_TEST_URL
            );
            */

            //catch timeouts:
            $connector = $this->getConnector();
            $order = new Klarna_Checkout_Order($connector);
            $order->create($create);

            //4. Render the checkout snippet

            $order->fetch();

            //var_dump($order);

        } catch (Klarna_Checkout_ApiErrorException $e) {
             var_dump($e->getMessage());
            var_dump($e->getPayload());
        }

        // Store location of checkout session
        $_SESSION['klarna_order_id'] = $orderID = $order['id'];

        // Display checkout
        $snippet = $order['gui']['snippet'];
        //echo "<div>{$snippet}</div>";

        return $snippet;
    }

    public function retrieveCheckout ($orderId) {

        $connector = Klarna_Checkout_Connector::create(
            $this->sharedSecret,
            Klarna_Checkout_Connector::BASE_TEST_URL
        );

        $order = new Klarna_Checkout_Order($connector, $orderId);
        $order->fetch();

        /*$snippet = $order['gui']['snippet'];

        echo "<div>{$snippet}</div>";

        unset($_SESSION['klarna_checkout']);*/

        return $order;
    }

    public function notifyKlarnaOrderStatus ($order) {

        // At this point make sure the order is created in your system and send a
        // confirmation email to the customer

        $update = array();
        $update['status'] = 'created';

        $order->update($update);

    }

    public function cancel($klarna_reservationId)
    {
        try {
            $result = $this->KlarnaOrderManagement->cancelReservation($klarna_reservationId);
        }
        catch(\Exception $e)
        {
            dd($e);
        }


    }

    public function credit($invNo)
    {
        try {
            $result = $this->KlarnaOrderManagement->creditInvoice($invNo);
            //echo '<p>here invoice number - '.$invNo;
        }
        catch (Exception $e) {
            return false;
        }

        /*$Order->set("payment_status", PAYMENT_STATUS_CREDITED);
        $Order->save();*/

        return true;
    }

    private function setLanguage($language)
    {
        if ($language == "se")
        {
            return Language::SV;
        }
        elseif ($language == "en")
        {
            return Language::EN;
        }
        elseif ($language == "de")
        {
            return Language::DE;
        }
    }

    private function setLocale($language)
    {
        
        if ($language == "se")
        {
            return 'sv-se';
        }
        elseif ($language == "en")
        {
            return 'en-gb';
        }
        elseif ($language == "de")
        {
            return 'de-ge';
        }
    }
}