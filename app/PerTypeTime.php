<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PerTypeTime extends Model
{
    protected $table = 'per_type_times';

    protected $fillable = [
        'type_name', 'type_value'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Products')->withPivot('active');
    }
}
