<?php

namespace App\Listeners;

use App\BookingInvoice;
use App\Events\ProductCredited;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CancelInvoice
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProductCredited  $event
     * @return void
     */
    public function handle(ProductCredited $event)
    {
        if($event->booking->paymentMethodIsKlarna())
        {
            BookingInvoice::find($event->invoice->id)->cancelInvoice();
        }
    }
}
