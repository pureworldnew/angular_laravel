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
class ProductTransformer extends Transformer {
    /**
     * This function transforms a single lesson -
     * from JSON format with specified fields.
     *
     * @param $item A lesson
     * @return array Returns an individual lesson,
     * according to specified fields.
     */
    public function  transform($item)
    {

        return [
            'id' => $item['id'],
            'name' => $item['name']/*,
            'active' => (boolean)$item['some_bool']*/
        ];
    }
}