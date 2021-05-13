<?php namespace App\BokaKanot;

//use App\Libraries;


use App\BokaKanot\Repositories\BookingRepository;

class BookingUtil
{
    /**
     * @var DateUtil
     */
    private $dateUtil;
    /**
     * @var BookingRepository
     */
    private $bookingRepository;
    /**
     * @var CentreUtil
     */
    private $centreUtil;

    public function __construct(DateUtil $dateUtil, BookingRepository $bookingRepository, CentreUtil $centreUtil)
    {

        $this->dateUtil = $dateUtil;
        $this->bookingRepository = $bookingRepository;
        $this->centreUtil = $centreUtil;
    }

    public function getTotalPrice ($items, $bookingFee)
    {
        $price = 0;
        foreach($items as $item)
        {
            $price += $item->pivot->price;
        }

        return $price + $bookingFee;
    }

    public function getTotalReservationPrice ($items)
    {
        $price = 0;
        foreach($items as $item)
        {
            $price += round((($item->reservepercentage * $item->pivot->price) / 100));
        }

        return $price;
    }

    public function checkIfInTimeToCancel($bookingId)
    {

        $centreDetails = $this->bookingRepository->getBookingCentreDetails($bookingId);

        //return true;
/*dd($centreDetails[0]->noCancelDays, $this->noDaysInAdvanceNow($centreDetails));*/
        if($centreDetails[0]->noCancelDays == 0 or ($centreDetails[0]->noCancelDays <= $this->noDaysInAdvanceNow($centreDetails)))
        {
            //dd('in time', $centreDetails[0]->noCancelDays, $this->noDaysInAdvanceNow($centreDetails));
            return true;
        }
        else
        {
            //dd('not in time', $centreDetails[0]->centreId, $centreDetails[0]->noCancelDays, $this->noDaysInAdvanceNow($centreDetails));
            return false;
        }

    }

    private function noDaysInAdvanceNow($centreDetails)
    {
        /*dd($centreDetails[0]->startDateTime);
        dd(new \DateTime(), new \DateTime($centreDetails[0]->startDateTime), $this->dateUtil->days_diff(new \DateTime(), new \DateTime($centreDetails[0]->startDateTime)));*/

        return $this->dateUtil->days_diff(new \DateTime(), new \DateTime($centreDetails[0]->startDateTime));
    }

    public function getBookingAdminFeeQuantity($products, $centreId)
    {
        foreach($products as $product )
        {
           // var_dump($product->id, $this->centreUtil->getAdminFeeProductId($centreId));
            if($product->id == $this->centreUtil->getAdminFeeProductId($centreId))
            {
//dd($product->pivot->quantity);
                return substr($product->pivot->quantity, 0, strpos($product->pivot->quantity, '.'));
            }

        }
//dd($product->id, $this->centreUtil->getAdminFeeProductId($centreId));
        return 0;
        dd('error in getBookingAdminFee getting admin fee');
    }

    public function getBookingAdminFee($products, $centreId)
    {
        foreach($products as $product )
        {
            if($product->id == $this->centreUtil->getAdminFeeProductId($centreId))
            {
                return $product->pivot->price;
            }

        }

        dd('error in getBookingAdminFee getting admin fee');
    }
    
    

}