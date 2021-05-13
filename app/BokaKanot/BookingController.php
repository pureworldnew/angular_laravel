<?php

namespace App\Http\Controllers;

use App\BokaKanot\Billing\KlarnaAdminNotifierBookingDetails;
use App\BokaKanot\Booking\BookingEmailer;
use App\BokaKanot\BookingUtil;
use App\BokaKanot\Klarna;
use App\BokaKanot\Klarna\Checkout\Connector;
use App\BokaKanot\KlarnaService;
use App\BokaKanot\LocalisationCms;
use App\BokaKanot\PricingUtil;
use App\BokaKanot\Repositories\BookingRepository;
use App\BokaKanot\Repositories\CategoryRepository;
use App\BokaKanot\Repositories\CentreRepository;
use App\BokaKanot\UserUtil;
use App\Booking;
use App\BookingProduct;
use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\BokaKanot\BookingUtil as BookingUtils;

class BookingController extends Controller
{
    private $navPage;
    /**
     * @var BookingRepository
     */
    private $bookingRepository;
    /**
     * @var CentreRepository
     */
    private $centreRepository;
    /**
     * @var KlarnaService
     */
    private $klarnaService;
    /**request
     * @var Booking
     */
    private $booking;
    /**
     * @var PricingUtil
     */
    private $pricingUtil;
    /**
     * @var BookingEmailer
     */
    private $bookingEmailer;

    public function __construct(BookingRepository $bookingRepository, CentreRepository $centreRepository/*, KlarnaService $klarnaService*/, BookingUtils $booking, PricingUtil $pricingUtil, BookingEmailer $bookingEmailer)
    {
        $this->navPage = "booking";
        $this->middleware('web');
        $this->bookingRepository = $bookingRepository;
        $this->centreRepository = $centreRepository;
        //$this->klarnaService = $klarnaService;

       // $newParametres = $klarnaSettings->getParameters();
        $parameters['EID'] ="6323"; //EID
        $parameters['checkout_uri'] = "http://$_SERVER[HTTP_HOST]"."/booking/pay";
        $parameters['confirmation_uri'] = "http://$_SERVER[HTTP_HOST]"."/booking/confirmation";
        $parameters['push_uri'] = "http://$_SERVER[HTTP_HOST]"."/klarna/push";
        $parameters['terms_uri'] = "http://$_SERVER[HTTP_HOST]"."/klarna/terms";
        $parameters['sharedSecret'] = "84FOgBccj5pvJyT";
        $parameters['language'] = App::getLocale();
        
       // echo ">>>>> here<br/>";
        $this->klarnaService = App::make('App\BokaKanot\Interfaces\BillingInterface',  $parameters);

        $this->klarna = App::make('App\BokaKanot\Klarna', $parameters);

        $this->booking = $booking;
        $this->pricingUtil = $pricingUtil;
        $this->bookingEmailer = $bookingEmailer;
    }

    public function testuser()
    {
        $DB = new App\BokaKanot\KlarnaDatabase();
        $DB->saveKlarnaOrderIdReservationId("123", 555, 7);
        return view('booking.index')->with([
                "bookingStep" => "book",
                "navPage" => "test",
                "categories" => [],
                "subCategories" => []
            ]
        );
       // dd(Auth::user()->centres()->first()->id);
    }

    public function removeCartItem(Request $request)
    {
        $success = $this->bookingRepository->deleteBookingProduct($request->get('bookingLocationId'));

        return $success;
    }

    public function addProduct(Request $request, PricingUtil $pricingUtil)
    {
        $item = $request->get('shoppingCartItem');

//        echo $item['productId']."-".$item['startDateTime']."-".$item['endDateTime'];

        $productPrice = $pricingUtil->getLowestPrice($item['productId'], $item['startDateTime'], $item['endDateTime']);

        $bookingLocationId = $this->bookingRepository->createBookingProduct($item, $item['bookingId'], $productPrice);

        return $bookingLocationId."|".$productPrice;
    }

