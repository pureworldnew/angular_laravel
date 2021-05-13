<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerType extends Model
{
    protected $fillable = [
        'type_name', 'type_value'
    ];

    public function products()
    {
        return $this->hasMany('App\Products');
    }
}
