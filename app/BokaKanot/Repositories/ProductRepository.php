<?php namespace App\BokaKanot\Repositories;

use App\Price;
use App\Product;
use DB;
use Mockery\CountValidator\Exception;

class ProductRepository
{
    public function getAvailabilityPerProduct($productId)
    {
        return Product::where('id', $productId)
            ->with(['bookings' => function($query) use ($startDateTime, $endDateTime)
            {
                //$query->where('title', 'like', '%first%');
                //$query->where('product_id', 30);
                $query->Where(function($query) use ($startDateTime, $endDateTime){
                    $query->where('endDateTime', '>', $startDateTime);
                    $query->where('endDateTime', '<=', $endDateTime);
                });
                $query->orWhere(function($query) use ($startDateTime, $endDateTime){
                    $query->where('startDateTime', '>=', $startDateTime);
                    $query->where('startDateTime', '<', $endDateTime);
                });
                $query->orWhere(function($query) use ($startDateTime, $endDateTime){
                    $query->where('startDateTime', '<=', $startDateTime);
                    $query->where('endDateTime', '>=', $endDateTime);
                });
                $query->orWhere(function($query) use ($startDateTime, $endDateTime){
                    $query->where('startDateTime', '>', $startDateTime);
                    $query->where('endDateTime', '<', $endDateTime);
                });
            }])
            ->get();
    }

    public function getAvailability($productId, $startDateTime, $endDateTime)
    {
        //dd($productId, $startDateTime, $endDateTime);
        $products = Product::where('id', $productId)
            ->with(['bookings' => function($query) use ($startDateTime, $endDateTime)
            {
                $query->where(function($query) use ($startDateTime, $endDateTime){
                    $query->Where(function($query) use ($startDateTime, $endDateTime){
                        $query->where('endDateTime', '>', $startDateTime);
                        $query->where('endDateTime', '<=', $endDateTime);
                    });
                    $query->orWhere(function($query) use ($startDateTime, $endDateTime){
                        $query->where('startDateTime', '>=', $startDateTime);
                        $query->where('startDateTime', '<', $endDateTime);
                    });
                    $query->orWhere(function($query) use ($startDateTime, $endDateTime){
                        $query->where('startDateTime', '<=', $startDateTime);
                        $query->where('endDateTime', '>=', $endDateTime);
                    });
                    $query->orWhere(function($query) use ($startDateTime, $endDateTime){
                        $query->where('startDateTime', '>', $startDateTime);
                        $query->where('endDateTime', '<', $endDateTime);
                    });

                });

                $query->where(function($query) {
                    $query->orWhere('status', 0);
                    $query->orWhere('status', 1);
                    $query->orWhere('status', 2);
                    $query->orWhere('status', 3);

                });

            }])
            //->with('booking_product')
            ->get();

        return $products;
    }

    public function getCentreProducts($userId)
    {
        $query = "SELECT * FROM users u INNER JOIN centre_user cu ON u.id = cu.user_id INNER JOIN centres c ON c.id = cu.centre_id INNER JOIN categories cat ON cat.centre_id = c.id INNER JOIN products p ON p.category_id = cat.id INNER JOIN product_images pi on product_id = p.id WHERE u.ID =:userId and pi.primary_image = 1";

        return DB::select($query, array('userId' => $userId));
    }

    public function getStartTimes()
    {
        $query = "select * from start_times";

        return DB::select($query);
    }

    public function getProductStartTimes($productId)
    {
        $query = "SELECT st.start_value, pst.active, st.start_time, pst.id as pstId, st.id as stId FROM products p inner join product_start_times pst on  p.id = pst.product_id AND pst.product_id = :productId right join start_times st on pst.start_times_id = st.id order by start_value asc";

        return DB::select($query, array('productId' => $productId));
    }

    public function updateFeePrice ($productId, $price)
    {
        $query = "update price_product set price =:price where product_id =:productId and price_id=3";

        return DB::update($query, array('price' => $price, 'productId' => $productId));

        /*Product::find($productId)
            ->prices()
            ->where('id', 3)
            ->update(['price' => $adminFee]);*/
    }

    public function updatePrices($productId, $prices, $request)
    {
        $resetQuery = "delete from price_product WHERE product_id = :productId";


        DB::delete($resetQuery, [ 'productId' => $productId ]);

        $this->insertPrices($productId, $prices, $request);

        return true;
    }

