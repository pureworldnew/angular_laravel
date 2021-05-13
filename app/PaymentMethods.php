<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethods extends Model
{
    protected $table = 'payment_methods';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    /*protected $fillable = [
        'name', 'description', 'image', 'centre_id', 'parent_category_id'
    ];*/

    public function centres()
    {
        return $this->belongsToMany('App\Centre');
    }

    
}
