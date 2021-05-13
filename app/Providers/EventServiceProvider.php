<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    //Add below and then run php artisan event:generate
    protected $listen = [
        'App\Events\BookingCancelled' => [
            'App\Listeners\NotifyKlarnaBookingCancelledListener',
            'App\Listeners\SendCancelledEmailListener',
        ],
        'App\Events\BookingCredited' => [
            'App\Listeners\NotifyPaymentProcessorBookingCreditedListener',
            'App\Listeners\SendCreditedEmailListener',
        ],
        'App\Events\ProductCancelled' => [
            'App\Listeners\NotifyKlarnaProductCancelledListener'
        ],
        'App\Events\ProductCredited' => [
            'App\Listeners\NotifyKlarnaProductCreditedListener',
            'App\Listeners\CancelInvoice'
        ],
        'App\Events\UpdateKlarna' => [
            'App\Listeners\NotifyKlarnaBookingUpdateListener'
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
