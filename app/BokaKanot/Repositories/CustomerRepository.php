<?php namespace App\BokaKanot\Repositories;

use DB;

class CustomerRepository
{
    public function getCustomers($centreId)
    {
        $query = "SELECT name, email, created_at, count(id) as bookingCount FROM `bookings` where centre_id = :centreId group by email order by name asc, created_at desc";

        return DB::select($query, ['centreId' => $centreId]);
    }
}