    public function insertPrices($productId, $prices, $request)
    {

        foreach ($prices as $price) {
            //dd($this->getPriceFromRequest($price->priId, $request));

            if ($request->has('price'.$price->shortCode)) {
                //echo "<p>Here".'price'.$price->shortCode."</p>";
                $query = "insert into price_product (product_id, price_id, price) values (:productId, :priId, :price)";

                //$updateIds .= "$startTime->stId,";
                // dd($query, $productId, $startTime->stId);

                if($this->getPriceFromRequest($price->priId, $request) == null)
                {
                    echo "Null price error";
                    dd($price->priId, $request);
                }
                //dd($this->getPriceFromRequest($price->priId, $request));
                try{
                    DB::insert($query, [ 'productId' => $productId, "priId" => $price->priId, "price" => $this->getPriceFromRequest($price->priId, $request)]);
                }
                catch(Exception $e)
                {
                    dd($e, $price->priId);
                }


            }
            else
            {
                 dd("Error no price available for ".$price->shortCode, $request);
                //dd($price, $request);
            }
        }

    }

    public function updateStartTimes($productId, $startTimes, $inputStartTimeArray)
    {
        $resetQuery = "delete from product_start_times WHERE product_id = :productId";

        DB::delete($resetQuery, [ 'productId' => $productId ]);

        $this->insertStartTimes($productId, $startTimes, $inputStartTimeArray);

        return true;
    }

    public function updatePerTypeTimes($productId, $perTypes, $inputPerTypeArray, $inputPerTypeMaxDurationArray)
    {
        
        $resetQuery = "delete from per_type_time_product WHERE product_id = :productId";

        DB::delete($resetQuery, [ 'productId' => $productId ]);

        $this->insertPerTypeTimes($productId, $perTypes, $inputPerTypeArray, $inputPerTypeMaxDurationArray);

        return true;
    }

    public function deleteProductImage($productId, $productImageId)
    {
        \App\Product_Images::where('id', $productImageId)->delete();

        return true;
    }
    /*public function updatePerTypes($productId, $perTypes, $inputPerTypeArray)
    {
        $resetQuery = "delete from per_types_product WHERE product_id = :productId";

        DB::delete($resetQuery, [ 'productId' => $productId ]);

        $this->insertPerTypes($productId, $perTypes, $inputPerTypeArray);

        return true;
    }

    public function insertPerTypes($productId, $perTypes, $inputPerTypeArray)
    {
        foreach ($perTypes as $perType) {
            if (array_key_exists($perType->type_value, $inputPerTypeArray)) {
                $query = "insert into per_types_product (active, product_id, per_types_id) values (1, :productId, :ptId)";

                //$updateIds .= "$startTime->stId,";
                // dd($query, $productId, $startTime->stId);
                DB::insert($query, [ 'productId' => $productId, "ptId" => $perType->ptId]);
            }
        }
    }*/

    public function insertPerTypeTimes($productId, $perTypeTimes, $inputPerTypeTimeArray, $inputPerTypeMaxDurationArray)
    {
        foreach ($perTypeTimes as $perTypeTime) {
            if (array_key_exists($perTypeTime->type_time_value, $inputPerTypeTimeArray)) {
                $query = "insert into per_type_time_product (active, product_id, per_type_time_id, max_duration) values (1, :productId, :pttId, :maxDuration)";

                //$updateIds .= "$startTime->stId,";
                // dd($query, $productId, $startTime->stId);
                $parameters = ['productId' => $productId, "pttId" => $perTypeTime->pttId, "maxDuration" => intval($inputPerTypeMaxDurationArray[$perTypeTime->type_time_value])];
                DB::insert($query, $parameters);
            }
        }
    }

    public function insertStartTimes($productId, $startTimes, $inputStartTimeArray)
    {
        foreach ($startTimes as $startTime) {
            if (array_key_exists($startTime->start_value, $inputStartTimeArray)) {
                $query = "insert into product_start_times (active, product_id, start_times_id) values (1, :productId, :stId)";

                //$updateIds .= "$startTime->stId,";
               // dd($query, $productId, $startTime->stId);
                DB::insert($query, [ 'productId' => $productId, "stId" => $startTime->stId]);
            }
        }
    }

    /*public function getPerTypes($productId)
    {
        $query = "SELECT pt.type_value, pt.type_name, pt.id as ptId FROM products p right join per_types pt on p.per_type_id = pt.id  where p.id = :productId order by type_name asc";

        return DB::select($query, array('productId' => $productId));
    }

   */