    public function make(Request $request, UserUtil $userUtil, PricingUtil $pricingUtil, BookingEmailer $bookingEmailer)
    {
        //dd($request->all());
        $bookingRequest = $request->get('booking');

        $shoppingCart = array_values($bookingRequest['shoppingCart']);

        $Booking = new Booking;

        if (/*Auth::user()*/Auth::check()) {
            $Booking->centre_id = Auth::user()->centres()->first()->id;
            $Booking->user_id = Auth::user()->id;
        } else {
            $Booking->user_id = null;

            if ($request->session()->has('centreId')) {
                $Booking->centre_id = $request->session()->get('centreId');
            } else {
                dd('No Centre selected');
            }
        }


        $Booking->token = str_random(64);

        $Booking->status = 0;

        $Booking->save();

        $bookingId = DB::getPdo()->lastInsertId();

        /*$emailProductTable = "<table><th>Product id</th><th>Start date/time</th><th>End date/time</th>";*/

        foreach ($shoppingCart as $item) {
            //$emailProductTable .= "<tr><td>".$item['productId']."</td><td>".$item['startDateTime']."</td><td>".$item['endDateTime']."</td>";

            //$productPrice = $pricingUtil->test($item);
            $productPrice = $pricingUtil->getLowestPrice($item['productId'], $item['startDateTime'], $item['endDateTime']);

            $bookingLocationId = $this->bookingRepository->createBookingProduct($item, $Booking->id, $productPrice);


        }
        //$emailProductTable.="</table>";

        /*$cancelLink = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/booking/cancel/".$bookingId."/".$Booking->token;

        if(!(strpos($_SERVER['HTTP_HOST'], 'localhost') > -1))
        {
            $bookingEmailer->newBooking($Booking->email, $Booking->name, $cancelLink, $emailProductTable);
        }*/




        return $Booking->id . "|".$bookingLocationId."|".$productPrice;
    }

    public function cancel($bookingId, $token, BookingRepository $bookingRepository)
    {

        $bookingProducts = $bookingRepository->getBookingCentreDetails($bookingId);

        $error = false;
        $errorMessage="";

        if(sizeof($bookingProducts) > 0) {
            if ($bookingProducts[0]->token == $token) {
                //jpfjpf
                if ($bookingProducts[0]->status == 1 or $bookingProducts[0]->status == 2 or $bookingProducts[0]->status == 3) {

                } else {
                    $error = true;
                    $errorMessage = "<h1>" . trans('errors/booking.cancelError') . "</h1><p>" . trans('errors/booking.invalidStatus') . "</p><p>" . trans('errors/booking.pleaseContact') . $bookingProducts[0]->centreEmail . trans('errors/booking.resolveIssue') . "</p>";
                }
            } else {
                $error = true;
                $errorMessage = "<h1>" . trans('errors/booking.cancelError') . "</h1><p>" . trans('errors/booking.invalidToken') . "</p><p>" . trans('errors/booking.pleaseContact') . $bookingProducts[0]->centreEmail . trans('errors/booking.resolveIssue') . "</p>";

            }
        }
        else
        {
            /*if(Session::has('flashMessage'))
            {

            }
            else*/

            $error = true;
            $errorMessage = "<h1>" . trans('errors/booking.noProductHeading') . "</h1><p>" . trans('errors/booking.noProductError') . "</p>";



        }

        return view('booking.cancel')->with([
                "bookingStep" => "cancel",
                "navPage" => ""/*$this->navPage*/,
                "error" => $error,
                "errorMessage" => $errorMessage,
                "bookingProducts" => $bookingProducts,
                "hideMenu" => true,
            ]
        );
    }

   public function removeProduct(Request $request, BookingUtil $bookingUtil)
    {
        if($request->has('bookingProductId'))
        {
            $bookingProduct = $this->bookingRepository->getBookingProduct($request->input('bookingProductId'));

            $bookingUtil->checkIfInTimeToCancel($bookingProduct[0]->booking_id);


            //dd($centreDetails);
            $removed = $this->bookingRepository->deleteBookingProduct($request->input('bookingProductId'));

            if($removed AND $bookingProduct[0]->klarna_product_status == 3)
            {
                $this->klarna->refundProduct($bookingProduct->klarna_invoiceId, $bookingProduct->product_id, $bookingProduct->booking_id);
            }


            Session::flash('flashMessage', trans('errors/booking.productRemovedMessage'));
            return redirect($request->input('returnUrl'));

//Session::flash('key', 'value');
            //session:get('heky)')
            //session('key');
        }
        else
        {
            dd('No booking product id');
        }
    }

