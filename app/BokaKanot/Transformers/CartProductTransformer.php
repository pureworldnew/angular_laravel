<?php

namespace App\BokaKanot\Transformers;
use App\BokaKanot\DateUtil;

/**
 * Class LessonTransformer
 *
 * This class is used to transform lessons, in JSON format,
 * by explicitly stating which lesson properties to serve up.
 *
 * @package Acme\Transformers
 */
class CartProductTransformer extends Transformer {

    /**
     * @var DateUtil
     */
    private $dateUtil;

    public function __construct(DateUtil $dateUtil)
    {

        $this->dateUtil = $dateUtil;
    }

    /**
     * This function transforms a single product -
     * from JSON format with specified fields.
     *
     * @param $item A lesson
     * @return array Returns an individual lesson,
     * according to specified fields.
     */
    public function transform($item)
    {

        return [
            'id'            => $item['id'],
            'bookingLocationId' => $item["pivot"]->id,
            'name'          => $item['name'],
            "category_id"   => $item["category_id"],
            "description"   => $item["description"],
            "quantity"      => $item["pivot"]->quantity,
            "image"         => $item["image"],
            "per_type_time_id"   => $item["per_type_time_id"],
            "price"         => $item["pivot"]->price,
            "startDate"     => substr($item["pivot"]->startDateTime, 0, strpos($item["pivot"]->startDateTime, " ")),
            "startTime"     => substr($item["pivot"]->startDateTime, strpos($item["pivot"]->startDateTime, " ") + 1),
            "startDateTime" => $item["pivot"]->startDateTime,
            "endDateTime" => $item["pivot"]->endDateTime,
            "category_name" => $item["category"]->name,
            "productTimeType" => $item["price_type"],
            "durationDays" => $this->dateUtil->diffDays($item["pivot"]->startDateTime, $item["pivot"]->endDateTime),
            "durationHours" => $this->dateUtil->diffHours($item["pivot"]->startDateTime, $item["pivot"]->endDateTime),
            "reservepercentage" => $item["reservepercentage"]
        //$item["pivot"]->startDateTime
            //"productTimeType" => $item["productTimeType"],
            /* durationHours: resultItem.durationHours,
                durationDays: resultItem.durationDays,*/
            /*  startDate:  that.startDate,
                  startDateTime: resultItem.startDateTime,
                  startDateTimeObj: that.startDateTimeObj,
                  startTime: resultItem.startTime,
                  timeType: resultItem.productTimeType,
                  */


        ];
    }
}