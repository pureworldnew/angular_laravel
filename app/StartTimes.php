<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StartTimes extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'user_type_id',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Products');
    }
}
