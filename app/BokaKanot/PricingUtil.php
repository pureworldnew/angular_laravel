<?php namespace App\BokaKanot;

use App\BokaKanot\Repositories\ProductRepository;
use Faker\Provider\tr_TR\DateTime;
use PhpXmlRpc\Helper\Date;

/*
INSERT INTO  `boka_kanot_test`.`centres` (
`id` ,
`name` ,
`logo_url` ,
`telephone` ,
`address1` ,
`address2` ,
`post_code` ,
`web_page` ,
`num_pay_advance_days` ,
`invoice_text` ,
`intro_text` ,
`confirmation_text` ,
`confirmation_email` ,
`booking_conditions` ,
`payment_policy` ,
`created_at` ,
`updated_at`
)
VALUES (
NULL ,  'James Canoes',  '',  '',  '',  '',  '',  '',  '12',  '',  '',  '',  '',  '',  '', NULL , NULL
);
INSERT INTO  `boka_kanot_test`.`categories` (
`id` ,
`name` ,
`description` ,
`image` ,
`centre_id` ,
`parent_category_id` ,
`created_at` ,
`updated_at`
)
VALUES (
NULL ,  'Canoes',  '',  '',  '1', NULL , NULL , NULL
);
INSERT INTO  `boka_kanot_test`.`products` (
`id` ,
`category_id` ,
`name` ,
`description` ,
`quantity` ,
`image` ,
`created_at` ,
`updated_at`
)
VALUES (
NULL ,  '1',  'Blue Canoe',  '',  '1',  '', NULL , NULL
);
INSERT INTO `price_product` (`id`, `price_id`, `product_id`, `price`, `created_at`, `updated_at`) VALUES
(94, 1, 1, 9.00, NULL, NULL),
(95, 2, 1, 8.00, NULL, NULL),
(96, 3, 1, 8.00, NULL, NULL),
(97, 4, 1, 8.00, NULL, NULL),
(98, 5, 1, 8.00, NULL, NULL),
(99, 6, 1, 8.00, NULL, NULL),
(100, 7, 1, 8.00, NULL, NULL),
(101, 8, 1, 8.00, NULL, NULL),
(102, 9, 1, 6.00, NULL, NULL),
(103, 10, 1, 7.00, NULL, NULL),
(104, 11, 1, 8.00, NULL, NULL),
(105, 12, 1, 8.00, NULL, NULL);
*/

