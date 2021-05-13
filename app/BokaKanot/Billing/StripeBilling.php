<?php namespace App\BokaKanot\Billing;


use App\BokaKanot\Interfaces\BillingInterface;
use Illuminate\Support\Facades\Session;
use Stripe\Stripe;
use Config;
use Exception;

class StripeBilling implements BillingInterface {

    public function __construct($parameters)
    {
        //Todo: change below, pass in api key from centre table
        //Stripe::setApiKey(Config::get('stripe.secret_key'));
        //dd($parameters);
        Stripe::setApiKey($parameters['secret_key']);
    }

    public function charge(array $data)
    {
        try
        {
            $customer = \Stripe\Customer::create([
                'source' => $data['token'],
                'description' => $data['email'],
                'email' => $data['email']
            ]);

            //$emailDescription = "Thank you for your booking with bokakanot.se. Your purchase of ".$data['productsDescription']." will be delivered to you, subject to our estimated delivery times (http://djembefola.com/shop/delivery).";
            $emailDescription = trans("billing.stripeEmailText1").$data['productsDescription'].trans("billing.stripeEmailText2");
            //"Thank you for your booking with bokakanot.se. Details of your booking (".$data['productsDescription']."), has been mailed to you.";

            $chargeResponse = \Stripe\Charge::create([
                'customer' => $customer->id,
                //'source' => $data['token'],
                'amount' => $data['amount'] * 100, // $10
                'currency' => $data['currency'],
                "description" => $emailDescription

            ]);
           /* dd($chargeResponse);
            dd('after create > charge');*/
            return $customer->id."|".$chargeResponse->id;
        }
        catch (Stripe_InvalidRequestError $e)
        {
            Session::flash('stripeError', $e->getMessage());
            /*throw new Exception($e->getMessage());
            dd("Stripe error - ".$e->getMessage());*/
        }
        catch(Stripe_CardError $e)
        {
            Session::flash('stripeError', $e->getMessage());
        }
        catch(Exception $e)
        {
            Session::flash('stripeError', $e->getMessage());
        }
        return "Error";
    }

    public function refund($chargeId, $refundAmount)
    {
        try
        {
           $refund = \Stripe\Refund::create(array(
                "charge" => $chargeId,
                // "amount" => round($refundAmount) * 100
                "amount" => round($refundAmount) 
            ));
            

            return $refund->status;
        }
        catch (Stripe_InvalidRequestError $e)
        {
            Session::flash('stripeError', $e->getMessage());
        }
        catch(Stripe_CardError $e)
        {
            Session::flash('stripeError', $e->getMessage());
        }
        catch(Exception $e)
        {
            Session::flash('stripeError', $e->getMessage());
        }
        //dd(Session::get('stripeError'));
        return "Error";
    }

}