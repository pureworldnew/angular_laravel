<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ProductCredited extends Event
{
    use SerializesModels;

    public $invoiceId;
    /**
     * @var
     */
    public $booking;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($booking, $invoice, $centre_id)
    {
        //
        $this->invoice = $invoice;
        //$this->invoiceId = $invoice->invoice_id;
        $this->centre_id = $centre_id;
        $this->booking = $booking;
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
