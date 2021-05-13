<?php

namespace App;

use App\BokaKanot\DateUtil;
use Illuminate\Database\Eloquent\Model;
use PhpXmlRpc\Helper\Date;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
   /* private $NEW;
    private $PAID;
    private $ACTIVATED;
    private $CANCELLED;
    private $CREDITED;*/
    public $pricePerHour;

    protected $fillable = [
        'name', 'description', 'name_se', 'description_se','name_de', 'description_de', 'quantity','number_of_persons', 'category_id', 'per_type_id','reservepercentage'
    ];

    protected $appends = ['original_quantity'];

    /*public function __construct()
    {
        $this->NEW = Config('booking.status.NEW');
        $this->PAID = Config('booking.status.PAID');
        $this->ACTIVATED = Config('booking.status.ACTIVATED');
        $this->CANCELLED = Config('booking.status.CANCELLED');
        $this->CREDITED = Config('booking.status.CREDITED');
    }*/

    /**
     * @var DateUtil
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function getOriginalQuantityAttribute()
    {
        return $this->quantity;
    }

    public function prices()
    {
        return $this->belongsToMany('App\Price')->withPivot('price');
    }

    public function product_images()
    {
        return $this->hasMany('App\Product_Images');
    }

    public function setPricesOnProduct()
    {
        //dd($this->prices()->firstOrFail(['id', 1])->pivot->price);

      //  dd($this->prices()->first(), $this->prices()->where('prices.id', '=', 1)->first());
        $this->pricePerHour             = $this->prices()->where('prices.id', '=', 1)->first() != null ? $this->prices()->where('prices.id', '=', 1)->first()->pivot->price : 0;
        $this->pricePerHourWeekend      = $this->prices()->where('prices.id', '=', 2)->first() != null ? $this->prices()->where('prices.id', '=', 2)->first()->pivot->price : 0;
        $this->pricePerDay              = $this->prices()->where('prices.id', '=', 3)->first() != null ? $this->prices()->where('prices.id', '=', 3)->first()->pivot->price : 0;
        $this->pricePerDayWeekend       = $this->prices()->where('prices.id', '=', 4)->first() != null ? $this->prices()->where('prices.id', '=', 4)->first()->pivot->price : 0;
        $this->pricePerTwoDays          = $this->prices()->where('prices.id', '=', 14)->first() != null ? $this->prices()->where('prices.id', '=', 14)->first()->pivot->price : 0;
        $this->pricePerTwoDaysWeekend   = $this->prices()->where('prices.id', '=', 15)->first() != null ? $this->prices()->where('prices.id', '=', 15)->first()->pivot->price : 0;

        $this->pricePerProduct          = $this->prices()->where('prices.id', '=', 7)->first() != null ? $this->prices()->where('prices.id', '=', 7)->first()->pivot->price : 0;
        $this->pricePerBooking          = $this->prices()->where('prices.id', '=', 8)->first() != null ? $this->prices()->where('prices.id', '=', 8)->first()->pivot->price : 0;
        $this->pricePerHourOverFour    = $this->prices()->where('prices.id', '=', 9)->first() != null ? $this->prices()->where('prices.id', '=', 9)->first()->pivot->price : 0;
        $this->pricePerHourOverFourWeekend = $this->prices()->where('prices.id', '=', 10)->first() != null ? $this->prices()->where('prices.id', '=', 10)->first()->pivot->price : 0;
        $this->pricePerThreeSixDays     = $this->prices()->where('prices.id', '=', 11)->first() != null ? $this->prices()->where('prices.id', '=', 11)->first()->pivot->price : 0;
        $this->pricePerWeek             = $this->prices()->where('prices.id', '=', 13)->first() != null ? $this->prices()->where('prices.id', '=', 13)->first()->pivot->price : 0;
        $this->pricePerWeekExtraDay     = $this->prices()->where('prices.id', '=', 12)->first() != null ? $this->prices()->where('prices.id', '=', 12)->first()->pivot->price : 0;

        //return $this->prices()->where('prices.id', '=', 1)->first()->pivot->price;
    }

    public function bookings() {
        return $this->belongsToMany('App\Booking')->withPivot('startDateTime', 'endDateTime', "product_id", "quantity", "price");
    }

    public function totalProductPrice() {

        //return $this->bookings->sum('booking_product.quantity');

        $totalQuantity = 0;

        foreach ($this->bookings as $booking)
        {
            $totalQuantity = $totalQuantity + $booking->pivot->quantity;
        }

        return $totalQuantity;
    }

    public function isCredited()
    {
        return $this->pivot->klarna_product_status == 5;
    }

    public function isActivated()
    {
        return $this->pivot->klarna_product_status == 3;
    }

    public function isPaid()
    {
        return $this->pivot->klarna_product_status == 2;
    }

    public function isCancelled()
    {
        return $this->pivot->klarna_product_status == 4;
    }

    public function isNew()
    {
        return $this->pivot->klarna_product_status == 1;
    }

    public function status() {

        if ($this->pivot->klarna_product_status == 1)
        {
            return "New";
        }
        elseif ($this->pivot->klarna_product_status == 2)
        {
            return "Paid";
        }
        elseif ($this->pivot->klarna_product_status ==3)
        {
            return "Activated";
        }
        elseif ($this->pivot->klarna_product_status == 4)
        {
            return "Cancelled";
        }
        elseif ($this->pivot->klarna_product_status == 5)
        {
            return "Credited";
        }
        return "Error";
    }
    public function start_times ()
    {
        return $this->belongsToMany('App\StartTimes');
    }

    public function per_type ()
    {
        return $this->belongsTo('App\PerType');
    }

    public function per_type_times ()
    {
        return $this->belongsToMany('App\PerTypeTime');
    }

    public function isFee()
    {
        return $this->category->name == "Fees";
    }

    public function getPrimaryImage()
    {
        if(sizeof($this->product_images) > 0)
        {
            foreach($this->product_images as $image)
            {
                if($image->primary_image == 1)
                {
                    return $image->image;
                }
            }
        }
        return "";
    }

    public function hasPrimaryImage()
    {
        if(sizeof($this->product_images) > 0)
        {
            foreach($this->product_images as $image)
            {
                if($image->primary_image == 1)
                {
                    return true;
                }
            }
        }
        return false;
    }

    
}
