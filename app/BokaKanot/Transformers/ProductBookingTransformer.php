<?php

namespace App\BokaKanot\Transformers;
/**
 * Class LessonTransformer
 *
     * This class is used to transform lessons, in JSON format,
 * by explicitly stating which lesson properties to serve up.
 *
 * @package Acme\Transformers
 */
class ProductBookingTransformer extends Transformer {
    /**
     * This function transforms a single lesson -
     * from JSON format with specified fields.
     *
     * @param $item A lesson
     * @return array Returns an individual lesson,
     * according to specified fields.
     */
    public function  transform($productBookings)
    {

        $transformedProductBookings = [];

        foreach($productBookings as $productBooking)
        {
            $newRow = [];
            $newRow[0] = $productBooking->productName;
            $newRow[1] = $productBooking->bookingName;
            $newRow[2] = $productBooking->startDateTime;
            $newRow[3] = $productBooking->endDateTime;

            $transformedProductBookings[] = $newRow;
        }

        return $transformedProductBookings;
    }
}