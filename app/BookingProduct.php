<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BookingProduct extends Model
{
    use SoftDeletes;

    protected $table = 'booking_product';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'booking_id', 'product_id', 'price', 'price_type', 'startDateTime', "endDateTime", "quantity",'persons'
    ];

    public function getProductIdentifier()
    {
        return $this->product_id . "-" . substr(str_replace(["-", ":", " "], "", $this->startDateTime), 0, -2)."-".substr(str_replace(["-", ":", " "], "", $this->endDateTime), 0, -2);
       // return $this->product_id . "-" . substr(str_replace(["-", ":", " "], "", $this->startDateTime), 0, -2)."-".substr(str_replace(["-", ":", " "], "", $this->endDateTime), 0, -2);
    }

    /*public function bookings()
   {
       return $this->belongsto('App\Booking');
   }*/

    public function invoice()
    {
        return $this->hasOne('App\BookingInvoice', "id", "booking_invoice_id");
    }

    public function getInvoiceId()
    {
        //dd(sizeof($this->invoice()), $this->invoice()->first());
        
        if($this->invoice()->first())
        {
            return $this->invoice()->first()->invoice_id;
        }
        else
        {
            return "";
        }

    }
}