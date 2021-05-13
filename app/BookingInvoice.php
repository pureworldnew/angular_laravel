<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BookingInvoice extends Model
{
    use SoftDeletes;

    protected $table = 'booking_invoice';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id', 'amount', 'credited'
    ];

    public function booking()
    {
        return $this->belongsTo('App\Booking', 'id', 'booking_invoice_id');
    }

    public function booking_product()
    {
        return $this->hasMany('App\BookingProduct', 'id', 'booking_invoice_id');
    }

    public function getInvoiceAmount()
    {
        return $this->amount - $this->discounted_amount;
    }

    public function partiallyRefundAmount($refundAmount)
    {
        $this->discounted_amount = $this->discounted_amount + $refundAmount;
        $this->save();

        return $this->amount ;
    }

    public function cancelInvoice()
    {
        $this->cancelled = 1;
        $this->save();
    }

    public function statusText()
    {
        if ($this->cancelled == 0)
        {
            return "Active";
        }
        else
        {
            return "Cancelled";
        }
    }
}
