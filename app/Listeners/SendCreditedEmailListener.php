<?php

namespace App\Listeners;

use App\BokaKanot\Booking\BookingEmailer;
use App\BokaKanot\UserUtil;
use App\Events\BookingCredited;

class SendCreditedEmailListener
{
    /**
     * @var BookingEmailer
     */
    private $bookingEmailer;
    /**
     * @var UserUtil
     */
    private $userUtil;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(BookingEmailer $bookingEmailer, UserUtil $userUtil)
    {
        $this->bookingEmailer = $bookingEmailer;
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
       $this->bookingEmailer->cancelBooking($event->booking->email, $event->booking->name, $event->booking->owner()->email, $event->booking->id);
    }
}
