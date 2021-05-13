<?php namespace App\BokaKanot;


use Illuminate\Support\Facades\DB;

class LocalisationCms
{
    public function getBookingConditions($locale)
    {
        $query = "SELECT field_value from centre_localisation cl where field_name = :fieldName and language = :language";

        return DB::select($query, ['fieldName' => 'booking_conditions', "language" => $locale])[0]->field_value;

    }

    public function getLocaleString($locale, $fieldName, $centreId)
    {
        $query = "SELECT field_value from centre_localisation cl where field_name = :fieldName and language = :language and centre_id = :centreId";

        $field = DB::select($query, ['fieldName' => $fieldName, "language" => $locale, "centreId" => $centreId ]);

        if (sizeof($field) > 0) {
            return $field[0]->field_value;
        }

        return "";
    }

}