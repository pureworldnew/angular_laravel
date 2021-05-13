<?php namespace App\BokaKanot\Repositories;

use App\Booking;
use App\BookingInvoice;
use App\BookingProduct;
use DB;
use Faker\Provider\DateTime;

class BookingRepository
{
    public function countProductsUsed ($startDateTime, $endDateTime, $productTypeId)
    {
        $query = "Select count(*) from Booking where start >= :startDateTime and start < :endDateTime AND booking_product.product_id = $productTypeId";
        return DB::select($query, array('startDateTime' => $startDateTime, 'endDateTime' => $endDateTime, 'productTypeId' => $productTypeId))[0];
    }

    public function getBookingProductStripeChargeId ($bookingId)
    {
        return Booking::where("id", $bookingId)
            ->get()[0]->stripe_charge_id;
    }
    
    public function createBookingProduct($item, $bookingId, $productPrice)
    {
        // dd($item);
        $reservePrice = $productPrice * $item['reservepercentage'] /100;
        $reserveRestPrice = $productPrice - $reservePrice;
        $BookingProduct = new BookingProduct;

        $BookingProduct->product_id = $item['productId'];
        $BookingProduct->quantity = $item['quantity'];
        $BookingProduct->booking_id = $bookingId;
        $BookingProduct->startDateTime =  $item['startDateTime'];
        $BookingProduct->endDateTime = $item['endDateTime'];
        $BookingProduct->per_type_time_id = isset($item['timeType']) ? $item['timeType'] : null; //will happen for "per product" products
        $BookingProduct->price = $productPrice;
        $BookingProduct->reserve_price = $reservePrice;
        $BookingProduct->reserve_rest_price = $reserveRestPrice;
        $BookingProduct->persons = isset($item['persons']) ? $item['persons'] : null;
        

        $BookingProduct->save();

        return $BookingProduct->id;
    }

    public function fetchBooking($bookingId)
    {
        return Booking::where("id", "=", $bookingId)
           // ->with('products.category')
            ->with(['products.category' => function ($query) {
               $query->select('name', "id");
           }])->get();


/*return Event::with(['city' => function ($query) {
   $query->select('id', '...');
},
with(['city.companies' => function ($query) {
  $query->select('id', '...');
},
with(['city.companies.persons' => function ($query) {
  $query->select('id', '...');
}
])->get(); */
         /*return DB::table('bookings')
             ->with('booking_products')
             ->where('id', '=', $bookingId)
             ->get();*/

    }

    public function hardDeleteBookingProduct($bookingProductId)
    {
        $bp = BookingProduct::find($bookingProductId);

        return $bp->forceDelete();
    }

    public function deleteBookingProduct($bookingProductId)
    {
       // $success = DB::table('booking_product')->delete($bookingProductId);

        return BookingProduct::destroy($bookingProductId);

       /* $bookingProduct = BookingProduct::find($bookingLocationId);

        $bookingProduct::destroy($bookingLocationId);*/

        //DB::table('booking_product')->delete($bookingLocationId);

    }

    public function getBookingsObj($centreId)
    {
        
       return Booking::where('centre_id', $centreId)
                ->whereNull('deleted_at')
                ->filterSearchBookings()
                ->orderBy('id', 'DESC')
                ->get();

    }

