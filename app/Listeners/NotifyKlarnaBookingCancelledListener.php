<?php

namespace App\Listeners;

use App\BokaKanot\UserUtil;
use App\Events\BookingCancelled;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyKlarnaBookingCancelledListener
{
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
     * @param  BookingCancelled  $event
     * @return void
     */
    public function handle(BookingCancelled $event)
    {
        if($event->booking->paymentMethodIsKlarna())
        {
            //dd($event->booking->centre_id);
            $klarna = $this->userUtil->getCentreKlarna($event->booking->centre_id);
//dd($klarna, $event->booking, $event->booking->klarna_reservationId);
            $klarna->klarnaService->cancel($event->booking->klarna_reservationId);
        }

    }
}
