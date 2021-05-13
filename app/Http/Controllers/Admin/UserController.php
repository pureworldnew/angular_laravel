<?php

namespace App\Http\Controllers\Admin;

use App\AdminInvitation;
use App\Centre;
use App\MangInvitation;
use App\FrontInvitation;
use App\BokaKanot\Repositories\CentreRepository;
use App\BokaKanot\UserUtil;
use App\Http\Requests\Admin\NewUserRequest;
use Illuminate\Http\Request;
use App\FrontendProfile;
use DB;
use App\CenterUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * @var CentreRepository
     */
    private $centreRepository;
    /**
     * @var UserUtil
     */
    private $userUtil;

    public function __construct(CentreRepository $centreRepository, UserUtil $userUtil)
    {

        $this->centreRepository = $centreRepository;
        $this->userUtil = $userUtil;
    }

    public function invite(Request $request){


        $centreId = Auth::user()->centres()->first()->id;

        $data['toEmail'] = $request->input('email');
        $data['centreEmail'] = $this->centreRepository->getCentreDetails($centreId)[0]->users->first()->email;
        $data['status'] = $request->status;

        $token = str_random(64);
        
        if($request->status == 'admin'){
            
           $invite = new AdminInvitation();
            $invite->email = $request->input('email');
            $invite->centre_id = $centreId;
            $invite->token = $token;
            $invite->save();
            
            $data['intro'] = 'Become an admin';

            $data['text'] = 'You have been invited as admin';
            
            $data['cancelLink'] = "http://$_SERVER[HTTP_HOST]/admin/users/invited/".$request->input('email')."/$centreId/$token";
    
            Mail::send('emails.inviteNewCentreAdmin', $data, function($message) use ($data)
            {
                //Config::get('mail.superAdmin')
                $message->to($data['toEmail'], $data['toEmail'])
                    ->subject(trans('emails/inviteNewCentreAdmin.subject'));
            });
        
        
            Session::flash('flashMessage', trans('emails/inviteNewCentreAdmin.adminInvited'));
    
            return redirect('/admin/users');
        }
        elseif($request->status == 'manager'){
            $invite = new MangInvitation();
            $invite->email = $request->input('email');
            $invite->centre_id = $centreId;
            $invite->token = $token;
            $invite->save();
            
            
            $data['status'] = 'Manager';
  
            $data['intro'] = 'Become a manager';
            $data['text'] = 'You have been invited as manager';
          
             $data['cancelLink'] = "http://$_SERVER[HTTP_HOST]/admin/users/minvited/".$request->input('email')."/$centreId/$token";
    
            Mail::send('emails.inviteNewCentreAdmin', $data, function($message) use ($data)
            {
                //Config::get('mail.superAdmin')
                $message->to($data['toEmail'], $data['toEmail'])
                    ->subject(trans('Become a manager'));
            });
        
        
            Session::flash('flashMessage', trans('chef inbjuden'));
    
            return redirect('/admin/users');
            
            
            
            
        }
        elseif($request->status == 'frontend'){
            $data['status'] = 'Front end User';
            $data['intro'] = 'Become a user';
            
            $invite = new FrontInvitation();
            $invite->email = $request->input('email');
            $invite->centre_id = $centreId;
            $invite->token = $token;
            $invite->save();

            $data['text'] = 'You have been invited as front end user';
            
            
             $data['cancelLink'] = "http://$_SERVER[HTTP_HOST]/admin/users/uinvited/".$request->input('email')."/$centreId/$token";
    
            Mail::send('emails.inviteNewCentreAdmin', $data, function($message) use ($data)
            {
                //Config::get('mail.superAdmin')
                $message->to($data['toEmail'], $data['toEmail'])
                    ->subject(trans('emails/inviteNewCentreAdmin.subject'));
            });
        
        
            Session::flash('flashMessage', trans('främre slutanvändare inbjuden'));
    
            return redirect('/admin/users');

        }
        else{
            Session::flash('flashMessage', trans('invalid request'));
    
            return redirect('/admin/users');
        }
       
    }

    public function invited ($email, $centreId, $token) {

        if(Auth::check()) {

            Auth::logout();

            //return redirect("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

        }
        $query = AdminInvitation::where('token', $token)->where('email', $email)->where('centre_id', $centreId)->first();
        if(!empty($query)){
            Session::flash('invited', true);
            Session::flash('centreId', $centreId);
            Session::flash('centreName', $this->centreRepository->getCentreDetails($centreId)[0]->name);

            return redirect('/register');
        }
        else
        {
            dd('Registration is not possible without and invitation');
        }
    }


    
    // for invited manager
    
    public function minvited ($email, $centreId, $token) {

        if(Auth::check()) {

            Auth::logout();

            //return redirect("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

        }
        $query = MangInvitation::where('token', $token)->where('email', $email)->where('centre_id', $centreId)->first();
        if(!empty($query)){
            Session::flash('invited', true);
            Session::flash('centreId', $centreId);
            Session::flash('email', $email);
            Session::flash('centreName', $this->centreRepository->getCentreDetails($centreId)[0]->name);

            return redirect('/MRegister');
        }
        else
        {
            dd('Registration is not possible without and invitation');
        }
    }
    
    public function uinvited ($email, $centreId, $token) {

        if(Auth::check()) {

            Auth::logout();

            //return redirect("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

        }
        $query = FrontInvitation::where('token', $token)->where('email', $email)->where('centre_id', $centreId)->first();
        if(!empty($query)){
            Session::flash('invited', true);
            Session::flash('centreId', $centreId);
            Session::flash('email', $email);
            Session::flash('centreName', $this->centreRepository->getCentreDetails($centreId)[0]->name);
            
            return redirect('/usignup')->with(['email' => $email]);;
        }
        else
        {
            dd('Registration is not possible without and invitation');
        }
    }
    
    public function FrontProfile(){
        
         if(Auth::check()) {
             // fetch the user profile and display it on the page
             new FrontendProfile;
             $user_id = Auth::user()->id;
             $profile = FrontendProfile::where('user_id', '=', $user_id)->get()->first();
             
            // get the store details
             $store = CenterUser::where('user_id', '=', $user_id)->get()->first();
             $storeid = $store->centre_id;
             $fetchstore = Centre::where('id', '=', $storeid)->get()->first();

       
        $sessionMessage = "<a href='/booking/".$fetchstore->urlSlug."/".App::getLocale()."' class='button'>Go To Store</a>";
                        

             return view('booking.profile')->with([
            "profile" => $profile,
            "navPage" => "users",
            'store' => $fetchstore,
            "sessionMessage" => $sessionMessage,
        ]
        );
         }
         else{
              return redirect('/ulogin')->with(Auth::logout());
         }

          
    }
    
    public function EditProfile(Request $request){
        if(Auth::check()) {
             $user_id = Auth::user()->id;
            
            $result = FrontendProfile::where('user_id', $user_id)->update($request->only(['name', 'address', 'zipcode', 'city', 'country', 'email']));
            if($result){
                 return redirect('/frontprofile')->withErrors(
                    [
                        'error' => 'Profile Updated'
                    ]
                );
            }
            else{
                return redirect('/frontprofile')->withErrors(
                    [
                        'error' => 'Error is saving Profile'
                    ]
                );
            }
            
          
         }
         else{
              return redirect('/ulogin')->with(Auth::logout());
         }
    }

    public function ulogout(){
        // get store url
        //redirect to the url with logout 
         new FrontendProfile;
             $user_id = Auth::user()->id;
             $profile = FrontendProfile::where('user_id', '=', $user_id)->get()->first();
             
            // get the store details
             $store = CenterUser::where('user_id', '=', $user_id)->get()->first();
             $storeid = $store->centre_id;
             $fetchstore = Centre::where('id', '=', $storeid)->get()->first();
            
            $sessionLink = "http://bokokanot.frontlinewebdevelopers.com/booking/".$fetchstore->urlSlug."/".App::getLocale();
     
        
         return Redirect::away($sessionLink)->with(Auth::logout());

    
        
    }


}