    public function getBookings($searchDateTime="", $centreId)
    {
        $whereCondition = "";

        if ($searchDateTime <> "")
        {
            $whereCondition = " and bp.startDateTime BETWEEN :searchDateTimeStart AND :searchDateTimeEnd" ;
        }

        $query = "SELECT b.id as bookingId, b.payment_method, b.payment_method_id, b.payment_date, count(bp.id) as numberProducts, c.name as categoryName, p.name as productName, sum(bp.price) as bookingPrice, b.status, bp.startDateTime, b.name as bookingName, p.name as productName FROM  `bookings` b INNER JOIN booking_product bp ON b.id = bp.booking_id INNER JOIN products p ON bp.product_id = p.id INNER JOIN categories c ON p.category_id = c.id where (b.status = 1 or b.status = 2 or b.status = 3 or b.status = 4 or b.status = 5 ) $whereCondition and b.centre_id = :centreId GROUP BY bookingId order by bookingId desc";
        //$query = "Select count(*) from Booking where start >= :startDateTime and start < :endDateTime AND booking_product.product_id = $productTypeId";
        //return DB::select($query, array('startDateTime' => $startDateTime, 'endDateTime' => $endDateTime, 'productTypeId' => $productTypeId))[0];

        if ($searchDateTime <> "")
        {
            $startDateTime = $searchDateTime." 00:00:00";
            $endDateTime = $searchDateTime." 23:59:59";

            $results = DB::select($query, [ 'centreId' => $centreId, 'searchDateTimeStart' => $startDateTime, 'searchDateTimeEnd' => $endDateTime]);
        }
        else
        {
            //dd('what');
            $results = DB::select($query, [ 'centreId' => $centreId]);
        }

        return $results;
    }

    public function getBookingProduct($id)
    {

        return DB::table('booking_product')
            ->where('id', '=', $id)
            ->get();
    }

    public function getBookingProductByBookingId($id)
    {

        return DB::table('booking_product')
            ->where('booking_id', '=', $id)
            ->get();
    }

    public function getNoBookBeforeDays($id)
    {

    }

    public function getBookingFromBookingProductId($bpId)
    {
        //dd($bpId, BookingProduct::where('id', 384)->first(), BookingProduct::where('id', 382)->first());

        $bookingProduct = BookingProduct::where('id', $bpId)->first();

        if($bookingProduct)
        {
            $id = $bookingProduct->booking_id;

            return $this->getDetails($id);
        }

        return 0;



    }

    public function getCurrentBookingProducts($id)
    {
        $products = $this->getDetails($id)->products()->wherePivot('deleted_at', null)->get();
return $products;
        /*foreach($products as $product)
        {
            echo "<p>"$product->pivot->deleted_at
        }*/
    }

    public function getDetails($id)
    {
        return Booking::where('id', $id)
            // actuall pivot ->whereNull('deleted_at')
            ->with('products')
            ->first();
    }

    public function getBookingDetails($id)
    {

        $query = "SELECT b.id as bookingId, sum(bp.price) as bookingPrice, b.email, b.name as bookingName, b.address, b.address2, b.city, b.post_code, b.country, b.klarna_orderId, b.klarna_reservationId, b.booking_invoice_id, b.telephone, b.centre_id as centreId, b.payment_method_id, bp.id as bpId, bp.quantity as bookingQuantity, b.payment_method, b.payment_date, bi.invoice_id as main_klarna_invoiceId, bp.booking_invoice_id as productInvoiceId, b.klarna_reservationId, c.name as categoryName, p.name as productName, b.status, bp.*, p.id as productId, p.* FROM  `bookings` b INNER JOIN booking_product bp ON b.id = bp.booking_id INNER JOIN products p ON bp.product_id = p.id INNER JOIN categories c ON p.category_id = c.id INNER JOIN booking_invoice bi ON b.booking_invoice_id = bi.id where b.id = :bookingId ";

        return DB::select($query, ['bookingId' => $id]);


        /*dd(Booking::where('id', $id)
            ->with('products')
            ->first()->products);*/ ///->first()->category()->first()->name
        /* return Booking::where('id', $id)
             ->with('products')
             ->first();*/
    }

    public function getBookingCentreDetailsFunction($id)
    {
        dd(Booking::where("id", "=", $id)
            ->with('products')
            ->first()->products->first()->category->centre->superUser());



        
        dd(Booking::where("id", "=", $id)
            ->with('products')
            ->first()->products->first()->category->centre->users->first()->id, Booking::where("id", "=", $id)
            ->with('products')
            ->first()->products->first()->category->centre->users->first()->isSuperAdmin());

        /* dd(Booking::where("id", "=", $id)
             ->with('products')
         ->first()->products->first()->category->centre->users->where('', 1)->first());*/
    }

