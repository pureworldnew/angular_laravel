<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentrePaymentMethods extends Model
{
    protected $table = 'centre_payment_methods';

    protected $fillable = [
        'payment_methods_id', 'centre_id', 'api_key', 'active'
    ];

    public function payment_methods()
    {
        return $this->hasMany('App\PaymentMethods');
    }
}
