<?php namespace App\BokaKanot\Repositories;

use DB;

class AvailabilityRepository
{
    public function searchProductDate ($productId, $startDate, $endDate, $quantity = 0)
    {
        $query = "SELECT count(bp.id) as numberBookings, SUM( IFNULL( bp.quantity, 0 ) ) AS numberOfProductsBooked, p.name, p.quantity, p.*, pi.image as image ". //, c.name as cName
            "FROM `products` p ".
            "left JOIN `booking_product` bp on p.id = bp.product_id ".
            "AND ((endDateTime >  ? and endDateTime <= ?) or (startDateTime >= ? and startDateTime <= ?)) ".
            "LEFT JOIN product_images pi on p.id = pi.product_id ".
            //"INNER JOIN categories c on c.id = p.category_id".
            "where p.id = ? ".
            "Group BY p.name ".
            "having (numberOfProductsBooked + ?) <= quantity";


        $results = DB::select($query, [ $startDate, $endDate,$startDate, $endDate, $productId, $quantity ]);

        return $results;
    }
}

