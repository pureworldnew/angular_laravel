<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_Images extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
        'product_id', 'primary_image', 'image'
    ];

    public function product ()
    {
        return $this->belongsTo('App\Product');
    }
}
