<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'image', 'centre_id', 'parent_category_id' ,'name_de','description_de','name_se','description_se'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    /*protected $hidden = [

    ];*/
    public function centre () 
    {
        return $this->belongsTo('App\Centre');
    }

    public function products ()
    {
        return $this->hasMany('App\Product');
    }

    public function childCategories()
    {
        return $this->hasMany('App\Category', 'parent_category_id', 'id');
    }

   /* public function parentCategory ()
    {
        return $this->belongsTo('App\Category', 'parent_category_id', 'parent_category_id' );
    }*/
}
