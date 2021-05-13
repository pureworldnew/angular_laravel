<?php namespace App\BokaKanot\Billing;

interface BillingInterface {
    public function charge(array $data);
}