    public function getPrices($productId)
    {

        $query = "SELECT pri.shortCode, pri.name, pp.id as ppId, pri.id as priId FROM products p inner join price_product pp on  p.id = pp.product_id AND pp.product_id = :productId right join prices pri on pp.price_id = pri.id order by pri.name asc";

        return DB::select($query, array('productId' => $productId));
    }

    public function getPerTypeTimes($productId = 0)
    {
        if ($productId) {
            $query = "SELECT ptt.type_time_value, pttp.active, ptt.type_time_name, pttp.id AS pttpId, pttp.max_duration AS max_duration, ptt.id AS pttId FROM products p INNER JOIN per_type_time_product pttp ON p.id = pttp.product_id AND pttp.product_id = :productId RIGHT JOIN per_type_times ptt ON pttp.per_type_time_id = ptt.id ORDER BY type_time_name ASC";
            return DB::select($query, array('productId' => $productId));
        }
    }

    public function getAllPerTypes()
    {
        $query = "select * from per_types";

        return DB::select($query);
    }

    public function getAllPerTypeTimes()
    {
        $query = "select * from per_type_times";

        return DB::select($query);
    }

    /*public function getProductPrices($productId)
    {
        $query = "select * from price_product where product_id = :productId";

        return DB::select($query, [ 'productId' => $productId ]);
    }*/

    public function getProductPrices($productId)
    {
        $prices = Product::where('id', $productId)
                    ->with('prices')
                    ->with('per_type')
                ->first();

        return $prices;
/*
        $query = "select * from price_product where product_id = :productId";

        return DB::select($query, [ 'productId' => $productId ]);*/
    }

    private function getPriceFromRequest($priId, $request)
    {
        if ($priId == 1) {
            return $request['pricePerHour'];
        } elseif ($priId == 2) {
            return $request['pricePerHourWeekend'];
        } elseif ($priId == 3) {
            return $request['pricePerDay'];
        } elseif ($priId == 4) {
            return $request['pricePerDayWeekend'];
        } elseif ($priId == 5) {
            return 0;
        } elseif ($priId == 6) {
            return 0;
        } elseif ($priId == 7) {
            return $request['pricePerProduct'];
        } elseif ($priId == 8) {
            return $request['pricePerBooking'];
        } elseif ($priId == 9) {
            return $request['pricePerHourOverFour'];
        } elseif ($priId == 10) {
            return $request['pricePerHourOverFourWeekend'];
        } elseif ($priId == 11) {
            return $request['pricePerThreeSixDays'];
        } elseif ($priId == 12) {
            return $request['pricePerWeekExtraDay'];
        } elseif ($priId == 13) {
            return $request['pricePerWeek'];
        } elseif ($priId == 14) {
            return $request['pricePerTwoDays'];
        } elseif ($priId == 15) {
            return $request['pricePerTwoDaysWeekend'];
        }
    }

    public function makeProductImagePrimary($productId, $productImageId)
    {
        \App\Product_Images::where('product_id', $productId)->update(['primary_image' => 0]);

        \App\Product_Images::where('id', $productImageId)->update(['primary_image' => 1]);
    }
    
    public function hasAdminProduct($categoryId)
    {
        return sizeof(Product::where('name', "Admin Fee")
            ->where('category_id', $categoryId)
            ->get());
    }

    public function getAdminProduct($categoryId)
    {
        $feeProduct = Product::where('name', "Admin Fee")
            ->where('category_id', $categoryId)
            ->get();

        if(sizeof($feeProduct) > 0)
        {
            return $feeProduct[0]->id;
        }
        else
        {
            return 0;
        }
    }
    
    public function createAdminProduct($categoryId, $adminFee)
    {
        $product = new Product();

        $product->category_id = $categoryId;
        $product->name = "Admin Fee";
        $product->per_type_id = 1;

        $product->save();

        $productId = DB::getPdo()->lastInsertId();

        $LastInsertedProduct = Product::find($productId);
        $LastInsertedProduct->prices()->attach(3, ['price' => $adminFee]);

        return $productId;
    }
}
/*
 * //$query = "insert into product_start_times values('active')  = 1  WHERE start_times_id IN (";

        $updateIds = "";//$updateIds = rtrim($updateIds, ',');

        //$query .= "$updateIds) AND product_id = :productId";
 */
