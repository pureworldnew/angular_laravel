<?php namespace App\BokaKanot;

use App\BokaKanot\Repositories\CentreRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class UserUtil
{
    /**
     * @var CentreRepository
     */
    private $centreRepository;

    public function __construct(CentreRepository $centreRepository)
    {
        $this->centreRepository = $centreRepository;
    }

    public function getCentreKlarnaDetails ($centreId)
    {
        return $this->centreRepository->getCentreKlarnaDetails($centreId);
    }

    public function getUserCentreId ($request)
    {
        if(Auth::check()) {

            return  Auth::user()->centres()->first()->id;
        }
        else {
            if($request->session()->has('centreId'))
            {
                return $request->session()->get('centreId');
            }
            return 0;
        }

    }

    public function getCentreEmail(Request $request)
    {
        $centreId = $this->getUserCentreId($request);
        $centreDetails = $this->centreRepository->getCentreDetails($centreId)[0];
        return $centreDetails->users()->first()->email;
    }

    public function getCurrentLanguage()
    {
        return App::getLocale();
    }

    public function getCentreKlarna($centreId)
    {

        $klarnaDetails = $this->getCentreKlarnaDetails($centreId);

        if($klarnaDetails <> null and sizeof($klarnaDetails->payment_methods) > 0)
        {
            $parameters['EID'] = $klarnaDetails->getKlarnaApiKey();
            $parameters['checkout_uri'] = "http://$_SERVER[HTTP_HOST]"."/booking/pay";
            $parameters['confirmation_uri'] = "http://$_SERVER[HTTP_HOST]"."/booking/confirmation";
            $parameters['push_uri'] = "http://$_SERVER[HTTP_HOST]"."/klarna/push";
            $parameters['terms_uri'] = "http://$_SERVER[HTTP_HOST]"."/".$klarnaDetails->urlSlug."/terms";
            $parameters['sharedSecret'] = $klarnaDetails->getKlarnaApiSecret();
            $parameters['language'] = App::getLocale();
            $parameters['testMode'] = $klarnaDetails->klarna_test_mode;

            //$this->klarnaService = App::make('App\BokaKanot\Interfaces\KlarnaBillingInterface',  $parameters);
//dd($parameters);
            return App::make('App\BokaKanot\Klarna', $parameters);
        }
        else
        {
            return 0;
        }


    }
    
    public function getCentreBookingFee($centreId)
    {
        return $this->centreRepository->getCentreBookingFee($centreId);
    }

    public function getCentreAdminFee($centreId)
    {
        return $this->centreRepository->getCentreAdminFee($centreId);
    }

    public function getCentreConfirmBookingDetails($centreId)
    {
        return $this->centreRepository->getCentreConfirmBookingDetails($centreId);
    }

    public function getCentreLogo($centreId)
    {
        return $this->centreRepository->getCentreLogo($centreId);
    }
}