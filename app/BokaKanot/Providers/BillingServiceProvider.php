<?php

namespace App\BokaKanot\Providers;

use App\BokaKanot\Billing\BillingNotifier;
use App\BokaKanot\Billing\StripeBilling;
use App\BokaKanot\Klarna;
use App\BokaKanot\KlarnaDatabase;
use App\BokaKanot\KlarnaService;
use App\BokaKanot\Repositories\BookingRepository;
use Illuminate\Support\ServiceProvider;

class BillingServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\BokaKanot\Interfaces\BillingInterface',function ($app, Array $parameters)
            {
                return new StripeBilling($parameters);
            }
        );

        //Need to refactor this - probably to rename App\BokaKanot\Interfaces\KlarnaBillingInterface to something more Klarna specific
        $this->app->bind(
            'App\BokaKanot\Interfaces\KlarnaBillingInterface',function ($app, Array $parameters)
            {
                return new KlarnaService($parameters);
            }
        );

        $this->app->bind(
            'App\BokaKanot\Interfaces\KlarnaDatabaseInterface',function ($app, Array $parameters)
            {
                return new KlarnaDatabase(new BookingRepository());
            }
        );

        $this->app->bind(
            'App\BokaKanot\Interfaces\BillingNotifierInterface',function ($app, Array $parameters)
            {
                return new BillingNotifier();
            }
        );

        $this->app->bind(
            'App\BokaKanot\Klarna',function ($app, Array $parameters)
            {
                return new Klarna(new KlarnaDatabase(new BookingRepository()),  new KlarnaService($parameters), new BillingNotifier());
            }
        );

        /*$this->app->when('App\Handlers\Commands\CreateOrderHandler')
            ->needs('App\BokaKanot\Interfaces\KlarnaBillingInterface')
            ->give(function () {

                return new KlarnaService();


            });*/

        /*$this->app->bind('Foo', function ()
        {
            return new Foo(new Bar, new Baz);
        });*/
        //
        /*$this->app->bind(
            'App\BokaKanot\Interfaces\KlarnaBillingInterface',
            'App\BokaKanot\Interfaces\KlarnaInterface'
        );*/

    }
}