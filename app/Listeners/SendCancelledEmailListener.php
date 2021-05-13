<?php

namespace App\Listeners;

use App\BokaKanot\Booking\BookingEmailer;
use App\BokaKanot\UserUtil;
use App\Events\BookingCancelled;

class SendCancelledEmailListener
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
     * @param  BookingCancelled  $event
     * @return void
     */
    public function handle(BookingCancelled $event)
    {
    
        $this->bookingEmailer->cancelBooking($event->booking->email, $event->booking->name, $event->booking->owner()->email, $event->booking->id);

    }
}
