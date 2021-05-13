<?php

namespace App\Http\Controllers;

use App\BokaKanot\Repositories\SearchRepository;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use App\CenterUser;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('centreId'))
        {
            Session::set('centreId', $request->input('centreId'));

        }


        /*if ($request->session()->has('centreId'))
        {
            $sessionMessage = "You are set to book CentreId ".$request->session()->get('centreId').".";
        }
        else
        {
            $sessionMessage = "<h5>No centreId selected</h5><p><a href='/?centreId=1'>Please click here for default test centre</a></p>";
        }*/
        if(Auth::user()){
             new CenterUser;
            $user_tyep = CenterUser::find(Auth::user()->id);
            
            $usertype =  $user_tyep->user_type_id;

        }
        else{
            $usertype = "";
        }
          
        return view('index')->with([
                "navPage" => "home",
                "mmenutype" => "none",
                "user_type" => $usertype,
            ]
        );
    }
}
