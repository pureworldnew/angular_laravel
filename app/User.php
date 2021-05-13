<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'user_type_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function centres()
    {
        return $this->belongsToMany('App\Centre')->withPivot('user_type_id');
    }

    public function isSuperAdmin()
    {
        return $this->pivot->user_type_id == 1;
    }

    public function categories()
    {
        return $this->hasManyThrough('App\Category', 'App\Centre');
    }

    public function products()
    {
        return $this->hasManyThrough('App\Product', 'App\Category', 'App\Centre');
    }

    public function getUserCategories()
    {
        return $this->centres()->first()->categories()->get();

    }

}
