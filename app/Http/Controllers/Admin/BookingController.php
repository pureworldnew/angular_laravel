<?php

namespace App\Http\Controllers\admin;

use App\BokaKanot\Billing\StripeBilling;
use App\BokaKanot\Booking\BookingEmailer;
use App\BokaKanot\Repositories\BookingRepository;
use App\BokaKanot\Repositories\CentreRepository;
use App\BokaKanot\Repositories\InvoiceRepository;
use App\BokaKanot\UserUtil;
use App\Booking;
use App\CenterUser;
use App\BookingInvoice;
use App\BookingProduct;
use App\Events\ProductCredited;
use App\Http\Requests\RefundInvoiceRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BokaKanot\Booking as BookingUtils;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class BookingController extends Controller
{
    /**
     * @var BookingRepository
     */
    private $bookingRepository;
    /**
     * @var CentreRepository
     */
    private $centreRepository;
    /**
     * @var UserUtil
     */
    private $userUtil;
    /**
     * @var BookingEmailer
     */
    private $bookingEmailer;

    public function __construct(BookingRepository $bookingRepository, CentreRepository $centreRepository, UserUtil $userUtil, Request $request, BookingEmailer $bookingEmailer)
    {

        $this->middleware('auth');
        $this->bookingRepository = $bookingRepository;

        if(Auth::check())
            $this->klarna = $userUtil->getCentreKlarna(Auth::user()->centres()->first()->id);

        $this->centreRepository = $centreRepository;
        $this->userUtil = $userUtil;
        $this->bookingEmailer = $bookingEmailer;
    }

    public function index(Request $request)
    {

        $bookings = $this->bookingRepository->getBookingsObj(Auth::user()->centres()->first()->id);

               new CenterUser;
                $user_tyep = CenterUser::find(Auth::user()->id);
                
                $usertype =  $user_tyep->user_type_id;
        return view('admin.bookings')->with([
                "navPage" => "bookings",
                "bookings" => $bookings,
                "bookingsObj" => $bookings,
                "user_type" => $usertype
            ]
        );
    }

    public function picklist(Request $request)
    {
        $tz = 'Europe/Stockholm';
        $dt = new \DateTime("now", new \DateTimeZone($tz)); //first argument "must" be a string
        $currrentTimeDateString = $dt->format('Y-m-d H:i');
        $startDateString = date("Y-m-d")." 00:00:00";
        $endDateString = date("Y-m-d")." 23:59:59";
        $centreId = Auth::user()->centres()->first()->id;

        $booking_products = $this->bookingRepository->getBookingProducts($centreId, $startDateString, $endDateString);

        $bookings = array();
        foreach($booking_products as $product){
            if (!array_key_exists($product->id, $bookings)) {
                $dt_ready = new \DateTime($product->startDateTime, new \DateTimeZone($tz)); //first argument "must" be a string
                $readyTimeDateString = $dt_ready->format('H:i');

                $booking = array(
                    "id" => $product->id,
                    "bookingName" => $product->bookingName,
                    "email" => $product->email,
                    "telephone" => $product->telephone,
                    "times" => [],
                    "products" => [],
                    "payment_method" => $product->payment_method,
                    "paid" => $product->paid,
                    "status" => $product->status,
                    "readyTime" => $readyTimeDateString
                );
                $bookings[$product->id] = $booking;
            }
            $bookings[$product->id]["times"][] = $product->startDateTime." -- ".$product->endDateTime;
            $bookings[$product->id]["products"][] = intval($product->quantity)." st ".$product->productName;
        }

        foreach($bookings as $key=>$booking){
            $last_time = null;
            $identical = true;
            $use_this_time = null;
            foreach($booking["times"] as $time){
                if ($last_time==null OR $last_time==$time){
                    // identical
                    $use_this_time = $time;
                }
                else{
                    $identical=false;
                    break;
                }
            }
            if ($identical){
                // Only show one time row, because all are identical:
                $booking["times"] = $use_this_time;
            }
            else{
                // Keep all time rows
            }
        }
        
                new CenterUser;
                $user_tyep = CenterUser::find(Auth::user()->id);
                
                $usertype =  $user_tyep->user_type_id;

        return view('admin.picklist')->with([
                "navPage" => "picklist",
                "bookings" => $bookings,
                "bookingsObj" => $bookings,
                "currentTime" => $currrentTimeDateString,
                "user_type" => $usertype
            ]
        );
    }

    public function returnAmount(RefundInvoiceRequest $request)
    {
        //$booking = $this->bookingRepository->getDetails($request->get('bookingId'));

        //$invoice = $this->bookingRepository->getBpInvoice($request->get('invoiceId'));
        $invoice = BookingInvoice::find($request->get('invoiceId'));

        if(sizeof($invoice) > 0)
        {
            if ($request->get('discountAmount') > $invoice->amount - $invoice->discounted_amount)
            {
                $alreadyDiscounted = "";
                if($invoice->discounted_amount > 0) {
                    $alreadyDiscounted = trans('admin/bookings.alreadyDiscounted1').$invoice->discounted_amount." ".Config('booking.currencySymbol').")".trans('admin/bookings.alreadyDiscounted2');
                }

                Session::flash('flashMessageError', trans('admin/bookings.discountOverInvoice').$invoice->invoice_id.trans('admin/bookings.discountOverInvoice2').$invoice->amount." ".Config('booking.currencySymbol').$alreadyDiscounted);

            }
            else
            {
                $klarnaReturnAmount = $this->klarna->returnAmount($request->get('invoiceId'), $invoice->invoice_id, $request->get('discountAmount'), Config('booking.VAT_RATE'), $request->get('discountDescription'));

                if(!$klarnaReturnAmount['error'])
                {
                    Session::flash('flashMessage', trans('admin/bookings.invoiceCredited1').$invoice->invoice_id.trans('admin/bookings.invoiceCredited2'));
                }
                else
                {
                    Session::flash('flashMessageError', trans('admin/bookings.klarnaReturnAmountFailed').$invoice->invoice_id." - ".$klarnaReturnAmount['exception']);
                }
            }
        }
        else
        {
            //Invoice not found
            Session::flash('flashMessageError', trans('admin/bookings.invoiceCredited1').$invoice->invoice_id.trans('admin/bookings.invoiceCredited2'));
        }

        return redirect()->back();

    }
    
    public function show($id, InvoiceRepository $invoiceRepository)
    {
        Session::set('redirectUrl', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

        $bookingProducts = $this->bookingRepository->getBookingDetails($id);
        $booking = $this->bookingRepository->getDetails($id);
     
        $invoicesArray = $this->bookingRepository->getInvoicesArray($booking->id);

        $invoices = $invoiceRepository->getInvoices($invoicesArray);
        //dd($invoices);

              new CenterUser;
                $user_tyep = CenterUser::find(Auth::user()->id);
                
                $usertype =  $user_tyep->user_type_id;


        return view('admin.bookings.show')->with([
                "bookingProducts" => $bookingProducts,
                "navPage" => "admin",
                "adminPage" => "bookings",
                "booking" => $booking,
                "invoicesArray" => $invoicesArray,
                "invoices" => $invoices,
                "user_type" => $usertype
            ]
        );
    }

    public function refundProduct(Request $request)
    {
        //posting form to /booking/removeProduct instead of /admin/booking/refundProduct - the removeProduct method is complete there
        return redirect("admin/bookings");
    }

    public function registerPaymentProduct (Request $request)
    {
        $this->bookingRepository->registerPaymentProduct($request->input('bookingId'), $request->input('productId'));

        Session::flash('adminMessage', trans('admin/bookings.productActivated'));

        return redirect("admin/bookings");
    }

    public function registerPayment(Request $request)
    {

        $this->bookingRepository->registerPayment($request->input('bookingId'));

        Session::flash('adminMessage', trans('admin/bookings.productActivated'));

        return redirect("admin/bookings");
    }

    public function unregisterPayment(Request $request)
    {

        $this->bookingRepository->unregisterPayment($request->input('bookingId'));

        Session::flash('adminMessage', "Product Activated");

        return redirect("admin/bookings");
    }

    public function activateProduct(Request $request)
    {
        $booking = $this->bookingRepository->getDetails($request->input('bookingId'));

        if($booking->paymentMethodIsKlarna() AND $request->has('reservationId') AND $request->input('reservationId')<> "")
        {
            try {

                $this->klarna->activateAProduct($request->input('productId'), $request->input('reservationId'), $request->input('bookingId'), $request->input('quantity'), $request->input('bookingProductId'), $request->input('price'));
            }
            catch(\Exception $e)
            {
                Session::flash('flashMessage', "Error Activating with Klarna" + (string)$e);
                echo "<h1>Call to Klarna failed</h1>";
                echo "<p><a href='".$request->input('returnUrl')."'>Click here to return to admin</a></p>";
                dd($e);


                return redirect()->back();


            }
        }
        elseif($booking->paymentMethodIsCash() or $booking->paymentMethodIsTransfer() or $booking->paymentMethodIsInvoice())
        {
            $booking->activateProduct($request->input('productId'));
        }

        $this->bookingEmailer->activateProductEmail($booking->email, $booking->name, $this->userUtil->getCentreEmail($request), $request->input('bookingId'));
        Session::flash('flashMessage', trans('errors/booking.productActivated'));

        return redirect()->back();
    }

    public function cancel (Request $request) {

        if($request->has('bookingId'))
        {
            $booking = $this->bookingRepository->getDetails($request->input('bookingId'));
            
            $booking->cancelOrCreditBooking();

        }
        else
        {
            dd('No booking id provided');
        }

        return redirect()->back();

    }

   /* Try use the above instead as this is klarna only public function credit (Request $request) {

        //$this->canBeCredited()
        
        $this->klarna->credit($request->input('bookingId'), $request->input('invId'));


        return redirect("admin/booking/".$request->input('bookingId'));

    }*/

    public function activate(Request $request)
    {
        $bookingId = $request->input('bookingId');

        $booking = $this->bookingRepository->getDetails($bookingId);

        if($booking->paymentMethodIsKlarna())
        {
            $this->klarna->activateBooking($bookingId);
        }
        else
        {
            $booking->activateBooking();
            //$this->bookingRepository->updateBookingProductStatus($bookingId, config('booking.status.ACTIVATED'));
        }

        $this->bookingEmailer->activateEmail($booking->email, $booking->name, $this->userUtil->getCentreEmail($request), $request->input('bookingId'));

        Session::flash('flashMessage', trans('admin/bookings.bookingActivated'));
        
        return redirect()->back();
    }

    public function activateSelectedProducts (Request $request)
    {
        $this->klarna->activateSelectedProducts($request->input('selectedActivateProducts'), $request->input('reservationId'), $request->input('bookingId'));
        $booking = $this->bookingRepository->getDetails($request->input('bookingId'));

        $this->bookingEmailer->activateEmail($booking->email, $booking->name, $this->userUtil->getCentreEmail($request), $request->input('bookingId'));

        //$this->session->set_flashdata('adminMessage', 'Products Activated');

        return redirect("admin/booking/".$request->input('bookingId'));
    }

    public function refundSelectedProducts (Request $request)
    {
        $this->klarna->refundSelectedProducts($request->input('selectedCancelProducts'), $request->input('bookingId'));


        //$this->session->set_flashdata('adminMessage', 'Products Activated');

        return redirect("admin/booking/".$request->input('bookingId'));
    }
}
