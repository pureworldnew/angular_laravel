<?php

namespace App\Listeners;

use App\Events\ProductCancelled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyKlarnaProductCancelledListener
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
     * @param  ProductCancelled  $event
     * @return void
     */
    public function handle(ProductCancelled $event)
    {
        //
    }
}
