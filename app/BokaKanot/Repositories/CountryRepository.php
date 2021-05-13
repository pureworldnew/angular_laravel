<?php namespace App\BokaKanot\Repositories;

use App\Country;
use DB;


class CountryRepository
{
    public function _construct()
    {

    }

    public function getCountryIdFromShortcode($shortCode)
    {
        return Country::where('short_code', $shortCode)->first()->id;
    }


}