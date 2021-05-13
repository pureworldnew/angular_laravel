<?php

namespace App\Http\Controllers;

use App\Article;
use App\BokaKanot\Repositories\BookingRepository;
use App\BokaKanot\Repositories\CentreRepository;
use App\BokaKanot\UserUtil;
use Illuminate\Http\Request;
use App\User;
use App\CenterUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    private $navPage;
    /**
     * @var UserUtil
     */
    private $userUtil;

    public function __construct(UserUtil $userUtil)
    {
        $this->middleware('auth');
        $this->userUtil = $userUtil;
    }

    public function resources() {
           new CenterUser;
            $user_tyep = CenterUser::find(Auth::user()->id);
            
            $usertype =  $user_tyep->user_type_id;
        return view('admin.resources')->with([
                "navPage" => "resources",
                "resourceType" => "",
                "user_type" => $usertype,
                 "mmenutype" => "none"
            ]
        );
    }

    public function resourceType($resourceType) {

            new CenterUser;
            $user_tyep = CenterUser::find(Auth::user()->id);
            
            $usertype =  $user_tyep->user_type_id;
        return view('admin.resources')->with([
                "navPage" => "resources",
                "resourceType" => $resourceType,
                "user_type" => $usertype,
                "mmenutype" => "none"
            ]
        );
    }

    public function resourceTypeAction($resourceType, $action) {

        if ($action == "add" and $resourceType == "categories")
        {
            new CenterUser;
            $user_tyep = CenterUser::find(Auth::user()->id);
            
            $usertype =  $user_tyep->user_type_id;
        
            return view('admin.resources.categories.create')->with([
                    "navPage" => "resources",

                    "resourceType" => $resourceType,
                    "user_type" => $usertype,
                    "mmenutype" => "none"
                ]
            );
        }

        if ($action == "add" and $resourceType == "products")
        {
            $article = new Article();
        new CenterUser;
        $user_tyep = CenterUser::find(Auth::user()->id);
        
        $usertype =  $user_tyep->user_type_id;
            return view('admin.resources.products.create')->with([
                    "navPage" => "resources",

                    "resourceType" => $resourceType,
                    "article" => $article,
                    "user_type" => $usertype,
                    "mmenutype" => "none"
                    
                ]
            );
        }

    }

    public function settings(CentreRepository $centreRepository, Request $request) {

        $centreId = Auth::user()->centres()->first()->id;

        $centre = $centreRepository->getCentreDetails($centreId)[0];
        //dd(Auth::user()->id, $centreId, $centre, $request->session()->get('centreId'));

        $sessionMessage = "You are set to book CentreId ".$this->userUtil->getUserCentreId($request).".";
        
        $sessionMessage .= "<p><a href='/booking/".$centre->urlSlug."/".App::getLocale()."'>Please click here for your booking system</a></p>";

        //dd($centre->payment_methods->toArray());

        //dd($centre->payment_methods[0]->pivot->active);
       /* $centre->payment_methodsArray = array();

        foreach($centre->payment_methods as $key => $paymentMethod)
        {
            //dd($paymentMethod);
            $centre->payment_methodsArray[$key] = $paymentMethod->pivot->active;
        }*/

        /* @foreach($centre->media as $media)
        {!! Form::text('media['.$media->id.'][title]',$media->title) !!}
        @endforeach*/
//dd($centre->payment_methods[0]['pivot']['active'],$centre->payment_methods[1]['pivot']['active']);

        $paymentMethods = $centreRepository->getCentrePaymentMethodsWithInactive($centreId);
        $customTexts = $centreRepository->getCustomTexts($centreId);

        $lastField = "";
        $fields = Array();

        foreach($customTexts as $customText)
        {
            $fields[$customText->field_name][$customText->language] = $customText->field_value;/*
            if($customText->field_name <> $lastField)
            {
                $lastField = $customText->field_name;
                $fields[$customText->field_name][$customText->language] = $customText->field_value;
            }*/
        }
        new CenterUser;
        $user_tyep = CenterUser::find(Auth::user()->id);
        
        $usertype =  $user_tyep->user_type_id;
        //dd(!array_key_exists("intro_text", $customTexts));
        //dd($customTexts, $fields);
        return view('admin.settings')->with([
                "navPage" => "settings",
                "centre" => $centre,
                "paymentMethods" => $paymentMethods,
                "customTexts" => $fields,
                "sessionMessage" => $sessionMessage,
                "user_type" => $usertype,
                "mmenutype" => "none"
            ]
        );
    }

   /* public function bookings() {

        return view('admin.bookings')->with([
                "navPage" => "bookings",
                "navPage" => $this->navPage
            ]
        );
    }*/

    public function users() {
        // check user type 
        new CenterUser;
        $user_tyep = CenterUser::find(Auth::user()->id);
        
        $usertype =  $user_tyep->user_type_id;

        return view('admin.users')->with([
                "navPage" => "users",
                "reportType" => "",
                "user_type" => $usertype,
                "mmenutype" => "none"
            ]
        );
    }

    public function reports() {
        new CenterUser;
        $user_tyep = CenterUser::find(Auth::user()->id);
        
        $usertype =  $user_tyep->user_type_id;
        
        return view('admin.reports')->with([
                "navPage" => "reports",
                "reportType" => "",
                 "user_type" => $usertype,
                 "mmenutype" => "none"
            ]
        );
    }

    public function reportType($reportType, BookingRepository $bookingRepository, Request $request) {

        $reportsData = [];
        $bookings = [];
        $searchDateTime = $request->input('searchDateTime') ? $request->input('searchDateTime')  : date("Y-m-d");
        $startdatetime = date("Y-m-d 00:00:00");
        $enddatetime = date('Y-m-d', strtotime('+2 week', strtotime($startdatetime)));

        if ($reportType == "gantt")
        {
            $reportsData = json_encode($bookingRepository->getBookingProducts(Auth::user()->centres()->first()->id, $startdatetime, $enddatetime));
            //The above is an object, we need it as an array, so an array of arrays. Then I can return this with json_encode

/*            $reportsData = "[ 'Kayak Explorer #11111', 'Adam Alsing', new Date(2015, 3, 1), new Date(2015, 3, 4) ],
            [ 'Kayak Explorer #8', 'Adam Alsing', new Date(2015, 3, 1), new Date(2015, 3, 4) ],
            [ 'Kayak Explorer #5', 'Nils Malm', new Date(2015, 3, 2, 12, 0, 0), new Date(2015, 3, 3, 12, 0, 0) ]";*/
        }
        if($reportType == "table")
        {
            $bookings = $bookingRepository->getBookings($searchDateTime, Auth::user()->centres()->first()->id);
        }
                 new CenterUser;
                $user_tyep = CenterUser::find(Auth::user()->id);
                
                $usertype =  $user_tyep->user_type_id;
        return view('admin.reports')->with([

                "adminPage" => "reports",
//                "navPage" => $this->navPage,
                "reportType" => $reportType,
                "reportsData" => $reportsData,
                "bookings" => $bookings,
                "searchDateTime" =>$searchDateTime,
                "navPage" => "reports",
                "user_type" => $usertype,
                "mmenutype" => "none"
            ]
        );
    }

    public function index(CentreRepository $centreRepository, Request $request)
    {
        $centreId = Auth::user()->centres()->first()->id;
        $centre = $centreRepository->getCentreDetails($centreId)[0];
        //dd(Auth::user()->id, $centreId, $centre, $request->session()->get('centreId'));
        $sessionLink = "/booking/".$centre->urlSlug."/".App::getLocale();
        
                 new CenterUser;
                $user_tyep = CenterUser::find(Auth::user()->id);
                
                $usertype =  $user_tyep->user_type_id;
        return view('admin.index')->with([
                "navPage" => "index",
                "linkToForm" => $sessionLink,
                "user_type" => $usertype,
                "mmenutype" => "none"
            ]
        );
    }


}
