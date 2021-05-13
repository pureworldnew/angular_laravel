<?php namespace App\BokaKanot\Repositories;

use App\Centre;
use App\CentrePaymentMethods;
use App\PaymentMethods;
use DB;
use Illuminate\Support\Facades\App;

class CentreRepository
{
    public function getCentreFromSlug($slug)
    {
        return Centre::where('urlSlug', $slug)->first();
    }

    public function getCentreKlarnaDetails ($centreId)
    {
        $centre = Centre::where("id", "=", $centreId)
            ->with(['payment_methods'=> function($query)
            {
                $query->where('payment_methods_id', 4);
                $query->where('active', 1);

            }])
            //->select(['klarna_api_key', 'klarna_api_secret', 'id'])
            ->first();

        return $centre;

    }

    public function getCentreDetails ($centreId)
    {
        return Centre::where("id", "=", $centreId)
            ->with('payment_methods')
            ->with('users')
            ->get();

        $centre = Centre::where("id", "=", $centreId)->first()->payment_methods()->get();

        return $centre;

    }

    public function getCentreTextStrings ($centreId, $language)
    {
        return Centre::where("id", "=", $centreId)
            ->with('textStrings')
            ->get();



    }

    public function getCentreDetailsFromSlug ($slug)
    {
        return Centre::where("urlSlug", "=", $slug)
            ->get();


    }

   /* public function getCentrePaymentMethods ($centreId)
    {
        / *$query = "SELECT * FROM  `centre_payment_methods`  "
        $paymentMethods = CentrePaymentMethods::where("centre_id", $centreId)->where('active', 1)
            ->with('payment_method')
            ->get();* /

        $query = "SELECT * FROM centre_payment_methods cpm inner join payment_methods pm on cpm.payment_methods_id = pm.id where centre_id = :centreId and active = 1";

        return DB::select($query, array('centreId' => $centreId));

    }*/

    public function getCentrePaymentMethodsWithInactive ($centreId)
    {
        $query = "SELECT pm.name, cpm.active, pm.shortName, cpm.id as cpmId, pm.id as pmId FROM centres c inner join centre_payment_methods cpm on  c.id = cpm.centre_id AND cpm.centre_id = :centreId right join payment_methods pm on cpm.payment_methods_id = pm.id order by pm.name asc";

        return DB::select($query, array('centreId' => $centreId));
    }

    public function getCentrePaymentMethods ($centreId)
    {
        $query = "SELECT pm.name, cpm.active, pm.shortName, cpm.id as cpmId, pm.id as pmId FROM centres c inner join centre_payment_methods cpm on  c.id = cpm.centre_id AND cpm.centre_id = :centreId right join payment_methods pm on cpm.payment_methods_id = pm.id where active is not null and active = 1 order by pm.name asc";

        return DB::select($query, array('centreId' => $centreId));
    }

    public function getCentrePaymentInstructions ($centreId, $language)
    {
        $query = "SELECT pm.name, cpm.active, pm.shortName, cpm.id as cpmId, pm.id as pmId FROM centres c inner join centre_payment_methods cpm on  c.id = cpm.centre_id AND cpm.centre_id = :centreId right join payment_methods pm on cpm.payment_methods_id = pm.id order by pm.name asc";

        return DB::select($query, array('centreId' => $centreId));
    }

    public function getCentrePaymentMethodsText ($centreId)
    {
        //jpfjpfjpf
        dd(Centre::where('id', $centreId)
            ->with('payment_methods')
            ->first());
        
        /*$query = "SELECT pm.name, cpm.active, pm.shortName, cpm.id as cpmId, pm.id as pmId FROM centres c inner join centre_payment_methods cpm on  c.id = cpm.centre_id AND cpm.centre_id = :centreId right join payment_methods pm on cpm.payment_methods_id = pm.id order by pm.name asc";

        return DB::select($query, array('centreId' => $centreId));*/
    }