    public function cancelBooking(Request $request) {

        if($request->has('bookingId'))
        {
            if($this->bookingRepository->getBookingDetails($request->input('bookingId'))[0]->status == 3 or
                $this->bookingRepository->getBookingDetails($request->input('bookingId'))[0]->status == 1)
            {
                $this->bookingRepository->updateStatus($request->input('bookingId'), 4);
                //1|OTR120|41603632392942871,2|GRSK01|41603632392942871,3|GRSK04|41603632392942874

                $this->klarna->refundSelectedProducts($request->input('bookingId'));
                Session::flash('flashMessage', trans('booking/cancel.bookingCancelled'));

            }

            return redirect($request->input('returnUrl'));
        }
        else
        {
            dd('No booking id provided');
        }
    }

    public function index(CategoryRepository $categoryRepository, UserUtil $userUtil, Request $request)
    {
        $centreId = $userUtil->getUserCentreId($request);

        $categories = $categoryRepository->getPrimaryCategories($centreId);

        $subCategories = $categoryRepository->getSubCategories($categories);

        return view('booking.index')->with([
                "bookingStep" => "book",
                "navPage" => $this->navPage,
                "categories" => $categories,
                "subCategories" => $subCategories,
                "hideMenu" => true,
            ]
        );
    }

    public function editBooking($bookingId, $productId)
    {
        return view('booking.index')->with([
                "bookingStep" => "book",
                "navPage" => $this->navPage,
                "hideMenu" => true,
            ]
        );
    }

    public function manage()
    {
        return view('admin.manage')->with([
            "adminPage" => 'adminPage',
            "navPage" => "manage"
        ]);
    }


    public function confirm(Request $request, LocalisationCms $localisationCms)
    {
        //dd($request->input('bookingId'), $this->bookingRepository->fetchBooking($request->input('bookingId'))->first());
        $booking = $this->bookingRepository->fetchBooking($request->input('bookingId'))->first();

        if ($booking) {
            return view('booking.confirm')->with([
              "bookingStep" => "confirm",
              "booking" => $booking,
              "navPage" => $this->navPage,
              "hideMenu" => true,
              "bookingConditions" => $localisationCms->getLocaleString(App::getLocale(), "booking_conditions"),
              "payment_policy" => $localisationCms->getLocaleString(App::getLocale(), "payment_policy")
            ]);
        } else {
            return redirect()->back();
        }
    }

    /*public function klarnaConfirm(Request $request) {

        $orderId = $request->input('klarna_order_id');

        if($orderId)
        {
            //dd($request->input('klarna_order_id'));
            $order = $this->klarnaService->retrieveCheckout($orderId);

            $klarnaSnippet =  $order['gui']['snippet'];

            return view('booking.klarnaConfirm')->with([
                "bookingStep" => "pay",
                "navPage" => $this->navPage,
                "klarnaSnippet" => $klarnaSnippet
            ]);
        }
        else
        {
            throw new Exception('No order Id, please start again');
        }

    }*/

   public function pay(Request $request, UserUtil $userUtil)
   {
       $currency = "SEK";

       $booking = $this->bookingRepository->fetchBooking($request->input('bookingId'))->first();

       $booking->name = $request->input('name');
       $booking->address = $request->input('address');
       $booking->city = $request->input('city');
       $booking->post_code = $request->input('postCode');
       $booking->telephone = $request->input('telephone');
       $booking->email = $request->input('email');

       $booking->save();

       $totalPrice = $this->booking->getTotalPrice($booking->products);

       Session::set('bookingId', $booking->id);
       Session::set('totalPrice', $totalPrice);

       $centreId = $userUtil->getUserCentreId($request);

       $paymentMethods = $this->centreRepository->getCentrePaymentMethods($centreId);

       $klarnaSnippet = $this->getKlarna($booking);
        //$stripeSnippet = $this->getKlarna($booking);

        $productsDescription = "";

       foreach ($booking->products as $product) {
           $productsDescription .= $product->name." (".$product->quantity."),";
       }
       $productsDescription = rtrim($productsDescription, ',');

       return view('booking.pay')->with([
            "bookingStep" => "pay",
            "navPage" => $this->navPage,
            "paymentMethods" => $paymentMethods,
            "klarnaSnippet" => $klarnaSnippet,
            "currency" => $currency,
            "booking" => $booking,
            "productsDescription" => $productsDescription,
            "totalPrice" => $totalPrice,
            "hideMenu" => true,
        ]);
   }

