<?php

namespace App\Http\Controllers\Auth;

use App\BokaKanot\Repositories\CentreRepository;
use App\Centre;
use App\CentrePaymentMethods;
use App\PaymentMethods;
use App\User;
use App\CenterUser;
use App\Booking;
use App\FrontendProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/resources/categories';
    /**
     * @var CentreRepository
     */
    private $centreRepository;
    //protected $guard = 'web';
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(CentreRepository $centreRepository)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->centreRepository = $centreRepository;
    }
    
    public function adminloginsubmit(Request $request){
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        
         $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required'
        ]);


        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        if(Auth::guard($this->getGuard())->attempt(['email' => $request->email, 'password' => $request->password])){
            // get user type
            new CenterUser;
            $user_tyep = CenterUser::find(Auth::user()->id);
            
            $usertype =  $user_tyep->user_type_id;
            if($usertype == 1){
                return redirect('/admin/resources/categories');
            }
            elseif($usertype == 6){
                return redirect('/admin/resources/categories');
            }
            else{
                return redirect('/login')->with(Auth::logout())->withErrors(
                    [
                        'error' => 'Sorry only admin and manager allowed.'
                    ]
                )->withInput($request->only('email', 'remember'));
                
             }
        }
        else{
                return back()->withErrors(
                    [
                        'error' => 'Oops! You have entered invalid credentials'
                    ]
                )->withInput($request->only('email', 'remember'));
            }
        
    }

    public function register(Request $request)
    {
        if($request->has('centreId'))
        {
            $centreId = $request->get('centreId');
        }
        else
        {
            $centreId = 0;
        }

        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        // echo json_encode($request->all());

        // todo: below shoiuld be refactored
        if (getenv('APP_ENV') != 'local')
        {

            // Email the new signup:
            $data['email'] = $request->input('email');
            $data['name'] = $request->input('name');

            Mail::send('emails.welcome', $data, function($message) use ($data)
            {
                $message->to($data['email'], $data['name'])
                    ->subject('Welcome to BokaKanot.se');
            });

            // Email the super admin:
            $data['email'] = $request->input('email');
            $data['name'] = $request->input('name');



            Mail::send('emails.newSignup', $data, function($message) use ($data)
            {
                $message->to(Config::get('mail.superAdmin'), $data['name'])
                    ->subject('New user has signed up');
            });
        }

        
        
        Auth::guard($this->getGuard())->login($this->create($request->all(), $centreId));
        
        // if usertype is user, redirect to profile else send to the proper redirect path 
            new CenterUser;
            $user_tyep = CenterUser::find(Auth::user()->id);
            
            $usertype =  $user_tyep->user_type_id;
        if($usertype == 9){
            return redirect('/frontprofile');
        }
        else{
            return redirect($this->redirectPath());
        }
        
    }

    public function showRegistrationForm()
    {

        if(Session::has('invited'))
        {
            $centreId = Session::get('centreId');
            $centreName = Session::get('centreName');

            Session::flush();
            Session::flash('centreId', $centreId);
            Session::flash('centreName', $centreName);

        }
        else
        {
            Session::flush();
        }

        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }

        $navPage = 'register';
        $paymentMethods = PaymentMethods::all();

        return view('auth.register')->with(['navPage' => $navPage, 'paymentMethods' => $paymentMethods, 'mmenutype' => 'none']);
    }

   
    public function showLoginForm()
    {

        $view = property_exists($this, 'loginView')
            ? $this->loginView : 'auth.authenticate';

        if (view()->exists($view)) {
            return view($view);
        }
        $navPage = 'login';
        return view('auth.login')->with(['navPage' => $navPage, 'mmenutype' => "none"]);
    }
     /*
        Manager registration form and login 
    */
     public function MRegistrationForm()
    {

        if(Session::has('invited'))
        {
            $centreId = Session::get('centreId');
            $centreName = Session::get('centreName');

            Session::flush();
            Session::flash('centreId', $centreId);
            Session::flash('centreName', $centreName);

        }
        else
        {
            Session::flush();
        }

        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }

        $navPage = 'Manager registration';
        $paymentMethods = PaymentMethods::all();
        \App::setLocale('en');
        return view('auth.mregister')->with(['navPage' => $navPage, 'paymentMethods' => $paymentMethods, 'mmenutype' => "manager", 'mann' => "manager"]);
    }
    
    
    
    
     public function mLoginForm()
    {

        $view = property_exists($this, 'loginView')
            ? $this->loginView : 'auth.authenticate';

        if (view()->exists($view)) {
            return view($view);
        }
        $navPage = 'login';
        return view('auth.mlogin')->with(['navPage' => $navPage]);
    }
    
     /*
        User  registration form and login with profile
    */

 public function usignup()
    {

    $email = Session::get('email');
    
        
        if(Session::has('invited'))
        {
            $centreId = Session::get('centreId');
            $centreName = Session::get('centreName');
            $email = Session::get('email');
            
             Session::flush();
             Session::flash('centreId', $centreId);
             Session::flash('centreName', $centreName);
             Session::flash('email', $email);

        }
        else
        {
            Session::flush();
        }

        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }
        
        $navPage = 'User registration';
        $paymentMethods = PaymentMethods::all();
        //$emaill = Session::get('email');
         \App::setLocale('en');
        return view('auth.uregister')->with(['navPage' => $navPage, 'paymentMethods' => $paymentMethods, 'mmenutype' => "none", 'mann' => "manager"]);
    }
    
  public function ulogin()
    {

        $view = property_exists($this, 'loginView')
            ? $this->loginView : 'auth.authenticate';

        if (view()->exists($view)) {
            return view($view);
        }
        $navPage = 'login';
        return view('auth.ulogin')->with(['navPage' => $navPage]);
    }
    public function uloginsubmit(Request $request){
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        
         $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required'
        ]);


        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        if(Auth::guard($this->getGuard())->attempt(['email' => $request->email, 'password' => $request->password])){
            // get user type
            new CenterUser;
            $user_tyep = CenterUser::find(Auth::user()->id);
            
            $usertype =  $user_tyep->user_type_id;
            if($usertype == 9){
                return redirect('/frontprofile');
            }
            else{
                return redirect('/ulogin')->with(Auth::logout())->withErrors(
                    [
                        'error' => 'You are not a front end user'
                    ]
                )->withInput($request->only('email', 'remember'));
                
             }
        }
        else{
                return back()->withErrors(
                    [
                        'error' => 'Oops! You have entered invalid credentials'
                    ]
                )->withInput($request->only('email', 'remember'));
            }
        
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data, $centreId)
    {
        $User = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        
        


        if($centreId === 0)
        {
            $urlSlug = $this->getUrlSlug($data['centre']);

            $Centre = Centre::create([
                'name' => $data['centre'],
                'urlSlug' => $urlSlug,
                //'logo_url' => $data['logo_url'],
                'telephone' => $data['phone'],
                'address1' => $data['address'],
                'address2' => $data['address2'],
                'post_code' => $data['post_code'],
                'city' => $data['city'],
                'web_page' => $data['website']
                // 'num_pay_advance_days' => $data['num_pay_advance_days'],
                // 'invoice_text' => $data['invoice_text'],

            ]);

            $User->centres()->attach($Centre->id,  ['user_type_id' => 1]);
        }
        // 0 means it has not center id 
         elseif($centreId === 0 && $data['usertype'] == 'manager')
        {
            $User->centres()->attach($centreId,  ['user_type_id' => 2]);
        }
        elseif($centreId !== 0 && $data['usertype'] == 'front_end'){
            // this solves the problem of single user
            // 9 indicates the frontend user
            //$frontendid = 23;
            $User->centres()->attach($centreId,  ['user_type_id' => 9]);
            // add to the booking table 
            $x = json_encode($User);
            $json = json_decode($x, true);
             $user_id =  $json['id'];
            FrontendProfile::create([
                'name' => $data['name'],
                'user_id' => $user_id,
                'address' => $data['address'],
                'zipcode' => $data['zipcode'],
                'city' => $data['city'],
                'country' => $data['country'],
                'email' => $data['email'],
                'password' => $data['password']
            ]);
            
        }
        else{
            // 6 indicates that it manages a particular store
            $User->centres()->attach($centreId,  ['user_type_id' => 6]);
        }

        $paymentMethods = PaymentMethods::all();

        foreach ($paymentMethods as $paymentMethod)
        {
            if (isset($data[$paymentMethod->name]) && $data[$paymentMethod->name] == "true")
            {
                CentrePaymentMethods::create([
                    'payment_methods_id' => $paymentMethod->id,
                    'centre_id' => $Centre->id,
                    'active' => 1
                ]);
            }
            //<input type="checkbox" class="form-control" name="{{ $paymentMethod->name }}" value="{{ old($paymentMethod->name) }}"> <label>{{ $paymentMethod->name }}</label>
        }
        /*CentrePaymentMethods::create([
            'payment_option_id' =>
        ]);*/
        //$User->$User
        return $User;
    }

    private function getUrlSlug($centre)
    {
        //$centreName = removeSpacesEtc();
        //$slugName = "UrlSlug"; //$centre todo
        $slugName = strtolower(preg_replace('/[^\da-z]/i', '', $centre));

        $i = 1;

        while(sizeof($this->centreRepository->checkSlugExists($slugName)) > 0)
        {

            $slugName = rtrim($slugName, $i-1);
            $slugName = $slugName . $i;

            $i++;
        }

        return $slugName;

    }
}
