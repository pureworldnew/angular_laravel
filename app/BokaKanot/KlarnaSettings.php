<?php namespace App\BokaKanot;


use App\BokaKanot\Billing\KlarnaAdminNotifierBookingDetailsAbstract;
use App\BokaKanot\Interfaces\KlarnaBillingInterface;
use App\BokaKanot\Interfaces\BillingNotifierInterface;
use App\BokaKanot\Interfaces\KlarnaDatabaseInterface;
use App\Centre;

class KlarnaSettings
{
    public function getParameters($request, UserUtil $userUtil)
    {
        /*$centreId = $userUtil->getUserCentreId($request);

        $merchantId = $this->getMerchantId($centreId);

        return [
            'EID' => $merchantId/ *"6323"* /,
            'checkout_uri' => "http://$_SERVER[HTTP_HOST]"."/booking/pay",
            'confirmation_uri' => "http://$_SERVER[HTTP_HOST]"."/booking/confirmation",
            'push_uri' => "http://$_SERVER[HTTP_HOST]"."/klarna/push",
            'terms_uri' => "http://$_SERVER[HTTP_HOST]"."/klarna/terms",
            'sharedSecret' => "84FOgBccj5pvJyT",
            "language" => $userUtil->getCurrentLanguage()
        ];*/
        
    }

    private function getMerchantId($centreId)
    {
        return Centre::where('id', $centreId)->klarna_api_key;
    }


}