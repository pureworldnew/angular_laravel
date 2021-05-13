<?php

namespace App\Listeners;

use App\BokaKanot\Booking\BookingStripe;
use App\BokaKanot\UserUtil;
use App\BookingInvoice;
use App\Events\BookingCredited;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyPaymentProcessorBookingCreditedListener
{
    /**
     * @var UserUtil
     */
    private $userUtil;
    /**
     * @var BookingStripe
     */
    private $bookingStripe;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserUtil $userUtil, BookingStripe $bookingStripe)
    {
        $this->userUtil = $userUtil;
        $this->bookingStripe = $bookingStripe;
    }

    /**
     * Handle the event.
     *
     * @param  BookingCredited  $event
     * @return void
     */
    public function handle(BookingCredited $event)
    {
        if ($event->booking->paymentMethodIsKlarna()) {
            //dd($event->booking->centre_id);
            $klarna = $this->userUtil->getCentreKlarna($event->booking->centre_id);

            $klarnaInvoiceId = BookingInvoice::find($event->booking->booking_invoice_id)->invoice_id;

            $klarna->klarnaService->credit($klarnaInvoiceId);

        }
        elseif ($event->booking->paymentMethodIsStripe()) {

            $this->bookingStripe->refund($event->booking->centre_id, $event->booking->totalPrice(), $event->booking->stripe_charge_id);

        }
    }
}