    public function stripePayment()
    {
        //$billing = App::make('App\BokaKanot\Billing\BillingInterface');

        try {
            $email = Input::get('email');
            //dd(Input::all());
            $customerId = $billing->charge([
                'email' => $email,
                'token' => Input::get('stripe-token'),
                'amount' => Input::get('amount'),
                'currency' => Input::get('shopCurrency'),
                'productsDescription' => Input::get('productsDescription'),
                "hideMenu" => true,

            ]);
            /*if($customerId ==0) {
                dd('customier 0');
                return redirect('shop/djembes')->with('flashmessage', "There was a problem with your payment details. Your credit card has not been charged. Please consult your card issuer or contact sales@djembefola.com, if you believe there is an error on our side.");
            }*/
            /*$user = User::first();
            $user->billing_id = $customerId;
            $user->save();
            Cart::destroy();*/
        } catch (Exception $e) {
            dd('exception');
            return redirect('shop/djembes')->withFlashMessage($e->getMessage());
        }

        return view('shop.purchase')->with([
            'email' => $email,
            'paymentMethod' => 'card',
            'cart' => Cart::content(),
            'shippingTo' => "",
            'showShippingSelect' => false,
            'user' => $this->user,
            'shippingTo' => "",
            'shippingDropDown' => $this->Shipping->getShippingDropDown(),
            'cart' => Cart::content(),
            'cartTotalPrice' => Cart::total(),
            "hideMenu" => true,
        ]);
    }

    public function confirmation(Request $request, UserUtil $userUtil)
    {

        $bookingId = (string)Session::get('bookingId');

        $centreId = $userUtil->getUserCentreId($request);

        $booking = $this->bookingRepository->fetchBooking($bookingId)->first();

        $klarnaSnippet = "";

        $orderId = $request->input('klarna_order_id');

        $centreDetails = $this->centreRepository->getCentreDetails($centreId)[0];

        if ($orderId) {
            $klarnaAdminNotifierBookingDetails = new KlarnaAdminNotifierBookingDetails(
                $booking->name,
                $booking->address,
                $booking->postal_code,
                $booking->email,
                $booking->products,
                "Booking made by ".$booking->name,
                $this->booking->getTotalPrice($booking->products),
                [ $centreDetails->users()->first()->email ]);

            $this->klarna->confirmBooking($orderId, $bookingId, $klarnaAdminNotifierBookingDetails);

            $this->klarna->klarnaDatabase->updateStatus($bookingId, 1);

            $this->sendBookingEmail($booking, $centreDetails->email);
        }

//dd($booking->products);
        return view('booking.confirmation')->with([
            "bookingStep" => "confirmation",
            "navPage" => $this->navPage,
            "booking" => $booking,
            "klarnaSnippet" => $klarnaSnippet,
            "centreDetails" => $centreDetails,
            "hideMenu" => true,
        ]);
    }

    public function sendBookingEmail($booking, $centreEmail)
    {
        $emailProductTable = "<table><th>Product</th><th>Quantity</th><th>Start date/time</th><th>End date/time</th><th>Price</th>";

        foreach ($booking->products as $product) {
            $productPrice = $this->pricingUtil->getLowestPrice($product['id'], $product->pivot['startDateTime'], $product->pivot['endDateTime']);

            $emailProductTable .= "<tr><td>".$product['name']."</td><td>".$product->pivot['quantity']."</td><td>".$product->pivot['startDateTime']."</td><td>".$product->pivot['endDateTime']."</td><td>".$productPrice."</td>";

        }
        $emailProductTable.="</table>";

        $cancelLink = "http://$_SERVER[HTTP_HOST]/booking/cancel/".$booking->id."/".$booking->token;

        if(!(strpos($_SERVER['HTTP_HOST'], 'localhost') > -1))
        {
            $this->bookingEmailer->newBooking($booking->email, $booking->name, $cancelLink, $emailProductTable, $centreEmail);
        }

    }

    public function edit()
    {
        return view('booking.edit')->with([
            "bookingStep" => "edit",
            "navPage" => $this->navPage,
            "hideMenu" => true,
        ]);
    }

    private function getKlarna($booking)
    {
        //dd('in get Klarna');
        $cart = array();

        foreach ($booking->products as $key => $product) {
            //dd($product->pivot->price);
              $cart[] = array(
                    'reference' =>  (string)$product->id,
                    'name' => $product->name,
                    'quantity' => 1,
                    'unit_price' => (float)$product->pivot->price * 100,
                    'discount_rate' => 0,
                    'tax_rate' => 0);
        }

        $snippet = $this->klarnaService->checkout($cart, $booking->name, $booking->address, $booking->post_code, $booking->email);

        return $snippet;
    }

    private function getStripe()
    {
    }
}
