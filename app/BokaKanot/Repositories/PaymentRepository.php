<?php namespace App\BokaKanot\Repositories;

use DB;


class PaymentRepository
{
    public function getPaymentMethodIdFromShortCode($shortName)
    {
        if($shortName == "") {
           $shortName = "Stripe"; 
        }
        $query = "Select id from payment_methods where shortName = :shortName";
        return DB::select($query, array('shortName' => $shortName))[0]->id;
    }
}