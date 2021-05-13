<?php namespace App\BokaKanot\Interfaces;

use App\BokaKanot\Billing\KlarnaAdminNotifierBookingDetailsAbstract;

interface BillingNotifierInterface
{
    public function notifyAdmin(KlarnaAdminNotifierBookingDetailsAbstract $parameters);
}