     public function getBookingCentreDetails($id)
     {
        /* dd(Booking::where("id", "=", $id)
             ->with('centre')
             ->get());*/



        $query = "SELECT b.id as bookingId, cent.id as centreId, bp.id as bpId, b.token, u.email as centreEmail, cent.noCancelDays, cent.num_pay_advance_days, bi.invoice_id as main_klarna_invoiceId, bp.klarna_invoiceId as productInvoiceId, b.klarna_reservationId, c.name as categoryName, p.name as productName, b.status, bp.*, p.id as productId, p.* FROM  `bookings` b INNER JOIN booking_product bp ON b.id = bp.booking_id INNER JOIN products p ON bp.product_id = p.id INNER JOIN categories c ON p.category_id = c.id INNER JOIN centre_user cu on b.centre_id = cu.centre_id and cu.user_type_id = 1 inner join centres cent on b.centre_id = cent.id INNER JOIN users u on cu.user_id = u.id INNER JOIN booking_invoice bi ON b.klarna_invoiceId = bi.id where b.id = :bookingId ";
        //$query = "Select count(*) from Booking where start >= :startDateTime and start < :endDateTime AND booking_product.product_id = $productTypeId";
        //return DB::select($query, array('startDateTime' => $startDateTime, 'endDateTime' => $endDateTime, 'productTypeId' => $productTypeId))[0];
        return DB::select($query, ['bookingId' => $id]);
    }


    public function getBookingProducts($centreId, $startDateTime, $endDateTime)
    {

        // WHERE b.status = 1 and
        $query = "select 
                    b.id, 
                    b.name as bookingName,
                    b.email,
                    b.telephone,
                    b.freeText,
                    bp.startDateTime,
                    bp.endDateTime,
                    bp.quantity, 
                    p.`name` as productName,
                    b.status,
                    b.paid,
                    b.payment_method
                from bookings b 
                    inner join  booking_product bp on b.id = bp.booking_id 
                    inner join  products p on bp.product_id = p.id 
                where b.centre_id = :centreId 
                    and b.status = 3
                    and bp.startDateTime >= :startdatetime
                    and bp.startDateTime <= :enddatetime
                order by b.id, bp.startDateTime";

        $var = ['centreId' => $centreId, 'startdatetime' => $startDateTime, "enddatetime" => $endDateTime];
        $sql = DB::select($query, $var);
        return $sql;
    }

    public function getAllBookingProducts($id, $token)
    {
        $booking = Booking::where('id', $id)
            ->where('token', $token)
            ->with('products')
            ->with('products.category')

            ->first();

        return $booking->products;
    }


    

    public function updateStatus($bookingId, $status)
    {

        Booking::where('id', $bookingId)
            ->update(['status' => $status]);
    }

    public function updateBookingProductStatus($bookingId, $status)
    {

        BookingProduct::where('booking_id', $bookingId)
            //->where('klarna_product_status')
            ->update(['status' => $status]);
    }

    public function registerPaymentProduct($bookingId, $bookingProductId)
    {
        $booking = Booking::find($bookingId);
        $booking->payProduct($bookingProductId);

        if($booking->allProductsPaidOrCancelled())
        {
            $booking->payBooking();
        }

    }
    public function cancelOrCreditBooking($bookingId)
    {
        $booking = Booking::find($bookingId);
        $booking->cancelOrCreditBooking();
    }

    public function registerPayment($bookingId)
    {
        $booking = Booking::find($bookingId);
        $booking->payBooking();

        /*$this->updateStatus($bookingId, Config('booking.status.PAID'));

        //
        Booking::where('id', $bookingId)
            ->update(['payment_date' => new \DateTime()]);*/

    }

