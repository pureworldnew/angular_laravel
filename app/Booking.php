<?php

namespace App;

use App\BokaKanot\DateUtil;
use App\Events\BookingCancelled;
use App\Events\BookingCredited;
use App\Events\ProductCredited;
use App\Events\UpdateKlarna;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Booking extends Model
{
    use SoftDeletes;

    protected $table = 'bookings';

    private $NEW;
    private $PAID;
    private $ACTIVATED;
    private $CANCELLED;
    private $CREDITED;

    private $CASH;
    private $TRANSFER;
    private $KLARNA;
    private $STRIPE;
    private $INVOICE;

    public function __construct()
    {
        $this->NEW = Config('booking.status.NEW');
        $this->PAID = Config('booking.status.PAID');
        $this->ACTIVATED = Config('booking.status.ACTIVATED');
        $this->CANCELLED = Config('booking.status.CANCELLED');
        $this->CREDITED = Config('booking.status.CREDITED');

        $this->CASH = Config('booking.status.CASH');
        $this->TRANSFER = Config('booking.status.TRANSFER');
        $this->KLARNA = Config('booking.status.KLARNA');
        $this->STRIPE = Config('booking.status.STRIPE');
        $this->INVOICE = Config('booking.status.INVOICE');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'centre_id', 'token', 'name', 'address', 'address2', 'city', 'telephone', "user_id", "status", "paid", "payment_method", "payment_method_id", "payment_ref", "freeText","reserve_price","reserve_rest_price"
    ];

   /* public function booking_products()
    {
        return $this->hasMany('App\BookingProduct');
    }*/

    public function setPaymentMethod($method)
    {
        $this->payment_method = $method;

        /*$ucMethod = strtoupper($method);
        $this->payment_method_id = $this->{$ucMethod};
dd($ucMethod, $this->{$ucMethod},  $this->{'$ucMethod'});*/
        $this->save();
    }

    public function adminFee()
    {
        if($this->centre->adminFee<>0)
        {
            /*dd($this->products());*/
           // dd($this->products()->wherePivot('per_type_time_id', null)->first()->pivot->quantity);

            return $this->centre->adminFee * $this->products()->wherePivot('per_type_time_id', null)->first()->pivot->quantity;
        }
        else {
            return 0;
        }
    }

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('id', 'price', 'quantity', 'startDateTime', 'endDateTime', 'klarna_product_status', 'booking_invoice_id', 'per_type_time_id', 'deleted_at', "product_id","persons","reserve_price","reserve_rest_price");
    }

    public function centre()
    {
        return $this->belongsTo('App\Centre');
    }

    public function isActivated()
    {
        return $this->status == $this->ACTIVATED;
    }

    public function isNew()
    {
        return $this->status == $this->NEW;
    }

    public function scopeFilterActivated($query)
    {
        return $query->where('status', $this->ACTIVATED);
    }

    public function scopeFilterSearchBookings($query)
    {
        return $query->where('status', "<>", 0);
    }

    public function scopeFilterNew($query)
    {
        return $query->where('status', $this->NEW);
    }

    public function scopeFilterPaid($query)
    {
        return $query->where('status', $this->PAID);
    }

    public function scopeFilterCancelled($query)
    {
        return $query->where('status', $this->CANCELLED);
    }

    public function scopeFilterCredited($query)
    {
        return $query->where('status', $this->CREDITED);
    }

    public function totalProductsPrice()
    {
        return $this->products()->sum('price');
    }

    public function userHasAccess($userId)
    {
        return sizeof($this->products->first()->category->centre->users->where('id', $userId));
    }

    public function allProductsInTimeToCancel()
    {
        $productsInTime = true;

        foreach($this->products as $product)
        {
            if(!$product->isFee() AND !$this->productInTimeToCancel($product->pivot->id))
            {
                $productsInTime = false;
            }
        }

        return $productsInTime;
    }

    public function productInTimeToCancel($bookingProductId)
    {

        $product = $this->getProduct($bookingProductId);

        $now = new \DateTime();
        $startDateTime = new \DateTime($product->pivot->startDateTime);

        $daysBeforeBooking = DateUtil::days_diff($now, $startDateTime);
/*dd($product->category->centre->noCancelDays, $daysBeforeBooking);*/
        //echo "<p>$productId - ".$product->category->centre->noCancelDays."-".$daysBeforeBooking."</p>";
        if($product->category->centre->noCancelDays == 0 or ($now < $startDateTime AND $product->category->centre->noCancelDays <= $daysBeforeBooking))
        {
            return true;
        }
        else
        {
            return false;
        }

    }


    public function totalPrice()
    {
        return $this->products()
            ->where('klarna_product_status', "<=", $this->ACTIVATED)
            ->wherePivot('deleted_at', null)
            ->select(DB::raw('sum(booking_product.price) AS totalPrice'))->first()->totalPrice + $this->bookingFee;
            //->select(DB::raw('sum(booking_product.quantity*booking_product.price) AS totalPrice'))->first()->totalPrice + $this->bookingFee;

        return $this->products()
            ->where('klarna_product_status', "<=", $this->ACTIVATED)
            ->wherePivot('deleted_at', null)

            ->sum('price') + $this->bookingFee ;
    }

    public function totalReservePrice()
    {
        return $this->products()
            ->where('klarna_product_status', "<=", $this->ACTIVATED)
            ->wherePivot('deleted_at', null)
            ->select(DB::raw('sum(booking_product.reserve_price) AS totalReservePrice'))->first()->totalReservePrice;
            //->select(DB::raw('sum(booking_product.quantity*booking_product.price) AS totalPrice'))->first()->totalPrice + $this->bookingFee;

        // return $this->products()
        //     ->where('klarna_product_status', "<=", $this->ACTIVATED)
        //     ->wherePivot('deleted_at', null)

        //     ->sum('price') + $this->bookingFee ;
    }

    public function resetReservePrice()
    {
        return $this->products()
            ->where('klarna_product_status', "<=", $this->ACTIVATED)
            ->wherePivot('deleted_at', null)
            ->select(DB::raw('sum(booking_product.reserve_rest_price) AS resetReservePrice'))->first()->resetReservePrice;
            //->select(DB::raw('sum(booking_product.quantity*booking_product.price) AS totalPrice'))->first()->totalPrice + $this->bookingFee;

        // return $this->products()
        //     ->where('klarna_product_status', "<=", $this->ACTIVATED)
        //     ->wherePivot('deleted_at', null)

        //     ->sum('price') + $this->bookingFee ;
    }

    public function isPaid()
    {
        return $this->status == $this->PAID;
    }

    public function manualRefundRequired()
    {
        if(($this->paymentMethodIsCash() or $this->paymentMethodIsTransfer() or $this->paymentMethodIsInvoice()) AND ($this->isPaid()) AND $this->payment_date <> "0000-00-00 00:00:00")
        {
             return true;
        }
    }

    public function paymentMethodIsCash()
    {
        return $this->payment_method_id == 2;
    }

    public function paymentMethodIsTransfer()
    {
        return $this->payment_method_id == 3;
    }

    public function paymentMethodIsKlarna()
    {
        return $this->payment_method_id == 4;
    }

    public function paymentMethodIsStripe()
    {
        return $this->payment_method_id == 5;
    }

    public function paymentMethodIsInvoice()
    {
        return $this->payment_method_id == 6;
    }

    public function isCancelled()
    {
        return $this->status == 4;
    }

    public function isCredited()
    {
        return $this->status == 5;
    }


    public function getBookingStatus()
    {
        if ($this['status'] == 1)
        {
            return "New";
        }
        elseif ($this['status'] == 2)
        {
            return "Paid";
        }
        elseif ($this['status'] == 3)
        {
            return "Activated";
        }
        elseif ($this['status'] == 4)
        {
            return "Cancelled";
        }
        elseif ($this['status'] == 5)
        {
            return "Credited";
        }
        return "Error";
    }

    public function activateBooking()
    {
        $this->status = $this->ACTIVATED;
        $this->save();
    }

    public function payBooking()
    {
        $this->status = $this->PAID;
        $this->payment_date = new \DateTime();

        $this->save();
    }

    public function canBeCancelled()
    {

        if($this->paymentMethodIsKlarna())
        {
            if($this->status == 1)
                return true;
        }
        elseif($this->paymentMethodIsStripe())
        {
            if ($this->status == 1)
                return true;

        }
        else
        {
            if($this->status == $this->NEW or $this->status == $this->ACTIVATED)
                return true;
        }

        return false;

    }

    public function canBeCredited()
    {
        if($this->paymentMethodIsKlarna())
        {
            if($this->status == $this->ACTIVATED)
                return true;
        }
        elseif($this->paymentMethodIsStripe())
        {
            if ($this->status == $this->ACTIVATED)
                return true;

        }
        else
        {
            if($this->status == $this->PAID)
                return true;
        }

        return false;

    }

    public function cancelOrCreditBooking()
    {
        $creditCancel = "";

        if($this->canBeCancelled())
        {
            $this->status = $this->CANCELLED;
            $creditCancel = 'cancel';
        }
        elseif($this->canBeCredited())
        {
            $this->status = $this->CREDITED;
            $creditCancel = 'credit';
        }

        foreach($this->products as $product)
        {
            if ($this->productCanBeCancelled($product->pivot->id))
            {
                $product->pivot->klarna_product_status = $this->CANCELLED;
            }
            elseif($this->productCanBeCredited($product->pivot->id))
            {
                $product->pivot->klarna_product_status = $this->CREDITED;


                event(new ProductCredited($this, $this->getProductInvoice($product->pivot->id), $this->centre_id)); //cancancel
            }
        }

        //dd('here');
        $this->cancelled_at = new \DateTime();

        $this->push();

        if($creditCancel == 'cancel')
        {
            //dd('wants to cancel');
            event(new BookingCancelled($this));
        }
        elseif($creditCancel == 'credit')
        {

            event(new BookingCredited($this));
        }
    }

    public function updateKlarna($bookingProductId, $removeQuantity)
    {

        event(new UpdateKlarna($this, $bookingProductId, $removeQuantity));

    }

    public function productIsActivated($bookignProductId)
    {
        $product = $this->getProduct($bookignProductId);

        return $product->pivot->klarna_product_status == $this->ACTIVATED;

    }

    public function activateProduct($productId)
    {

        $product = $this->products()->wherePivot('product_id', $productId)->firstOrFail();

        $product->pivot->klarna_product_status = $this->ACTIVATED;

        $product->pivot->save();
    }

    /*public function getProduct($productId)
    {
         return $this->products()->wherePivot('product_id', $productId)->firstOrFail();
    }*/

    public function getProduct($bookingProductId)
    {
       // dd($bookingProductId, $this->products()->wherePivot('id', $bookingProductId)->first());
         return $this->products()->wherePivot('id', $bookingProductId)->firstOrFail();
    }

    public function getProductIdentifier($bookingProductId)
    {
        //$product = $this->getProduct($bookingProductId);

        return BookingProduct::find($bookingProductId)->getProductIdentifier();
    }

    public function payProduct($productId)
    {
        $product = $this->products()->wherePivot('product_id', $productId)->firstOrFail();

        $product->pivot->klarna_product_status = $this->PAID;

        $product->pivot->save();
    }


    public function allProductsPaidOrCancelled()
    {
        $allPaid = true;

        foreach($this->products as $product)
        {
            if ($product->klarna_product_status == 1 or $product->klarna_product_status == 3)
            {
                $allPaid = false;
            }
        }

        return $allPaid;
    }

    public function owner()
    {
        return $this->products->first()->category->centre->superUser();
    }

    //Can either be cancelled or credited
    public function productCanBeRemoved($bookingProductId)
    {
        return ($this->productCanBeCancelled($bookingProductId) OR $this->productCanBeCredited($bookingProductId)) AND !$this->productRemoved($bookingProductId);
    }

    public function productCanBeCancelled($bookingProductId)
    {
        $product = $this->getProduct($bookingProductId);

        if($this->can_be_cancelled and ($this->isNew() or ((!$this->paymentMethodIsKlarna() AND !$this->paymentMethodIsStripe()) and $this->isActivated()))) {
            
            if ($this->paymentMethodIsKlarna())
            {
                if($product->isNew())
                {
                    return true;
                }
                elseif($product->isActivated() and (!BookingProduct::find($product->pivot->id)->invoice()->first()->discounted))
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {

                return true;

            }

        }
    }

    /*public function removeProduct($productId)
    {
        if(sizeof($this->products) <> 0) {
            if ((Auth::check() AND $booking->userHasAccess(Auth::user()->id)) )
            {

            }
        }
        else
        {
            Session::flash('flashMessage', trans('errors/booking.productNotExist'));
            return back();
        }
    }*/

    public function productRemoved($bookingProductId)
    {
        //dd($this->getProduct($bookingProductId));
        return $this->getProduct($bookingProductId)->pivot->deleted_at <> "";

    }

    public function productCanBeCredited($bookingProductId)
    {
        $product = $this->getProduct($bookingProductId);

        if($this->paymentMethodIsStripe() and $this->isActivated())
        {
            return true;
        }

        $invoice = BookingProduct::withTrashed()->find($product->pivot->id)->invoice()->first();
        if( is_object($invoice) AND
            ($this->isPaid() or
                ($this->isActivated() and $product->isPaid()) or
                $product->isActivated())
            AND !$invoice->discounted) {

            return true;

        } else {

            return false;

        }

    }

    public function productIsFee($bookingProductId)
    {
        return $this->getProduct($bookingProductId)->isFee();
    }

    public function getKlarnaBookingAddress()
    {
        $nameSplit = explode(' ', $this->name);

        $bookingAddress['email'] = $this->email;
        $bookingAddress['telephone'] = $this->telephone;
        $bookingAddress['cell'] = "";
        $bookingAddress['firstName'] = $nameSplit[0];
        $bookingAddress['lastName'] = $nameSplit[1];
        $bookingAddress['careOf'] = "";
        $bookingAddress['address'] = $this->address;
        $bookingAddress['post_code'] = $this->post_code;
        $bookingAddress['city'] = $this->city;

        return $bookingAddress;
    }

    //https://laravel.com/docs/5.1/eloquent-relationships#one-to-one
    public function invoice()
    {
        return $this->hasOne('App\BookingInvoice', "id", "booking_invoice_id");
    }

    public function getInvoiceId()
    {
        if($this->invoice()->first())
        {
            return $this->invoice()->first()->invoice_id;
        }
        else
        {
            return "";
        }

    }

    public function getProductInvoice($bookingProductId)
    {
        $bookingProduct = BookingProduct::withTrashed()->find($bookingProductId);

        if($bookingProduct)
        {
            return $bookingProduct->invoice()->first();
        }

        return 0;

    }

    /*public function updateProductInvoiceAmount($bookingProductId, $removeQuantity)
    {
        $bookingProduct = BookingProduct::find($bookingProductId);

        if($bookingProduct)
        {
            return $bookingProduct->invoice()->first()->amount;
        }

        return 0;

    }*/

    public function getProductInvoiceId($bookingProductId)
    {
        $bookingProduct = BookingProduct::withTrashed()->find($bookingProductId);

        if($bookingProduct)
        {
            return $bookingProduct->getInvoiceId();
        }

        return "";

    }
    
    /*public function returnAmount()
    {
        event(new ProductCredited($product->pivot->booking_invoice_id, $this->centre_id));
    }*/

    public function firstStartDateTime()
    {
        return $this->products()->where('startDateTime', '<>', '2000-01-01 00:00:00')->orderBy('startDateTime', 'ASC')->first()->pivot->startDateTime;
    }

    public function lastEndDateTime()
    {
        return $this->products()->where('endDateTime', '<>', '2000-01-01 00:00:00')->orderBy('endDateTime', 'DESC')->first()->pivot->endDateTime;
        //return $this->products()->where('startDateTime', '<>', '2000-01-01 00:00:00')->orderBy('startDateTime', 'ASC')->first()->startDateTime;
    }

   /* public function getTotalQuantityOfBookings()
    {
        return $this->reduce(function ($ml, $product) {
            // we need to ensure ingredient was loaded in relation context
            $current = $product->pivot ? $product->pivot->quantity : 0;

            return $ml + $current;
        });
    }*/
}
