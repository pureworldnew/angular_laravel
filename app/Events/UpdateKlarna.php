<?php

namespace App\Events;

use App\Booking;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UpdateKlarna extends Event
{
    use SerializesModels;
    /**
     * @var
     */
    public $bookingProductId;
    public $booking;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Booking $booking, $bookingProductId, $removeQuantity)
    {
        $this->booking = $booking;
        $this->bookingProductId = $bookingProductId;
        $this->removeQuantity = $removeQuantity;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
