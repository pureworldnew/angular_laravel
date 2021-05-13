<?php

namespace App\Http\Controllers;

use App;
use App\BokaKanot\Billing\KlarnaAdminNotifierBookingDetails;
use App\BokaKanot\BookingUtil;
use App\BokaKanot\Booking\BookingEmailer;
use App\BokaKanot\Booking\BookingStripe;
use App\BokaKanot\Klarna;
use App\BokaKanot\KlarnaService;
use App\BokaKanot\LocalisationCms;
use App\BokaKanot\PricingUtil;
use App\BokaKanot\Repositories\BookingRepository;
use App\BokaKanot\Repositories\CategoryRepository;
use App\BokaKanot\Repositories\CentreRepository;
use App\BokaKanot\Repositories\CountryRepository;
use App\BokaKanot\Repositories\PaymentRepository;
use App\BokaKanot\Repositories\ProductRepository;
use App\BokaKanot\UserUtil;
use App\Booking;
use App\Tagword;
use App\CenterUser;
use App\BookingInvoice;
use App\BookingProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\ConfirmBookingRequest;
use App\Product;
use App\User;
use App\FrontendProfile;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Stripe\PaymentIntent;
use Stripe\Stripe;

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
    /**
     * @var UserUtil
     */
    private $userUtil;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var BookingStripe
     */
    private $bookingStripe;

    public function __construct(BookingRepository $bookingRepository, CentreRepository $centreRepository/*, KlarnaService $klarnaService*/, BookingUtil $bookingUtil, PricingUtil $pricingUtil, BookingEmailer $bookingEmailer, UserUtil $userUtil, Request $request, ProductRepository $productRepository, CategoryRepository $categoryRepository, BookingStripe $bookingStripe)
    {
        $centreId = $userUtil->getUserCentreId($request);

        $this->navPage = "booking";
        $this->middleware('web');
        $this->bookingRepository = $bookingRepository;
        $this->centreRepository = $centreRepository;
        $centreStripeSecretKey = $this->centreRepository->getCentreStripeSecretKey($centreId);
        Stripe::setApiKey($centreStripeSecretKey);
        if ($userUtil->getUserCentreId($request)) {
            $this->klarna = $userUtil->getCentreKlarna($userUtil->getUserCentreId($request));
        }

        $this->bookingUtil = $bookingUtil;
        $this->pricingUtil = $pricingUtil;
        $this->bookingEmailer = $bookingEmailer;
        $this->userUtil = $userUtil;
        $this->request = $request;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->bookingStripe = $bookingStripe;
    }

    public function index(CategoryRepository $categoryRepository, UserUtil $userUtil, Request $request)
    {

        $booking = "";
        $bookingId = 0;

        if ($request->has('bookingId')) {
            $bookingId = $request->input('bookingId');

        }
        if (Session::has('bookingId')) {
            $bookingId = Session::get('bookingId');
        }

        if ($bookingId != 0) {
            $booking = $this->bookingRepository->fetchBooking($bookingId)->first();
        }

        $centreId = $userUtil->getUserCentreId($request);
        
        

        if ($centreId == 0) {
            echo "Invalid booking system. <a href='http://bokakanot.se'>Click here to return to Boka Kanot</a>";
            die();
        }

        $categories = $categoryRepository->getPrimaryCategories($centreId);

        $subCategories = $categoryRepository->getSubCategories($categories);

        $nextButtonArray = array("id" => "continueButton" /*,'v-bind:disabled' => 'continueButtonActive'*/, 'class' => 'btn btn-success');

        if ($booking == "") {

            $nextButtonArray["disabled"] = "disabled";
        }

        $removeProductEvent = "@submit.prevent";

        $javascriptMessages = [];
        $javascriptMessages['noZeroQuantity'] = trans('booking/index.noZeroQuantity');
        $javascriptMessages['addToCartSuccess'] = trans('booking/index.addToCartSuccess');
        $javascriptMessages['notEnough'] = trans('booking/index.notEnough');
        $javascriptMessages['maxDurationReached'] = trans('booking/index.maxDurationReached');

        $klarnaDetails = $userUtil->getCentreKlarnaDetails($centreId);

        $logo = $userUtil->getCentreLogo($centreId);
        
        
        $tagword = Tagword::select('description')->where('centre_id', $centreId)->get();
        $explode = $tagword[0]->description;
        $explodee = $tagword[1]->description;
        
        $string = preg_replace('/\.$/', '', $explode); 
        $stringg = preg_replace('/\.$/', '', $explodee); 
        
        $array = explode(', ', $string); 
        $arrayy = explode(', ', $stringg); 
        
        // check for login before booking
        if($klarnaDetails->NeedLogin == 'av' &&  Auth::guest()){
            $nextButtonArray["disabled"] = "disabled";
        }
        
            // continue with the booking
            // Set sesion
             if(Auth::check()) {
                new CenterUser;
                $user_tyep = CenterUser::find(Auth::user()->id);
                
                $usertype =  $user_tyep->user_type_id;
            }
            else{
                $usertype = "none";
            }
            Session::set('invited', true);
            Session::set('centreId', $centreId);
            Session::set('centreName', $klarnaDetails->name);
            Session::save();
            
            $sessionLink = "http://bokokanot.frontlinewebdevelopers.com/booking/".$klarnaDetails->urlSlug."/".App::getLocale();
            
            return view('booking.index')->with([
            "bookingStep" => "book",
            "navPage" => $this->navPage,
            "categories" => $categories,
            "subCategories" => $subCategories,
            "hideMenu" => true,
            "booking" => $booking,
            "nextButtonArray" => $nextButtonArray,
            "removeProductEvent" => $removeProductEvent,
            "javascriptMessages" => $javascriptMessages,
            "klarnaDetails" => $klarnaDetails,
            "logo" => $logo,
            "mmenutype" => "none",
            "user_type" => $usertype, 
            'url' => $sessionLink,
            'array' => $array,
            'arrayy' => $arrayy,
        ]
        );
        
       // }

    }

    public function confirm(Request $request, LocalisationCms $localisationCms)
    {
        // dd(Session::all());
        $bookingId = $request->has('bookingId') ? $request->get('bookingId') : ($request->session()->has('bookingId') ? $request->session()->get('bookingId') : 0);

        if ($bookingId != 0) {

            $booking = $this->bookingRepository->fetchBooking($bookingId)->first();
            Session::set('bookingId', $bookingId);

            $centreId = $this->userUtil->getUserCentreId($request);

            $centreDetails = $this->userUtil->getCentreConfirmBookingDetails($centreId);

            $totalPrice = $this->bookingUtil->getTotalPrice($booking->products, $centreDetails->bookingFee);
            $totalReservationPrice = $this->bookingUtil->getTotalReservationPrice($booking->products, $centreDetails->bookingFee);
            $removeProductEvent = "onSubmit";

            if ($booking) {
                if (sizeof($booking->products) == 0) {
                    Session::flash('message', trans('booking/confirm.noProducts'));
                    return redirect('/booking');
                }

                $adminFeeExplanation = "";
                if (sizeof($centreDetails->textStrings) > 0) {
                    $adminFeeExplanation = $centreDetails->textStrings[0]['field_value'];
                }

                $quantityAdminFeeQuantity = $this->bookingUtil->getBookingAdminFeeQuantity($booking->products, $centreId);
                $klarnaDetails = $this->userUtil->getCentreKlarnaDetails($centreId);
                // check session 
                //check if the user is front end 
                // check if it requires login {being set by the admin}
                // fecth the data o fthe user.  ****as well as the user type
                
                if(Auth::check()){
                    new CenterUser;
                $user_tyep = CenterUser::find(Auth::user()->id);
                
                $usertype =  $user_tyep->user_type_id;
                }
                else{
                    $usertype =  null;
                }
                 
                
                $NeedLogin = $klarnaDetails->NeedLogin;
                if(Auth::check() && $NeedLogin == 'av' && $usertype == 9 ) {
                    
                 // fetch the user profile and display it on the page
                 new FrontendProfile;
                 $user_id = Auth::user()->id;
                 $profile = FrontendProfile::where('user_id', '=', $user_id)->get()->first();
                 
                  // set session 
                    Session::flash('pre_reg', true);
                    Session::flash('name', $profile->name);
                    Session::flash('address', $profile->address );
                    Session::flash('zipcode', $profile->zipcode);
                    Session::flash('city', $profile->city);
                    Session::flash('country', $profile->country );
                    Session::flash('email', $profile->email);
                  
                    
                }
                
                 if(Auth::check()) {
                new CenterUser;
                $user_tyep = CenterUser::find(Auth::user()->id);
                
                $usertype =  $user_tyep->user_type_id;
                    }
                    else{
                        $usertype = "none";
                }

                return view('booking.confirm')->with([
                    "bookingStep" => "confirm",
                    "booking" => $booking,
                    "navPage" => $this->navPage,
                    "hideMenu" => true,
                    "bookingConditions" => $localisationCms->getLocaleString(App::getLocale(), "booking_conditions", $centreId),
                    "payment_policy" => $localisationCms->getLocaleString(App::getLocale(), "payment_policy", $centreId),
                    "removeProductEvent" => $removeProductEvent,
                    "totalPrice" => $totalPrice,
                    "totalReservationPrice" => $totalReservationPrice,
                    'centre' => $centreDetails,
                    'adminFeeExplanation' => $adminFeeExplanation,
                    'klarnaDetails' => $klarnaDetails,
                    "quantityAdminFeeQuantity" => $quantityAdminFeeQuantity,
                    "mmenutype" => "none",
                    "usertype" => $usertype,
                    "user_type" =>  $usertype,
                ]);
            } else {
                return redirect()->back();
            }
        } else {
            die("<h2>Booking could not be found</h2><a href='/booking'>" . trans('booking/index.bookingLost') . "</a>");
        }
    }
    public function comfirmPaymentIntent($id, $amount, $currency, $description)
    {
        $intent = null;
        try {
            if (isset($id)) {
                # Create the PaymentIntent
                $intent = \Stripe\PaymentIntent::create([
                    'payment_method' => $id,
                    'amount' => $amount * 100,
                    'currency' => $currency,
                    'confirmation_method' => 'automatic',
                    'confirm' => true,
                    'description' => 'Booking:',
                ]);
            }
            if (isset($json_obj->payment_intent_id)) {
                $intent = \Stripe\PaymentIntent::retrieve(
                    $json_obj->payment_intent_id
                );
                $intent->confirm();
            }
            $this->generatePaymentResponse($intent);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            # Display error on client
            echo json_encode([
                'error' => $e->getMessage(),
            ]);
        }
    }
    public function generatePaymentResponse($intent)
    {
        # Note that if your API version is before 2019-02-11, 'requires_action'
        # appears as 'requires_source_action'.
        if ($intent->status == 'requires_action' &&
            $intent->next_action->type == 'use_stripe_sdk') {
            # Tell the client to handle the action
            echo json_encode([
                'requires_action' => true,
                'payment_intent_client_secret' => $intent->client_secret,
                'intent' => $intent,
            ]);
        } else if ($intent->status == 'succeeded') {
            # The payment didn’t need any additional actions and completed!
            # Handle post-payment fulfillment
            echo json_encode([
                "success" => true,
                "intent" => $intent,
            ]);
        } else {
            # Invalid status
            http_response_code(500);
            echo json_encode(['error' => 'Invalid PaymentIntent status']);
        }
    }
    public function paymentIntent($id, Request $request)
    {
        $amount = $request->get("amount");
        $currency = $request->get("currency");
        $description = "Booking process:";
        return $this->comfirmPaymentIntent($id, $amount, $currency, $description);
    }
    public function removeCartItem(Request $request)
    {
        $bp = BookingProduct::find($request->get('bookingLocationId'));
        $success = $this->bookingRepository->hardDeleteBookingProduct($request->get('bookingLocationId'));
        //dd($bp);
        echo json_encode(['data' => $bp, 'status' => 1]);
        //return 1;
    }

    public function addProduct(Request $request, PricingUtil $pricingUtil)
    {
        $item = $request->get('shoppingCartItem');

        //echo $item['productId']."-".$item['startDateTime']."-".$item['endDateTime'];

        $productPrice = $pricingUtil->getLowestPrice($item['productId'], $item['startDateTime'], $item['endDateTime']);

        $bookingLocationId = $this->bookingRepository->createBookingProduct($item, $item['bookingId'], $productPrice * $item['quantity']);

        return $bookingLocationId . "|" . $productPrice * $item['quantity'];
    }

    public function make(Request $request, UserUtil $userUtil, PricingUtil $pricingUtil, BookingEmailer $bookingEmailer)
    {
       //dd($request->all());
        $bookingRequest = $request->get('booking');
        $shoppingCart = array_values($bookingRequest['shoppingCart']);

        $Booking = new Booking;

        if (Auth::check()) {
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

            $quantityOfProductsPrice = $productPrice * $item['quantity'];
            //dd($productPrice,$item['quantity']);
            $bookingLocationId = $this->bookingRepository->createBookingProduct($item, $Booking->id, $quantityOfProductsPrice);

        }
        //$emailProductTable.="</table>";

        /*$cancelLink = "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/booking/cancel/".$bookingId."/".$Booking->token;

        if(!(strpos($_SERVER['HTTP_HOST'], 'localhost') > -1))
        {
        $bookingEmailer->newBooking($Booking->email, $Booking->name, $cancelLink, $emailProductTable);
        }*/

        return $Booking->id . "|" . $bookingLocationId . "|" . $quantityOfProductsPrice;
    }

    public function cancel($bookingId, $token, BookingRepository $bookingRepository, Request $request)
    {

        $booking = $this->bookingRepository->getDetails($bookingId);

        if (!Auth::check()) {
            $request->session()->set('centreId', $booking->centre_id);
        }

        $error = false;
        $errorMessage = "";

        if (sizeof($booking->products) > 0) {
            if ($booking->token == $token) {

                if ($booking->isCancelled() || $booking->isCredited()) {
                    $error = true;
                    $errorMessage = "<h1>" . trans('errors/booking.cancelledMessage') . "</h1><p>" . trans('errors/booking.alreadyCancelled') . "</p>";
                } elseif ($booking->isNew() or $booking->isPaid() or $booking->isActivated()) {

                } else {
                    $error = true;
                    $errorMessage = "<h1>" . trans('errors/booking.cancelError') . "</h1><p>" . trans('errors/booking.invalidStatus') . "</p><p>" . trans('errors/booking.pleaseContact') . $booking->products->first()->category->centre->superUser()->email . trans('errors/booking.resolveIssue') . "</p>";
                }
            } else {
                $error = true;
                $errorMessage = "<h1>" . trans('errors/booking.cancelError') . "</h1><p>" . trans('errors/booking.invalidToken') . "</p><p>" . trans('errors/booking.pleaseContact') . $booking->products->first()->category->centre->superUser()->email . trans('errors/booking.resolveIssue') . "</p>";

            }
        } else {
            /*if(Session::has('flashMessage'))
            {

            }
            else*/

            $error = true;
            $errorMessage = "<h1>" . trans('errors/booking.noProductHeading') . "</h1><p>" . trans('errors/booking.noProductError') . "</p>";

        }

        return view('booking.cancel')->with([
            "bookingStep" => "cancel",
            "navPage" => "" /*$this->navPage*/,
            "error" => $error,
            "errorMessage" => $errorMessage,
            "booking" => $booking,
            "hideMenu" => true,
            "mmenutype" => "none",
        ]
        );

    }

    public function removeProduct(Request $request, BookingUtil $bookingUtil)
    {

        //good one
        $bookingProductId = $request->input('bookingProductId');

        if ($bookingProductId) {
            $booking = $this->bookingRepository->getBookingFromBookingProductId($bookingProductId);
            $bookingProductIdentifier = $booking->getProductIdentifier($bookingProductId);
            if (sizeof($booking->products) != 0) {
                $bookingProduct = $booking->products()->wherePivot('id', $bookingProductId)->get();

                if ((Auth::check() and $booking->userHasAccess(Auth::user()->id)) or $booking->productInTimeToCancel($bookingProduct->pivot->product_id) /* $bookingUtil->checkIfInTimeToCancel($booking->id)*/) {

                    $removed = $this->bookingRepository->deleteBookingProduct($request->input('bookingProductId'));
                    //$removed = 1;
                    $newProducts = $this->bookingRepository->getCurrentBookingProducts($booking->id);

                    if (sizeof($bookingProduct) == 0) {
                        //cancel booking
                        if ($booking->paymentMethodIsKlarna()) {
                            Session::flash('flashMessage', trans('errors/booking.bookingCancelled'));
                            $this->klarna->cancel($booking->id);

                            return redirect("/admin/bookings");
                        }

                    } else {

                        if ($removed) {

                            if ($booking->paymentMethodIsKlarna()) {

                                if ($bookingProduct->isNew()) {

                                    $bookingFee = $this->userUtil->getCentreBookingFee($booking->centre_id);

                                    $response = $this->klarna->removeProductFromCart($booking->klarna_reservationId, $booking->klarna_orderId, $newProducts, $request->input('bookingProductId'), $booking->getKlarnaBookingAddress(), $bookingFee);

                                    if ($response['error']) {
                                        // dd($response['exception']);
                                        Session::flash('flashMessage', $response['exception']);
                                        //Session::flash('flashMessage', "asdfasdf");
                                        echo "<h1>Call to Klarna failed</h1>";
                                        echo $response['exception'];
                                        echo "<p><a href='" . $request->input('returnUrl') . "'>Click here to return to admin</a></p>";
                                        die();
                                        //return redirect($request->input('returnUrl'));
                                    }

                                }

                                if ($bookingProduct->isActivated()) {

                                    $invoice = BookingInvoice::find($bookingProduct->pivot->booking_invoice_id);
                                    $this->klarna->refundProduct($bookingProduct->pivot->quantity, $invoice, $bookingProductIdentifier, $bookingProduct->pivot->booking_id, $bookingProductId);
                                    Session::flash('flashMessage', trans('errors/booking.productRemovedMessage'));
                                }
                            } elseif ($booking->paymentMethodIsStripe()) {
                                // dd($bookingProduct[0]->pivot->reserve_price *100);
                                // $this->bookingStripe->refund($booking->centre_id, ($bookingProduct[0]->pivot->price * $bookingProduct[0]->pivot->quantity), $booking->stripe_charge_id);

                                // New Calculation
                                $this->bookingStripe->refund($booking->centre_id, $bookingProduct[0]->pivot->reserve_price *100, $booking->stripe_charge_id);


                            }

                            return redirect($request->input('returnUrl'));
                        }
                    }

                    return redirect($request->input('returnUrl'));

                } else {
                    Session::flash('flashMessage', trans('errors/booking.tooLateToCancel'));
                    return back();
                }
            } else {
                Session::flash('flashMessage', trans('errors/booking.productNotExist'));
                return back();
            }
        } else {
            dd('No booking product id');
        }
    }

    public function cancelBooking(Request $request)
    {

        if ($request->has('bookingId')) {
            $booking = $this->bookingRepository->getDetails($request->input('bookingId'));

            if ((Auth::check() and $booking->userHasAccess(Auth::user()->id)) or $booking->allProductsInTimeToCancel()) {

                $booking->cancelOrCreditBooking();

            }

        } else {
            dd('No booking id provided');
        }

        return redirect()->back();
    }

    public function cancelBookingOld(Request $request)
    {

        if ($request->has('bookingId')) {
            $bookingDetails = $this->bookingRepository->getBookingDetails($request->input('bookingId'))[0];

            if ($bookingDetails->status == 2 or $bookingDetails->status == 1 or $bookingDetails->status == 3) {
                $this->bookingRepository->updateStatus($request->input('bookingId'), 4);
                //1|OTR120|41603632392942871,2|GRSK01|41603632392942871,3|GRSK04|41603632392942874

                if ($bookingDetails->payment_method_id == 4) //Klarna
                {
                    if ($bookingDetails->status == 2 or $bookingDetails->status == 1) {
                        $this->klarna->cancel($request->input('bookingId'));
                    } elseif ($bookingDetails->status == 3) {
                        $this->klarna->credit($request->input('bookingId'), $request->input('main_klarna_invoiceId'));
                    }

                }

                $this->bookingEmailer->cancelBooking($bookingDetails->email, $bookingDetails->name, $this->userUtil->getCentreEmail($request), $request->input('bookingId'));

                Session::flash('flashMessage', trans('booking/cancel.bookingCancelled'));

            }

            return redirect($request->input('returnUrl'));
        } else {
            dd('No booking id provided');
        }
    }

    public function testEmail()
    {
        $data['email'] = "peter@puschel.se";
        $data['name'] = "Peter";
        $data['cancelLink'] = "hahaha";
        $data['emailProductTable'] = "";
        $data['centreEmail'] = "booking@bokakanot.se";

        Mail::send('emails.newBookingToCentre', $data, function ($message) use ($data) {
            //Config::get('mail.superAdmin')
            $message->to($data['email'], "Webmaster")
                ->subject(trans('emails/newBookingToCentre.subject'));
        });

        // dd($data);
    }
    public function editBooking($bookingId, $productId)
    {
        return view('booking.index')->with([
            "bookingStep" => "book",
            "navPage" => $this->navPage,
            "hideMenu" => true,
            "mmenutype" => "none",
        ]
        );
    }

    public function manage()
    {
        return view('admin.manage')->with([
            "adminPage" => 'adminPage',
            "navPage" => "manage",
            "mmenutype" => "none",
        ]);
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
    /* public function doPay(Request $request, UserUtil $userUtil)
    {
    //jpfjpfjpf
    = $request->input('name');
    = $request->input('paymentMethod');
    = $request->input('customerType');
    = $request->input('address');
    = $request->input('post_code');
    = $request->input('country');
    }*/

    public function pay(ConfirmBookingRequest $request, UserUtil $userUtil)
    {
        $bookingId = Session::get('bookingId');
        
        echo $bookingId;

        if ($bookingId != null) {
            $currency = "SEK";

            $booking = $this->bookingRepository->fetchBooking($request->input('bookingId'))->first();

            //dd($request->input('name'), Auth::check());
            $booking->name = $request->input('name') != null ? $request->input('name') : (Auth::check() ? "noname" : "");
            $booking->address = $request->input('address') != null ? $request->input('address') : (Auth::check() ? Auth::user()->address : "");
            $booking->city = $request->input('city') != null ? $request->input('city') : (Auth::check() ? Auth::user()->city : "");
            $booking->post_code = $request->input('postCode') != null ? $request->input('postCode') : (Auth::check() ? Auth::user()->centres()->first()->post_code : "");
            $booking->telephone = $request->input('telephone') != null ? $request->input('telephone') : (Auth::check() ? Auth::user()->telephone : "");
            $booking->email = $request->input('email') != null ? $request->input('email') : (Auth::check() ? Auth::user()->email : "");
            $booking->freeText = $request->input('freeText') != null ? $request->input('freeText') : "";
            $booking->terms_accepted = $request->has('terms_accepted') ? true : false;
            $centreId = $userUtil->getUserCentreId($request);
            $bookingFee = $userUtil->getCentreBookingFee($centreId);
            $booking->bookingFee = $bookingFee;
            $booking->bookingcountry = $request->input('bookingcountry');

            $booking->save();

            if ($request->has('usingAdminFee') and $request->get('quantityAdminFee') > 0) {

                $this->addAdminFee($booking->id, $request->get('adminFee'), $request->get('quantityAdminFee'), $centreId);

            }

            $booking = $this->bookingRepository->fetchBooking($request->input('bookingId'))->first();

            $totalPrice = $this->bookingUtil->getTotalPrice($booking->products, $bookingFee);
            $totalReservationPrice = $this->bookingUtil->getTotalReservationPrice($booking->products);
            /*dd($totalPrice);
             */
            Session::set('bookingId', $booking->id);
            Session::set('totalPrice', $totalPrice);
            Session::set('totalReservationPrice', $totalReservationPrice);
            $klarnaDetails = $userUtil->getCentreKlarnaDetails($centreId);
            
              
                if(Auth::check()){
                     new CenterUser;
                    $user_tyep = CenterUser::find(Auth::user()->id);
                    
                    $usertype =  $user_tyep->user_type_id;
                }
                else{
                    $usertype = null;
                }

            if ( /*Auth::guest()*/Auth::check() && $usertype == 1) { // Logged in user should not have to pay
                $centreDetails = $this->centreRepository->getCentreDetails($centreId)[0];
                $this->bookingRepository->updateStatus($bookingId, 3);
                //$this->sendBookingEmail($booking, $centreDetails->email);
                $booking->payment_method_id = 2;
                $booking->setPaymentMethod("Cash");
                $booking->save();

                Session::forget('bookingId');
                Session::forget('klarnaSnippet');

                new CenterUser;
                $user_tyep = CenterUser::find(Auth::user()->id);
                
                $usertype =  $user_tyep->user_type_id;
                return view('booking.confirmation')->with([
                    "bookingStep" => "confirmation",
                    "navPage" => $this->navPage,
                    "booking" => $booking,
                    "klarnaSnippet" => null,
                    "centreDetails" => $centreDetails,
                    "hideMenu" => false,
                    "klarnaDetails" => $klarnaDetails,
                    "stripeMessage" => null,
                    "mmenutype" => "none",
                    "user_type" => "$usertype",
                ]);
            }
            else if ( /*Auth::guest()*/Auth::check() && $usertype == 6) { // Logged in user should not have to pay
                $centreDetails = $this->centreRepository->getCentreDetails($centreId)[0];
                $this->bookingRepository->updateStatus($bookingId, 3);
                //$this->sendBookingEmail($booking, $centreDetails->email);
                $booking->payment_method_id = 2;
                $booking->setPaymentMethod("Cash");
                $booking->save();

                Session::forget('bookingId');
                Session::forget('klarnaSnippet');

                new CenterUser;
                $user_tyep = CenterUser::find(Auth::user()->id);
                
                $usertype =  $user_tyep->user_type_id;
                return view('booking.confirmation')->with([
                    "bookingStep" => "confirmation",
                    "navPage" => $this->navPage,
                    "booking" => $booking,
                    "klarnaSnippet" => null,
                    "centreDetails" => $centreDetails,
                    "hideMenu" => false,
                    "klarnaDetails" => $klarnaDetails,
                    "stripeMessage" => null,
                    "mmenutype" => "none",
                    "user_type" => "$usertype",
                ]);
            }

            $paymentMethods = $this->centreRepository->getCentrePaymentMethods($centreId);
            $centreTextStrings = $this->centreRepository->getCentreTextStrings($centreId, App::getLocale())[0];
            $centreStripePublicKey = $this->centreRepository->getCentreStripePublicKey($centreId);
            $centrePaypalemail = $this->centreRepository->getcentrePaypalemail($centreId);

            $centre = $this->centreRepository->getCentreDetails($centreId)[0];

            $paymentCashHow = $centreTextStrings->textStrings->where('language', 'en')->where('field_name', 'paymentCashHow')->first()['field_value'];
            $paymentInvoiceHow = $centreTextStrings->textStrings->where('language', 'en')->where('field_name', 'paymentInvoiceHow')->first()['field_value'];
            $paymentTransferHow = $centreTextStrings->textStrings->where('language', 'en')->where('field_name', 'paymentTransferHow')->first()['field_value'];

            if (!Session::has('klarnaSnippet')) {
                $klarnaSnippet = $this->getKlarna($booking, ($bookingFee/* + $totalAdminFee*/));
                Session::set('klarnaSnippet', $klarnaSnippet);
            }

            $productsDescription = "";

            foreach ($booking->products as $product) {
                $productsDescription .= $product->name . " (" . $product->quantity . "),";
            }
            // $amount = $totalPrice;
            $amount = $totalReservationPrice;
            $centreStripeSecretKey = $this->centreRepository->getCentreStripeSecretKey($centreId);
            \Stripe\Stripe::setApiKey($centreStripeSecretKey);

            $intent = \Stripe\PaymentIntent::create([
                "amount" => $amount * 100,
                // "currency" => 'EUR',
                "currency" => 'SEK',
                "payment_method_types" => ["card"],
                'capture_method' => 'manual',
            ]);
            $klarnaDetails = $userUtil->getCentreKlarnaDetails($centreId);

            $productsDescription = rtrim($productsDescription, ',');
            return view('booking.pay')->with([
                "bookingStep" => "pay",
                "navPage" => $this->navPage,
                "paymentMethods" => $paymentMethods,
                "klarnaSnippet" => Session::get('klarnaSnippet'),
                "currency" => $currency,
                "booking" => $booking,
                "productsDescription" => $productsDescription,
                // "totalPrice" => $totalPrice,
                "totalPrice" => $totalReservationPrice,
                "hideMenu" => true,
                "paymentCashHow" => $paymentCashHow,
                "paymentInvoiceHow" => $paymentInvoiceHow,
                "paymentTransferHow" => $paymentTransferHow,
                "centreStripePublicKey" => $centreStripePublicKey,
                "centreStripeSecretKey" => $centreStripeSecretKey,
                "centrePaypalemail" => $centrePaypalemail,
                "intent" => $intent->id,
                "client_secret" => $intent->client_secret,
                "klarnaDetails" => $klarnaDetails,
                "mmenutype" => "none",
                "user_type" => "$usertype",

                "centre" => $centre,
            ]);
        } else {
            die("<a href='/booking'>" . trans('booking/index.bookingLost') . "</a>");
        }

    }

    public function stripePayment($request, $centreId)
    {
        $parameters = [];

        $parameters['secret_key'] = $this->centreRepository->getCentreStripeSecretKey($centreId);

        $billing = App::make('App\BokaKanot\Interfaces\BillingInterface', $parameters);

        try {
            $email = $request->get('email');

            $customerIdBookingId = $billing->charge([
                'email' => $email,
                'token' => $request->get('stripe-token'),
                'amount' => $request->get('amount'),
                'currency' => $request->get('shopCurrency'),
                //'currency' => "EUR",
                'productsDescription' => $request->get('productsDescription'),
                "hideMenu" => true,

            ]);

            return $customerIdBookingId;

            /*if($customerId ==0) {
            dd('customier 0');
            return redirect('shop/djembes')->with('flashmessage', "There was a problem with your payment details. Your credit card has not been charged. Please consult your card issuer or contact sales@djembefola.com, if you believe there is an error on our side.");
            }*/
            /*$user = User::first();
        $user->billing_id = $customerId;
        $user->save();
        Cart::destroy();*/
        } catch (Exception $e) {
            Session::flash('stripeError', $e->getMessage());
            return "Error";
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
            "mmenutype" => "none",
        ]);
    }
    /* public function doPay(Request $request, UserUtil $userUtil)
    {
    //jpfjpfjpf
    = $request->input('name');
    = $request->input('paymentMethod');
    = $request->input('customerType');
    = $request->input('address');
    = $request->input('post_code');
    = $request->input('country');
    }*/
    public function stripeError()
    {
        return Session::get('stripeErrror');
    }

    public function confirmation(Request $request, UserUtil $userUtil, PaymentRepository $paymentRepository, CountryRepository $countryRepository)
    {

        // dd(Session::all());
        // dd($request->all());
        $bookingId = (string) Session::get('bookingId');
        if ($bookingId) {

            // For Update The Quantity
            //$orderQuantity = BookingProduct::where('booking_id' ,$bookingId)->select('quantity' ,'product_id')->first();
            //$productQuantity = Product::where('id' ,$orderQuantity->product_id)->select('quantity')->first();

            //$quantity = $productQuantity->quantity - $orderQuantity->quantity;
            // For Changes The Reserve Price
            //Product::where('id' ,$orderQuantity->product_id)->update(["quantity" => $quantity]);
            $centreId = $userUtil->getUserCentreId($request);
            $bookingFee = $userUtil->getCentreBookingFee($centreId);

            $booking = $this->bookingRepository->fetchBooking($bookingId)->first();
            $klarnaSnippet = "";

            $centreDetails = $this->centreRepository->getCentreDetails($centreId)[0];
            // dd();
            $stripeMessage = "";
            if ($request->input('paymentMethod') == "Stripe") {

                // 1|2 - customer id and then booking id seperated by |
                /* $customerIdBookingId = $this->stripePayment($request, $centreId);

                $customerBookingSplit = explode('|', $customerIdBookingId);

                if ($customerBookingSplit[0] <> "Error") {
                // $stripeMessage ="There was a problem with your payment details. Your credit card has not been charged. Please consult your card issuer or contact BokaKanot.se";
                $stripeMessage = trans('booking/confirmation.stripeSuccess');
                $this->bookingRepository->updateStripeCustomerNumber($bookingId, $customerBookingSplit[0]);
                $this->bookingRepository->updateStripeChargeId($bookingId, $customerBookingSplit[1]);
                } else {
                $stripeMessage = "<p style='color:red;'>" . Session::get('stripeError') . "</p>";
                die($stripeMessage."<br> <a href='/booking/confirm'>Backa och försök igen</a>");

                } */
                $intent = \Stripe\PaymentIntent::retrieve($request->get('paymentintent'));
                $stripeMessage = '';
                $transaction = false;

                try {

                    if ($intent->capture(["amount" => $intent->amount])) {
                        $transaction = $intent->charges->data[0]->balance_transaction;

                    }

                } catch (\Stripe\Error\InvalidRequest $e) {

                    $body = $e->getJsonBody();

                    $err = $body['error'];

                    $stripeMessage = 'Error occured while transaction : ' . $err['message'] . "\n";

                } catch (Exception $e) {

                    $body = $e->getJsonBody();

                    $err = $body['error'];

                    $stripeMessage = 'Error occured while transaction : ' . $err['message'] . "\n";

                }
                // dd($intent);
                
                $this->bookingRepository->registerPayment($bookingId);
                $this->bookingRepository->updateStatus($bookingId, 3);

                /*$booking->payment_method = "Stripe";*/
                $booking->status = 3;
                $booking->payment_method_id = 5;
                $booking->setPaymentMethod("Stripe");
                $booking->payment_date = new \DateTime();

                $booking->billing_name = $request->has('name') ? $request->get('name') : "";
                $booking->billing_address = $request->has('address') ? $request->get('address') : "";
                $booking->billing_address2 = $request->has('address2') ? $request->get('address2') : "";
                $booking->billing_city = $request->has('city') ? $request->get('city') : "";
                $booking->billing_post_code = $request->has('post_code') ? $request->get('post_code') : "";
                $booking->billing_telephone = $request->has('phone') ? $request->get('phone') : "";
                $booking->billing_email = $request->has('email') ? $request->get('email') : "";
                $booking->billing_country = $request->has('country') ? $request->get('country') : "";
                $booking->stripe_charge_id = $intent->charges->data[0]->id ? $intent->charges->data[0]->id :'';
                $this->sendBookingEmail($booking, $centreDetails->email);

                $booking->save();
                
            } elseif ($request->has('source')) {
                $source = \Stripe\Source::retrieve($request->get('source'));
                $metadata = [
                    'firstname' => $source->metadata->firstname,
                    'email' => $source->metadata->email,
                    'shippingto' => $source->metadata->shippingto,
                    'postal_code' => $source->metadata->postal_code,
                    'locality' => $source->metadata->locality,
                    'address1' => $source->metadata->address1,
                    'paytype' => $source->metadata->paytype,
                    'amount' => $source->metadata->amount,
                ];
                $charge = \Stripe\Charge::create([
                    'amount' => $source->amount,
                    'currency' => $source->currency,
                    'source' => $source->id,
                    'metadata' => $metadata,
                ]);
                $this->bookingRepository->registerPayment($bookingId);
                $this->bookingRepository->updateStatus($bookingId, 3);
                $booking->payment_date = new \DateTime();
                $booking->payment_method_id = 5;
                $booking->status = 3;
                $booking->setPaymentMethod("Stripe");
                $booking->save();
                $this->sendBookingEmail($booking, $centreDetails->email);
            } else if ($request->has('klarna_order_id')) { //klarna

                $orderId = $request->input('klarna_order_id');

                if ($orderId) {

                    $klarnaAdminNotifierBookingDetails = new KlarnaAdminNotifierBookingDetails(
                        $booking->name,
                        $booking->address,
                        $booking->postal_code,
                        $booking->email,
                        $booking->products,
                        "Booking made by " . $booking->name,
                        $this->bookingUtil->getTotalPrice($booking->products, $bookingFee),
                        [$centreDetails->users()->first()->email]);

                    $orderResponse = $this->klarna->confirmBooking($orderId, $bookingId, $klarnaAdminNotifierBookingDetails, false);
                    //dd($orderResponse['shipping_address']["street_address"], $orderResponse['shipping_address']["postal_code"], $orderResponse['shipping_address']["city"], $orderResponse['shipping_address']["country"], $orderResponse['shipping_address']["email"], $orderResponse['shipping_address']["phone"]);
                    //jamesf

                    $booking->status = 3;
                    $booking->billing_email = $orderResponse['billing_address']['email'];
                    $booking->email = $orderResponse['billing_address']['email'];

                    $name = "";
                    $name .= $orderResponse['billing_address']['given_name'] != null ? $orderResponse['billing_address']['given_name'] . " " : "";
                    $name .= $orderResponse['billing_address']['family_name'] != null ? $orderResponse['billing_address']['family_name'] : "";

                    $booking->billing_name = $name;
                    $booking->billing_address = $orderResponse['billing_address']["street_address"] != null ? $orderResponse['billing_address']["street_address"] : "";
                    $booking->billing_city = $orderResponse['billing_address']["city"] != null ? $orderResponse['billing_address']["city"] : "";
                    $booking->billing_post_code = $orderResponse['billing_address']["postal_code"] != null ? $orderResponse['billing_address']["postal_code"] : "";
                    $booking->billing_telephone = $orderResponse['billing_address']["phone"] != null ? $orderResponse['billing_address']["phone"] : "";
                    $booking->billing_email = $orderResponse['billing_address']["email"] != null ? $orderResponse['billing_address']["email"] : "";
                    $booking->billing_country = $countryRepository->getCountryIdFromShortcode($orderResponse['billing_address']["country"]);

                    $klarnaSnippet = $orderResponse['gui']['snippet'];

                    $this->klarna->klarnaDatabase->updateStatus($bookingId, 1);
                    $this->klarna->klarnaDatabase->updateCustomerDetails($bookingId, $orderResponse['shipping_address']["street_address"], $orderResponse['shipping_address']["postal_code"], $orderResponse['shipping_address']["city"], $orderResponse['shipping_address']["country"], $orderResponse['shipping_address']["email"], $orderResponse['shipping_address']["phone"]);
                    $booking->payment_method = "Klarna";
                    $booking->payment_method_id = 4;

                    $booking->save();
                    $this->sendBookingEmail($booking, $centreDetails->email);

                }
            } else {

                // For Getting Accutual Price
                $RemaningPrice = BookingProduct::where('booking_id', $bookingId)->select('price')->first();
                // For Changes The Reserve Price
                BookingProduct::where('booking_id', $bookingId)->update(["reserve_price" => 0, 'reserve_rest_price' => $RemaningPrice->price]);
                //jackrabbit
                $booking->name = $request->input('name');
                $booking->address = $request->input('address');
                $booking->post_code = $request->input('post_code');
                $booking->billing_email = $request->get('billing_email');

                //company - 1, individual - 2
                $booking->customer_type = $request->input('customerType');
                $booking->country = $request->input('country');

                $booking->billing_name = $request->has('name') ? $request->get('name') : "";
                $booking->billing_address = $request->has('address') ? $request->get('address') : "";
                $booking->billing_address2 = $request->has('address2') ? $request->get('address2') : "";
                $booking->billing_city = $request->has('city') ? $request->get('city') : "";
                $booking->billing_post_code = $request->has('post_code') ? $request->get('post_code') : "";
                $booking->billing_telephone = $request->has('phone') ? $request->get('phone') : "";
                $booking->billing_email = $request->has('billing_email') ? $request->get('billing_email') : "";
                $booking->billing_country = $request->has('country') ? $request->get('country') : "";

                // $this->bookingRepository->updateStatus($bookingId, 1);
                $booking->status = 3;

                $booking->payment_method_id = $paymentRepository->getPaymentMethodIdFromShortCode($request->input('paymentMethod'));
                $booking->payment_method = $request->input('paymentMethod');
                // dd($booking->email);
                $this->sendBookingEmail($booking, $centreDetails->email);
                $booking->save();

            }

            Session::forget('bookingId');
            Session::forget('klarnaSnippet');
            $klarnaDetails = $userUtil->getCentreKlarnaDetails($centreId);

            return view('booking.confirmation')->with([
                "bookingStep" => "confirmation",
                "navPage" => $this->navPage,
                "booking" => $booking,
                "klarnaSnippet" => $klarnaSnippet,
                "centreDetails" => $centreDetails,
                "hideMenu" => true,
                "klarnaDetails" => $klarnaDetails,
                "stripeMessage" => $stripeMessage,
                "mmenutype" => "none",
            ]);
        } else {
            die("<a href='/booking'>" . trans('booking/index.bookingLost') . "</a>");
        }
    }

    public function calcAdminFee()
    {
        //$booking = Booking::find(202)->adminFee();
        $booking = Booking::find(202);
        $emailProductTable = "";

        foreach ($booking->products as $product) {

            if (!$product->isFee()) {

                $productPrice = $this->pricingUtil->getLowestPrice($product['id'], $product->pivot['startDateTime'], $product->pivot['endDateTime']);

                $startDateTime = $product->pivot['startDateTime'] != "2000-01-01 00:00:00" ? $product->pivot['startDateTime'] : "";
                $endDateTime = $product->pivot['endDateTime'] != "2000-01-01 00:00:00" ? $product->pivot['endDateTime'] : "";
                $quantity = $product->pivot['quantity'];
                $emailProductTable .= "<tr><td>" . $quantity . "st " . $product['name'] . "</td><td>" . $startDateTime . "</td><td>" . $endDateTime . "</td><td style='width:100px;text-align:center'>" . $productPrice . "</td>";
            } else {

                $emailProductTable .= "<tr><td>" . $product['name'] . "</td><td></td><td></td><td style='width:100px;text-align:center'>" . $booking->adminFee() . "</td>";

            }
        }
        echo $emailProductTable;
    }

    //Todo: refacor the below:
    public function sendBookingEmail($booking, $centreEmail)
    {
        // dd('test Email');
        $emailProductTable = "<style>table th { width:25% }</style><table><th width='100'>" . trans('booking/index.bookingEmailProduct') . "</th><th width='150'>" . trans('booking/index.bookingEmailStartDateTime') . "</th><th width='150'>" . trans('booking/index.bookingEmailEndDateTime') . "</th><th style='width:100px;text-align:center'>" . trans('booking/index.bookingEmailPrice') . "</th>";

        foreach ($booking->products as $product) {

            if (!$product->isFee()) {
                $productPrice = $this->pricingUtil->getLowestPrice($product['id'], $product->pivot['startDateTime'], $product->pivot['endDateTime']);

                $startDateTime = $product->pivot['startDateTime'] != "2000-01-01 00:00:00" ? $product->pivot['startDateTime'] : "";
                $endDateTime = $product->pivot['endDateTime'] != "2000-01-01 00:00:00" ? $product->pivot['endDateTime'] : "";
                $quantity = $product->pivot['quantity'];
                $emailProductTable .= "<tr><td>" . intval($quantity) . " st " . $product['name'] . "</td><td>" . $startDateTime . "</td><td>" . $endDateTime . "</td><td style='width:100px;text-align:center'>" . $productPrice . " kr</td>";
            } else {

                $emailProductTable .= "<tr><td>" . $product['name'] . "</td><td></td><td></td><td style='width:100px;text-align:center'>" . $booking->adminFee() . " kr</td>";

            }
        }
        $emailProductTable .= "</table>";

        $cancelLink = "http://$_SERVER[HTTP_HOST]/booking/cancel/" . $booking->id . "/" . $booking->token;

        $this->bookingEmailer->newBooking($booking->email, $booking->name, $cancelLink, $emailProductTable, $centreEmail);

    }

    public function edit()
    {
        return view('booking.edit')->with([
            "bookingStep" => "edit",
            "navPage" => $this->navPage,
            "hideMenu" => true,
            "mmenutype" => "none",
        ]);
    }

    private function getKlarna($booking, $extraFees = 0)
    {
        if ($this->klarna) {
            $cart = array();

            foreach ($booking->products as $key => $product) {

                $cart[] = array(
                    //'reference' =>  (string)$product->id,
                    'reference' => $booking->getProductIdentifier($product->pivot->id),
                    'name' => $product->name,
                    'quantity' => (int) $product->pivot->quantity,
                    'unit_price' => (float) (($product->pivot->price * 100) / $product->pivot->quantity),
                    'discount_rate' => 0,
                    'tax_rate' => 2500);
            }

            if ($extraFees != 0) {
                $cart[] = array(
                    'reference' => (string) 999,
                    'name' => "Booking fee",
                    'quantity' => 1,
                    'unit_price' => (float) $extraFees * 100,
                    'discount_rate' => 0,
                    'tax_rate' => 2500);
            }
            //dd($cart, $booking->name, $booking->address, $booking->post_code, $booking->email);

            //$this->klarnaService = App::make('App\BokaKanot\Interfaces\KlarnaBillingInterface',  $parameters);
            //dd($parameters);
            $params = ['centreId' => $booking->centre_id];
            $KlarnaCentre = App::make('App\BokaKanot\Klarna\KlarnaCentre', $params);

            $snippet = $this->klarna->klarnaService->checkout($cart, $booking->name, $booking->address, $booking->post_code, $booking->email, $KlarnaCentre->extraRentalDetails($booking->name, $booking->firstStartDateTime(), $booking->lastEndDateTime(), $booking->totalProductsPrice()));

        } else {
            return "";
        }

        return $snippet;
    }

    public function testuser()
    {
        $DB = new App\BokaKanot\KlarnaDatabase();
        $DB->saveKlarnaOrderIdReservationId("123", 555, 7);
        return view('booking.index')->with([
            "bookingStep" => "book",
            "navPage" => "test",
            "categories" => [],
            "subCategories" => [],
            "mmenutype" => "none",
        ]
        );
        // dd(Auth::user()->centres()->first()->id);
    }

    public function userHasAccess()
    {
        dd(Booking::find(231)->userHasAccess(33));
    }

    public function updateProductQuantity(Request $request)
    {
        $newQuantity = $request->get('value');

        $bookingProductId = $request->get('pk');
        $bookingProduct = $this->bookingRepository->getBookingProduct($bookingProductId)[0];

        $bookingId = $bookingProduct->booking_id;
        $oldPrice = $bookingProduct->price;
        $oldQuantity = $bookingProduct->quantity;
        $removeQuantity = $oldQuantity - $newQuantity;
        $booking = $this->bookingRepository->getDetails($bookingId);

//dd(Auth::user()->id, Auth::check(), $booking->userHasAccess(Auth::user()->id), $booking->productInTimeToCancel($bookingProduct->product_id));

        if (Auth::check() and $booking->userHasAccess(Auth::user()->id) or $booking->productInTimeToCancel($bookingProduct->id)) {

            $productUnitPrice = $oldPrice / $oldQuantity;

            $newPrice = $productUnitPrice * $newQuantity;
            $refundAmount = $oldPrice - $newPrice;
/*dd($productUnitPrice, $oldPrice, $oldQuantity, $newPrice, $refundAmount);
 */
            //$updateKlarna = $this->klarna->updateCart($booking->klarna_reservationId, $booking->klarna_orderId, $booking->products, $booking->getKlarnaBookingAddress());
            if ($booking->paymentMethodIsKlarna()) {
                $booking->updateKlarna($request->get('pk'), $removeQuantity);

                BookingInvoice::find($booking->getProductInvoice($request->get('pk'))->id)->partiallyRefundAmount($refundAmount);

            } elseif ($booking->paymentMethodIsStripe()) { //Totally - refactor

                $this->bookingStripe->refund($booking->centre_id, $refundAmount, $booking->stripe_charge_id);

            }

            $this->bookingRepository->updateBookingProductQuantityPrice($bookingProductId, $newQuantity, $newPrice);
            //Session::flash('flashMessage', trans('errors/booking.productRemovedMessage'));
            return $newPrice;

        }
        //Update Klarna
    }

    private function addAdminFee($bookingId, $adminFee, $quantity, $centreId)
    {
        $totalPrice = $adminFee * $quantity;

        $centresFixedCategory = $this->categoryRepository->getFeeCategory($centreId);

        if (!$centresFixedCategory) {
            dd('No fixed category error');
        }

        $feeProductId = $this->productRepository->getAdminProduct($centresFixedCategory);

        $item['productId'] = $feeProductId;

        if (!$item['productId']) {
            dd('no fee product error');
        }

        $feeRecord = $this->bookingRepository->getFeeRecord($feeProductId, $bookingId);

        if ($feeRecord) {
            $this->bookingRepository->updateBookingProductQuantityPrice($feeRecord->id, $quantity, $totalPrice);
        } else {
            $item['quantity'] = $quantity;
            $item['booking_id'] = $bookingId;
            $item['per_type_time_id'] = 1;
            $item['price'] = $totalPrice;
            $item['startDateTime'] = "2000-01-01 00:00:00";
            $item['endDateTime'] = "2000-01-01 00:00:00";

            $this->bookingRepository->createBookingProduct($item, $bookingId, $totalPrice);
        }
    }
    
    
    

}
