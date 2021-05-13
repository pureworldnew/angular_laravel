<?php namespace App\BokaKanot\Repositories;

use App\Category;
use App\Product;
use DB;
use DebugBar\DebugBar;

class SearchRepository
{
    public function search ($primaryCategoryId, $childCategoryId, $quantity, $startDate, $endDate)
    {
        if($childCategoryId == 0)
        {
            $Products = Product::where("category_id", "=", $primaryCategoryId);
            //dd($Products->get());
        }
        else
        {
            $Products = Product::where("category_id", "=", $childCategoryId);
        }

        $feeCategory = Category::where('is_admin_category', 1)->first();

        if($feeCategory[0])
        {
            $Products = $Products->where("category_id", "<>", $feeCategory->id);
        }

        $Products = $Products
            ->with('category')
            ->with('product_images')
            ->with('start_times')
            ->with('per_type')
            ->with('per_type_times')
            /*->with(['per_type_times' => function($query) use ($language)
            {
                $query->where('lang', $language);
            }])*/
            ->with('prices')
            ->get();

        return $Products;
    }

    public function searchOld ($primaryCategoryId, $childCategoryId, $quantity, $startDate, $endDate)
    {
        $query = "SELECT count(bp.id) as numberBookings, SUM( IFNULL( bp.quantity, 0 ) ) AS numberOfProductsBooked, p.name, p.quantity, p.*, pi.image as image ".
            "FROM `products` p ".
            "left JOIN `booking_product` bp on p.id = bp.product_id ".
            "AND ((endDateTime >=  ? and endDateTime <= ?) or (startDateTime >= ? and startDateTime <= ?)) ".
            "LEFT JOIN product_images pi on p.id = pi.product_id ".
            "where (p.category_id = ? or p.category_id = ?) ".
            "Group BY p.id ".
            "having (numberOfProductsBooked + ?) <= quantity";


        $results = DB::select($query, [ $startDate, $endDate,$startDate, $endDate, $primaryCategoryId, $childCategoryId, $quantity ])
                      /*  ->with('product_starttimes')*/;

        dd($results);

        return $results;
    }
    /*SELECT count(bp.id) as numberBookings, SUM( IFNULL( bp.quantity, 0 ) ) AS numberOfProductsBooked, p.name, p.quantity, p.*, pi.image as image, st.start_value

FROM `products` p

left JOIN `booking_product` bp on p.id = bp.product_id AND ((endDateTime >=  '2016-04-30 0:0:0' and endDateTime <= '') or (startDateTime >= '2016-04-30 0:0:0' and startDateTime <= ''))

LEFT JOIN product_images pi on p.id = pi.product_id
left join product_start_times pst on p.id = pst.product_id
left join start_times st on st.id = pst.start_times_id
where (p.category_id = '3' or p.category_id = '0') Group BY p.name having (numberOfProductsBooked + '1') <= quantity*/
}







/*  // Select from Products where Product is in Sub-category x ("Eventuell underkategori ") and where not all of our stock of them are booked
        //>>>>> AND they are bookable Per day / per hour / per unit?

        //$query = "Select * from products where category_id = :childCategoryId";

        /* working before availability - $products = Product::where("category_id", "=", $primaryCategoryId)
                ->orWhere("category_id", "=", $childCategoryId)
            /*->with('product_images')
                ->where('primary_image', '1')* /
                    ->with(['product_images' => function ($query) {
                        $query->where('primary_image', '=', '1');

                    }])->get();* /

$query1 =  "select * FROM `products` p where (p.category_id = :primaryCategoryId)";
$results1 = DB::select($query1, array('primaryCategoryId' => $primaryCategoryId));

//dd($results1);

/*$query2 = "SELECT count(bp.id) as numberBookings, p.name, p.quantity, p.*, pi.image as image ".
//$query2 = "SELECT * ".
    "FROM `products` p ".
    "left JOIN `booking_products` bp on p.id = bp.product_id AND ((end >  ':startDate' and end < ':endDate') or (start > ':startDate' and start < ':endDate')) ".
    "INNER JOIN product_images pi on p.id = pi.product_id ".
    "where (p.category_id = :primaryCategoryId or p.category_id = :childCategoryId) ".
    "Group BY p.name ";
$results2 = DB::select($query2, array('primaryCategoryId' => $primaryCategoryId, 'childCategoryId' => $childCategoryId));

dd($results2);* /
// "where (p.category_id = :primaryCategoryId or p.category_id = :childCategoryId) ".

$query2 = "SELECT count(bp.id) as numberBookings, p.name, p.quantity, p.*, pi.image as image ".
    "FROM `products` p ".
    "left JOIN `booking_products` bp on p.id = bp.product_id AND ((endDateTime >  ':searchStartDate' and endDateTime < ':searchEndDate') or (startDateTime > ':searchStartDate' and startDateTime < ':searchEndDate')) INNER JOIN product_images pi on p.id = pi.product_id where (p.category_id = :primaryCategoryId )".
    // "INNER JOIN product_images pi on p.id = pi.product_id ".
    //"where (p.category_id = :primaryCategoryId ) ".
    "Group BY p.name ".
    "having numberBookings < quantity";
//d($query2);

//dd($primaryCategoryId, $childCategoryId, $quantity, $startDate, $endDate);
//$results2 = DB::select($query2, [ 'primaryCategoryId' => $primaryCategoryId, 'childCategoryId' => $childCategoryId, 'searchStartDate' => $startDate, 'searchEndDate' => $endDate ]);


//$results2 = DB::select($query2, array('thePrimaryCategoryId' => $primaryCategoryId, 'theChildCategoryId' => $childCategoryId, 'searchStartDate' => $startDate, 'searchEndDate' => $endDate ));
dd($results2);
//dd($products->first()->product_images()->first()->image);

//return $results;*/