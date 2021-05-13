<?php namespace App\BokaKanot\Billing;

class KlarnaAdminNotifierBookingDetails extends KlarnaAdminNotifierBookingDetailsAbstract
{
    public $name;
    public $address;
    public $postal_code;
    public $email;
    public $product_list;
    public $subject;
    public $total_cost;
    public $product_name;
    public $recipients;

    public function __construct($name, $address, $postal_code, $email, $product_list, $subject, $total_cost, $recipients)
    {
        $this->address = $address;
        $this->name = $name;
        $this->postal_code = $postal_code;
        $this->email = $email;
        $this->product_list = $product_list;
        $this->subject = $subject;
        $this->total_cost = $total_cost;
        $this->recipients = $recipients;
    }
}