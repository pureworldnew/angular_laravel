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
class SearchResultTransformer extends Transformer {

    /**
     * @var DateUtil
     */
    public function __construct()
    {

    }

    /**
     * This function transforms a single product -
     * from JSON format with specified fields.
     *
     * @param $item A lesson
     * @return array Returns an individual lesson,
     * according to specified fields.
     */
    public function transform($items)
    {
        foreach ($items as $item)
        {
            $timeTypeArray = [];

            foreach($item['per_type_times'] as $timeTypes)
            {
                $localTypeTime['type_time_name'] = trans('search.'.$timeTypes['type_time_value']);
                $localTypeTime['type_time_value'] = $timeTypes['type_time_value'];
                $localTypeTime['id'] = $timeTypes['id'];

                $timeTypeArray[] = $localTypeTime;
            }

            $item['per_type_times_local'] = $timeTypeArray;
            /*$item['per_type_times_local'] = [
                "id" => "1",
                    "type_time_name" => "per hour",
                    "type_time_value" => "perHour",
                    "lang" => "en"
            ];*/

        }
        //dd($item[0]['per_type_times'][0]['type_time_name']);


        return $items;

    }
}