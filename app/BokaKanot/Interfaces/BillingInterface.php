<?php namespace App\BokaKanot\Interfaces;

interface BillingInterface {
    public function charge(array $data);
}