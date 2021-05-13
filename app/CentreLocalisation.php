<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentreLocalisation extends Model
{
    protected $table = 'centre_localisation';

    /*protected $fillable = [
        'payment_methods_id', 'centre_id', 'api_key', 'active'
    ];*/

    public function centre()
    {
        return $this->belongsTo('App\Centre');
    }
}
