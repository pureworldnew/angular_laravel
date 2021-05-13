<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerTypes extends Model
{
    protected $fillable = [
        'type_name', 'type_value'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Products');
    }
}
