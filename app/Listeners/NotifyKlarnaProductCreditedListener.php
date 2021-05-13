<?php

namespace App\Listeners;

use App\BokaKanot\UserUtil;
use App\Events\ProductCredited;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyKlarnaProductCreditedListener
{
    private $userUtil;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserUtil $userUtil)
    {
        $this->userUtil = $userUtil;
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
            $klarna = $this->userUtil->getCentreKlarna($event->centre_id);

            echo "<h1>handing invoice id - ".$event->invoice->invoice_id."</h1>";
            $klarna->klarnaService->credit($event->invoice->invoice_id);
        }


    }
}
