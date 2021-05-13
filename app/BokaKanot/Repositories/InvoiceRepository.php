<?php namespace App\BokaKanot\Repositories;


use App\BookingInvoice;
use DB;

class InvoiceRepository
{
    public function getInvoices($invoicesArray)
    {
        return BookingInvoice::whereIn('invoice_id', $invoicesArray)->get();
    }

    

}