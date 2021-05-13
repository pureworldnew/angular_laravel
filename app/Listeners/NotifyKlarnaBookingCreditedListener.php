<?php

namespace App\Listeners;

use App\BokaKanot\UserUtil;
use App\BookingInvoice;
use App\Events\BookingCredited;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyKlarnaBookingCreditedListener
{
    /**
     * @var UserUtil
     */
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
     * @param  BookingCredited  $event
     * @return void
     */
    public function handle(BookingCredited $event)
    {
        if($event->booking->paymentMethodIsKlarna())
        {
            //dd($event->booking->centre_id);
            $klarna = $this->userUtil->getCentreKlarna($event->booking->centre_id);

            $klarnaInvoiceId = BookingInvoice::find($event->booking->booking_invoice_id)->invoice_id;

            $klarna->klarnaService->credit($klarnaInvoiceId);

        }


    }
}