class PricingUtil
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository) {


        $this->productRepository = $productRepository;
    }

    public function getLowestPrice($productId, $startDateTimeString, $endDateTimeString)
    {
        $priceList = $this->getPrice ($productId, $startDateTimeString, $endDateTimeString);

        return $this->calculateLowestPrice($priceList);
    }

    public function calculateLowestPrice($priceList)
    {
        $lowestPrice = 99999;

        foreach($priceList as $price)
        {
            if(!is_null($price) AND $price <> 0)
            {
               if ($price < $lowestPrice)
                {
                    $lowestPrice = $price;
                }
            }
        }

        return $lowestPrice;
    }

    public function getPrice ($productId, $startDateTimeString, $endDateTimeString)
    {

        $product = $this->productRepository->getProductPrices($productId);

        if (!$product )
            return null;

        $priceList = [];
        $perWeekPrice = 0;
        $perAdditionalDayPrice = 0;

        foreach($product->prices as $price)
        {
            //For time price
            if($product->per_type_id == 1 and
                ($price->id == 1 or $price->id == 2 or $price->id ==3 or $price->id == 4 or $price->id ==5 or $price->id == 9 or $price->id == 10 or $price->id == 11 or $price->id == 13 or $price->id == 14 or $price->id == 15 ))
            {
                $priceList[$price->id] = $this->calculatePrice($price->id, $price->pivot->price, $startDateTimeString, $endDateTimeString);
            }

            //2. Per booking
            if($product->per_type_id == 2 and ($price->id == 8))
            {
                $priceList[$price->price_id] = $this->calculatePrice($price->id, $price->pivot->price, $startDateTimeString, $endDateTimeString);
            }

            //3. Per product
            if($product->per_type_id == 3 and ($price->id == 7))
            {
                $priceList[$price->price_id] = $this->calculatePrice($price->id, $price->pivot->price, $startDateTimeString, $endDateTimeString);
            }


            if($price->id == 13)
            {
                $perWeekPrice = $price->pivot->price;
            }

            if($price->id == 12)
            {
                $perAdditionalDayPrice = $price->pivot->price;
            }
        }

        //do per day over a week last as we need to have the per week price populated
        $priceList[12] = $this->calculatePrice(12, $perAdditionalDayPrice, $startDateTimeString, $endDateTimeString, $perWeekPrice );
//dd($product );
        return $priceList;

    }

    private function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }

    private function calculatePrice($price_id, $price, $startDateTimeString, $endDateTimeString, $weekPrice = 0)
    {
        $startDateTime = new \DateTime($startDateTimeString);
        $endDateTime = new \DateTime($endDateTimeString);

        $diff = $endDateTime->diff($startDateTime);
        //dd($diff->h);
        $totalPrice = 0;

        $hours = $this->calcHours($diff->d, $diff->h, $diff->m, $diff->s);
        $days = $this->calcDays($diff->d, $diff->h, $diff->m, $diff->s);

        //$days = 24;

        $weeks = $days/7;
        $roundWeeks = $weeks;
        $remainderDays = 0;

        if($weeks >= 1)
        {
            $remainderDays = $days % 7;
            $roundWeeks= ceil($weeks);
            $weeks = floor($weeks);
        }
        else
        {
            $roundWeeks= ceil($weeks);
            $weeks = 0;
        }

        //dd($days, $roundWeeks, $weeks, $remainderDays);



        $this->calcWeeks($diff->d, $diff->d, $diff->h, $diff->m, $diff->s);
        $durationOnlyHoursOrLess = ($diff->y == 0 AND $diff->m == 0 AND $diff->d == 0) ? true : false;

        if ($price_id == 1)
        {

            //perhour - return the price anyway even if it's high
            return $price * $hours;

            /*if($hours < 3 AND $durationOnlyHoursOrLess)
            {
                return $price * $hours;
            }*/

            return null;
        }
        elseif ($price_id == 2)
        {
            //perhour - weekend
            if ($this->isWeekend($startDateTimeString) AND $this->isWeekend($endDateTimeString))
            {

                if($hours < 3/* AND $durationOnlyHoursOrLess*/)
                {
                    return $price * $hours;
                }
            }

            return null;

        }
        elseif ($price_id == 3)
        {
            //PerDayWeek
            if (!$this->isWeekend($startDateTimeString) AND !$this->isWeekend($endDateTimeString))
            {
                return $days * $price;
            }
            else
            {
                return null;
            }
        }
        elseif ($price_id == 4)
        {
            //per day weekend
            if ($this->isWeekend($startDateTimeString) OR $this->isWeekend($endDateTimeString))
            {
                return $days * $price;
            }
            else
            {
                return null;
            }
        }
        elseif ($price_id == 14)
        {
            //PerTwoDaysWeek
            if (!$this->isWeekend($startDateTimeString) AND !$this->isWeekend($endDateTimeString))
            {
                if($days > 1 and $days < 3 and $diff->y == 0 AND $diff->m == 0)
                {
                    return $price * $days;
                }
            }
            return null;
        }
        elseif ($price_id == 15)
        {
            //per two days weekend
            if ($this->isWeekend($startDateTimeString) OR $this->isWeekend($endDateTimeString))
            {
                if($days > 1 and $days < 3 and $diff->y == 0 AND $diff->m == 0)
                {
                    return $price * $days;
                }
            }
            return null;
        }
        elseif ($price_id == 5)
        {
            //PerHalfDayWeek
            return null;
        }
        elseif ($price_id == 6)
        {
            //PerHalfDayWeekend
            return null;
        }
        elseif ($price_id == 7)
        {
            //PerProduct
            if($price <> 0)
            {
                return $price * 1 ;
            }
            else
            {
                return null;
            }
        }
        elseif ($price_id == 8)
        {
            //PerBooking
            if($price <> 0)
            {
                return $price * 1;
            }
            else
            {
                return null;
            }
        }
        elseif ($price_id == 9)                     //pricePerHourOverFour
        {
            $hours = $this->calcHours($diff->d, $diff->h, $diff->m, $diff->s);

            if (!$this->isWeekend($startDateTimeString) AND !$this->isWeekend($endDateTimeString) AND $hours >= 4/* AND $durationOnlyHoursOrLess*/)
            {

                return $price * $hours;
            }

            return null;
        }
        elseif ($price_id == 10)
        {
            //PpricePerHourOverFourWeekend
            if ($this->isWeekend($startDateTimeString) AND $this->isWeekend($endDateTimeString) AND $hours >= 4 /*AND $durationOnlyHoursOrLess*/)
            {
                return $price * $hours;
            }
            return null;

        }
        elseif ($price_id == 11)
        {
            //PerThreeSixDays
            if($days > 2 and $days < 7 and $diff->y == 0 AND $diff->m == 0)
            {
                return $price * $days;
            }

            return null;

        }
        elseif ($price_id == 12)
        {
            //Per week (13 below) with extra per day over a week
/*dd($weeks, $days, $weekPrice, $weekPrice + ($price * $remainderDays));*/
            if($weeks > 0 AND ($days > 7 AND $days < 14) AND $weekPrice <> 0 and $price <> 0)
            {

                return $weekPrice + ($price * $remainderDays);
            }
            else
            {
                return null;
            }

        }
        elseif ($price_id == 13)
        {
            //Per week

            return $price * $roundWeeks;  //with  $roundWeeks ..>>>>> 8 days = 2 weeks for example
        }

        return $totalPrice;
    }

    private function calcHours($d, $h, $m, $s)
    {
        $hours = $h;

        if (!($d == 0))
        {
            $hours = $hours + ($d * 24);
        }

        if(!($m == 0 AND $s == 0))
        {
            $hours = $hours + 1;
        }

        return $hours;
    }

    private function calcDays($d, $h, $m, $s)
    {
        $days = $d;

        if(!($h == 0 ANd $m == 0 AND $s == 0))
        {
            $days = $days + 1;
        }

        return $days;
    }

    private function calcWeeks($w, $d, $h, $m, $s)
    {

        $weeks = $w;

        if(!($d = 0 and $h == 0 ANd $m == 0 AND $s == 0))
        {
            $weeks = $weeks + 1;
        }

        return $weeks;
    }

}