    public function unregisterPayment($bookingId)
    {
        $this->updateStatus($bookingId, Config('booking.status.ACTIVATED'));
    }

    public function updateStripeCustomerNumber($bookingId, $customerId)
    {
        Booking::where('id', $bookingId)
            ->update(['stripe_customer_number' => $customerId]);

    }

    public function updateStripeChargeId($bookingId, $chargeId)
    {
        Booking::where('id', $bookingId)
            ->update(['stripe_charge_id' => $chargeId]);
    }

    public function getBookingIdFromBPId($bpId)
    {
        $bookingId = BookingProduct::find($bpId)->booking_id;

        return Booking::where("id", $bookingId)->with('products')->first();
    }

    /*public function getBookingWithProducts($booking_id)
    {
        return Booking::where('id', $booking_id)
            ->with('products')
            ->with(['products' => function($query)
            {
                $query->where('klarna_product_status', 1);
                $query->orWhere('klarna_product_status', 2);
                //$query->orWhere('klarna_product_status', 3); don't think so
            }])
            ->first();
    }*/

    public function updateBookingProductQuantity($id, $value)
    {
        return BookingProduct::where('id', $id)
            ->update(['quantity' => $value]);
    }

    public function getFeeRecord($productId, $bookingId)
    {
        return BookingProduct::where('product_id', $productId)
            ->where('booking_id', $bookingId)
            ->first();
    }

    public function updateBookingProductQuantityPrice($id, $quantity, $price)
    {
        return BookingProduct::where('id', $id)
            ->update(['quantity' => $quantity, 'price' => $price]);
    }

    public function pruneSearchResults()
    {
        $query = "SELECT b.id, bp.id, SUM(if(bp.updated_at < '2016-06-08 13:09:58', 1, 0)) AS productsInTime, count(bp.id) AS products FROM `bookings` b inner join booking_product bp on b.id = bp.booking_id WHERE b.id = 312";
    }

    public function pruneSearchBookingsNewerReplace()
    {
        Booking::doesntHave('products')->forceDelete();
        $pruneDate = new \DateTime();

        //$tosub = new DateInterval('PT1H30M');

        //$tosub = new \DateInterval('PT0H51M');
        $tosub = new \DateInterval('PT1H');
        //$tosub = new \DateInterval('P1D');
        $pruneDate->sub($tosub);

        echo "<h1>the prune date is ".date_format($pruneDate, 'Y-m-d H:i:s')."</h1>";

        $bookings = Booking::where('status', 0)->get();

        $deleteBookingIds = "";
        foreach($bookings as $booking)
        {
            if($booking->products()->select(DB::raw('count(booking_id) AS bpCount'))->first()->bpCount ==
                $booking->products()->wherePivot('updated_at', '<', date_format($pruneDate, 'Y-m-d H:i:s'))->select(DB::raw('count(booking_id) AS bpCount'))->first()->bpCount)
            {
                $deleteBookingIds .= $booking->id.",";
            }
        }
        $deleteBookingIds = rtrim($deleteBookingIds, ',');

        dd($deleteBookingIds, DB::table('bookings')->whereIn('id', array($deleteBookingIds))->get());


        //->with('products')
            /*->with(['products' => function ($q) use ($pruneDate) {
                    $q->wherePivot('updated_at', '<', date_format($pruneDate, 'Y-m-d H:i:s'));
                    }])*/
            //->select(DB::raw('count(booking_product) AS bpCount'))->first()->bpCount);

        //$q->wherePivot('booking_id', 312);


        /*return Booking::where('status', 0)
           // ->where('updated_at', '<', date_format($pruneDate, 'Y-m-d H:i:s'))
            ->get();
*/
        /*//->with('products')
        ->whereHas('products', function ($q) {
            $q->wherePivot('booking_id', '=', 264);
        })->get();*/


        //->with('products')
        //->having('pivot_updated_at','=','1')
        //->wherePivot('updated_at', '>', date_format($pruneDate, 'Y-m-d H:i:s'))
        //->orderBy('id', 'DESC')
        //->withPivot('id', 661)
        //->with(['products' => function($query) use ($pruneDate) {
        //$query->wherePivot('updated_at', '>', date_format($pruneDate, 'Y-m-d H:i:s'));
        //$query->wherePivot('updated_at', '<', date_format($pruneDate, 'Y-m-d H:i:s'));
        //$query->wherePivot('id', 661);

        //->withPivot('updated_at', '<', $pruneDate)

        /*}])*/
        //->take(20)
    }
    
