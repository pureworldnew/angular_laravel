<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    protected $fillable = [
        'name', 'telephone', 'address1', 'address2', 'post_code', 'web_page', 'intro_text',
        'confirmation_text', 'email', 'booking_conditions', 'payment_policy', "city", "stripe_api_key", "stripe_api_secret",
        "stripe_secret_key", "stripe_publishable_key", "klarna_api_key", "klarna_api_secret", "klarna_api_key_live", "klarna_api_secret_live", "klarna_test_mode", "logo_url", "noCancelDays",
        "urlSlug", "default_language", "num_pay_advance_days","startTime","endTime","holidays","holidaysrange","bookingFee", "useAdminFee", "adminFee", "klarna_only","paypalemail"
    ];
    protected $payment_methodsArray = [];
    //
    public function users()
    {
        return $this->belongsToMany('App\User')->withPivot('user_type_id');
    }

    public function superUser()
    { 
        return $this->users()->wherePivot('user_type_id', 1)->first();
    }
    public function categories ()
    {
        return $this->hasMany('App\Category');
    }

    public function products()
    {
        return $this->hasManyThrough('App\Product', 'App\Category');
    }

    public function payment_methods()
    {
        return $this->belongsToMany('App\PaymentMethods')->withPivot('active', 'api_key');
    }

    public function bookings()
    {
        return $this->hasMany('App\Booking');
    }

    public function textStrings()
    {
        return $this->hasMany('App\CentreLocalisation');
    }

    public function getKlarnaApiKey()
    {
        if($this->klarna_test_mode)
        {
            return $this->klarna_api_key;
        }
        else
        {
            return $this->klarna_api_key_live;
        }

    }

    public function getKlarnaApiSecret()
    {
        if($this->klarna_test_mode)
        {
            return $this->klarna_api_secret;
        }
        else
        {
            return $this->klarna_api_secret_live;
        }
    }

    public function hasKlarnaPaymentOption ()
    {
        if(sizeof($this->payment_methods()->where('payment_methods_id', Config('booking.payment_type.KLARNA'))->get()) > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getCountryLanguageCode()
    {

        if($this->default_language == "en")
        {
            return "gb_en";
        }
        elseif($this->default_language == "se")
        {
            return "sv_se";
        }
        elseif($this->default_language == "de")
        {
            return "de_de";
        }

    }

}