    public function getCustomTexts ($centreId)
    {
        //$query = "SELECT pm.name, cpm.active, pm.name, cpm.id as cpmId, pm.id as pmId FROM centres c inner join centre_payment_methods cpm on  c.id = cpm.centre_id AND cpm.centre_id = :centreId right join payment_methods pm on cpm.payment_methods_id = pm.id order by pm.name asc";
        $query = "SELECT * from centre_localisation WHERE centre_id = :centreId order by field_name";

        return DB::select($query, array('centreId' => $centreId));
    }

    public function updateCentrePaymentMethods($centreId, $startTimes, $inputCentrePaymentArray )
    {

        $resetQuery = "delete from centre_payment_methods WHERE centre_id = :centreId";

        DB::delete($resetQuery, [ 'centreId' => $centreId ]);

        $this->insertCentrePaymentMethods($centreId, $startTimes, $inputCentrePaymentArray);

        return true;

    }

    private function insertCentrePaymentMethods($centreId, $centrePaymentMethods, $inputCentrePaymentArray)
    {
        
        foreach($centrePaymentMethods as $centrePaymentMethod)
        {
            if (array_key_exists($centrePaymentMethod->shortName, $inputCentrePaymentArray))
            {
                $query = "insert into centre_payment_methods (active, centre_id, payment_methods_id) values (1, :centreId, :pmId)";

                //$updateIds .= "$startTime->stId,";

                DB::insert($query, [ 'centreId' => $centreId, "pmId" => $centrePaymentMethod->pmId]);
            }
        }

    }

    public function getPaymentMethods()
    {
        $query = "select * from payment_methods";

        return DB::select($query);
    }

    public function updateCustomText($centreId, $custom_text)
    {
        $resetQuery = "delete from centre_localisation WHERE centre_id = :centreId";

        DB::delete($resetQuery, [ 'centreId' => $centreId ]);

        $this->insertCustomText($centreId, $custom_text);

        return true;

    }

    public function insertCustomText($centreId, $custom_text)
    {
        foreach ($custom_text as $customTextKey => $customText)
        {
            /*var_dump($customText);*/
            foreach($customText as $languageCode=>$customTextLanguage)
            {
                echo $customTextKey . " ---> " .$languageCode. " >> " .$customTextLanguage."<br/>";
                $query = "insert into centre_localisation (centre_id, language, field_name, field_value) values (:centreId, :language, :fieldName, :fieldValue)";

                //$updateIds .= "$startTime->stId,";

                DB::insert($query, [ 'centreId' => $centreId, "language" => $languageCode, "fieldName" => $customTextKey, "fieldValue" => $customTextLanguage]);
            }
        }

    }

    public function checkSlugExists($slugName)
    {
        return Centre::where("urlSlug", "=", $slugName)
            ->get();
    }

    public function getCentreStripePublicKey($centreId)
    {
        return Centre::where("id", "=", $centreId)
            ->get()[0]->stripe_publishable_key;
    }

    public function getcentrePaypalemail($centreId)
    {
        return Centre::where("id", "=", $centreId)
            ->get()[0]->paypalemail;
    }

    public function getCentreStripeSecretKey($centreId)
    {
        return Centre::where("id", "=", $centreId)
            ->get()[0]->stripe_secret_key;
    }

    public function getCentreBookingFee($centreId)
    {
        return Centre::where("id", "=", $centreId)
            ->get()[0]->bookingFee;
    }

    public function getCentreLogo($centreId)
    {
        return Centre::where("id", "=", $centreId)
            ->get()[0]->logo_url;
    }

    public function getCentreAdminFee($centreId)
    {
        return Centre::where("id", "=", $centreId)
            ->get()[0]->adminFee;
    }

    public function getCentreConfirmBookingDetails($centreId)
    {
        return Centre::where("id", "=", $centreId)
           // ->with('textStrings')
            ->with(['textStrings' => function($query) use ($centreId)
            {
                $query->where('centre_id', $centreId);
                $query->where('language', App::getLocale());
                $query->where('field_name', "admin_fee");
               //$query->select('field_value');;
            }])
           // ->select(['useAdminFee', 'adminFee', 'bookingFee', 'field_value'])
               ->get()
            ->first();
    }
}

