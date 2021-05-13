<?php namespace App\BokaKanot\Klarna;

use App\BokaKanot\Repositories\CentreRepository;
use App\BokaKanot\UserUtil;

class KlarnaCentre
{

    /**
     * @var UserUtil
     */
    private $userUtil;

    private $centreId;

    public function __construct($centreId, CentreRepository $centreRepository)
    {
        $this->centreId = $centreId;

        $this->centre = $centreRepository->getCentreDetails($centreId);
        //$this->userUtil = $userUtil;

    }

    public function extraRentalDetails($customerName, $firstStartDateTime, $lastEndDateTime, $totalProductsPrice)
    {
        $centre = $this->centre->first();

        
        //dd($centre->address1);

        $merchant_data = array();

        //Product rental:
        $productRentalDetails = array();

        $productRentalDetails["RentalCompany"] = $centre->name;

        $productRentalCustomer = array();
        $names = explode(" ", $customerName);

//foreach ($person as $p) { // The driver list from the merchant
        $driver = array();
        $driver["Firstname"] = array_key_exists(0, $names) ? $names[0] : "";
        $driver["Lastname"] =  array_key_exists(1, $names) ? $names[1] : "";
        array_push($productRentalCustomer, $driver);
//}

        $productRentalDetails["Drivers"] = $productRentalCustomer;

        $pickupLocation = array();
        $pickupLocation["Street"] = $centre->address1;
        $pickupLocation["PostalCode"] = $centre->post_code;
        $pickupLocation["City"] = $centre->city;
        $pickupLocation["Country"] = "Sweden";
        $productRentalDetails["PickUpLocation"] = $pickupLocation;

        $productRentalDetails["StartTime"] = $firstStartDateTime;

        $DropOffLocation = array();
        $DropOffLocation["Street"] = $centre->address1;
        $DropOffLocation["PostalCode"] = $centre->post_code;
        $DropOffLocation["City"] = $centre->city;
        $DropOffLocation["Country"] = "Sweden";
        $productRentalDetails["DropOffLocation"] = $DropOffLocation;

        $productRentalDetails["EndTime"] = $lastEndDateTime;

        $productRentalDetails["CarPrice"] = $totalProductsPrice;

        $merchant_data["equipment_rental_details"] = $productRentalDetails;

        return $merchant_data;

    }


}