<?php

namespace App\Listeners;

use App\BokaKanot\Booking\BookingKlarna;
use App\BokaKanot\UserUtil;
use App\Events\UpdateKlarna;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\App;

class NotifyKlarnaBookingUpdateListener
{
    /**
     * @var BookingKlarna
     */
    public $bookingKlarna;
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
        //

        //$billing = App::make('App\BokaKanot\Interfaces\BillingInterface', $parameters);
        $this->userUtil = $userUtil;
    }

    /**
     * Handle the event.
     *
     * @param  UpdateKlarna  $event
     * @return void
     */
    public function handle(UpdateKlarna $event)
    {
        if($event->booking->paymentMethodIsKlarna()) {
            $BookingKlarna = App::make('App\BokaKanot\Booking\BookingKlarna', [$event->booking->centre_id]);

            $BookingKlarna->updateKlarna($event->booking, $event->bookingProductId, $event->removeQuantity);
        }
    }
}