    public function pruneSearchBookingsReal()
    {
        Booking::doesntHave('products')->forceDelete();

        $pruneDate = new \DateTime();

        //$tosub = new DateInterval('PT1H30M');

        $tosub = new \DateInterval('PT1H');
        //$tosub = new \DateInterval('P1D');
        $pruneDate->sub($tosub);

        //echo "<p>Date is ". date_format($pruneDate, 'Y-m-d H:i:s')."</p>";

        Booking::where('status', 0)
           ->where('updated_at', '<', date_format($pruneDate, 'Y-m-d H:i:s'))
            ->forceDelete();

        /*return Booking::where('status', 0)
           // ->where('updated_at', '<', date_format($pruneDate, 'Y-m-d H:i:s'))
            ->get();
*/
            /*//->with('products')
            ->whereHas('products', function ($q) {
                $q->wherePivot('booking_id', '=', 264);
            })->get();*/


        //->with('products')
        //->having('pivot_updated_at','=','1')
            //->wherePivot('updated_at', '>', date_format($pruneDate, 'Y-m-d H:i:s'))
            //->orderBy('id', 'DESC')
            //->withPivot('id', 661)
            //->with(['products' => function($query) use ($pruneDate) {
                //$query->wherePivot('updated_at', '>', date_format($pruneDate, 'Y-m-d H:i:s'));
                //$query->wherePivot('updated_at', '<', date_format($pruneDate, 'Y-m-d H:i:s'));
                //$query->wherePivot('id', 661);

                //->withPivot('updated_at', '<', $pruneDate)

            /*}])*/
            //->take(20)

    }


    
    public function getInvoicesArray($bookingId)
    {
        $booking = $this->getDetails($bookingId);

        $invoices = [];

        //main invoice id
        if($booking->booking_invoice_id <> null)
        {
            if(($booking->paymentMethodIsKlarna() AND $booking->isActivated()) or ($booking->paymentMethodIsInvoice() AND ($booking->isPaid() or $booking->isActivated()))) {
                $invoice = BookingInvoice::find($booking->booking_invoice_id);
                $invoices[$invoice->id] = $invoice->invoice_id;
            }
        }
        //dd($booking->products);

        //product invoice ids
        foreach ($booking->products as $product)
        {
            if ((($booking->paymentMethodIsKlarna() AND $product->isActivated()) or ($booking->paymentMethodIsInvoice())) AND $product->pivot->booking_invoice_id <> null)
            {

                if($product->pivot->booking_invoice_id <> null AND !array_key_exists($product->pivot->booking_invoice_id, $invoices))
                {
                    $invoice = BookingInvoice::find($product->pivot->booking_invoice_id);
                    $invoices[$product->pivot->booking_invoice_id] = $invoice->invoice_id;
                }

            }
        }

        return $invoices;
    }

    public function updateKlarnaOrderReservationIds($orderId, $reservationId, $bookingId, $cartUpdateAllowed)
    {
        return Booking::where('id', $bookingId)
            ->update(['klarna_orderId' => $orderId, 'klarna_reservationId' => $reservationId, "can_be_cancelled" => $cartUpdateAllowed ]);
    }

}