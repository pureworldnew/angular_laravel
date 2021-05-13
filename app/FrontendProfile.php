<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FrontendProfile extends Model
{
    protected $table = 'frontend_profile';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'address', 'user_id', 'zipcode', 'city',  'country', 'email', '	password'
    ];


}
