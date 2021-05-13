<?php

namespace App\Http\Controllers;

use App\BokaKanot\Repositories\BookingRepository;
use App\BokaKanot\Repositories\CategoryRepository;
use App\BokaKanot\Repositories\CentreRepository;
use App\BokaKanot\Repositories\ProductRepository;
use App\Centre;
use App\Http\Requests\CentreRequest;
use App;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CentreController extends Controller
{

    /**
     * @var CentreRepository
     */
    private $centreRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;
    /**
     * @var BookingRepository
     */
    private $bookingRepository;

    public function __construct(CentreRepository $centreRepository, ProductRepository $productRepository, CategoryRepository $categoryRepository , BookingRepository $bookingRepository)
    {
        $this->centreRepository = $centreRepository;
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->bookingRepository = $bookingRepository;
    }

    public function selectCentre($slug, $locale="")
    {

        $centreDetails = $this->centreRepository->getCentreDetailsFromSlug($slug);

        if (sizeof($centreDetails) > 0)
        {
            Session::set('centreId', $centreDetails[0]['id']);
            //return redirect('/lang/'.$language."/booking");

            if (array_key_exists($centreDetails[0]->default_language, Config::get('languages'))) {
                Session::set('applocale', $centreDetails[0]->default_language);
            }
            if($locale <> "")
            {
                Session::set('applocale', $locale);
            }


            return redirect('/booking');
        }

        App::setLocale($locale);

        Session::flash('message', trans('errors/centre.invalidCentreSlug'));

        return redirect('admin/settings');

    }

    /**
     * @param $id
     * @param CentreRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, CentreRequest $request) {
        
       // echo $request->NeedLogin;

        //dd($request->get('klarna_test_mode'),  $request->get('klarna_api_key'), $request->get('asdf'));
        $centreId = $id;
        $centre = Centre::with(['payment_methods'])->findOrFail($id);

        if ($request->get('useAdminFee') == null)
        {
            $centre->useAdminFee = 0;

            //Does the bookingproduct exist? If so delete it.

        }
        else
        {
            if(!is_numeric($request->get('adminFee')))
            {
                return redirect()->back()->withErrors(['adminFee', 'Admin fee must be numeric']);
            }

            if($request->get('adminFee') < 1)
            {
                return redirect()->back()->withErrors(['adminFee', 'Admin fee must be greater than 0']);
            }

            $categoryId = $this->categoryRepository->getFeeCategory($centreId);

            //Does the adminFee booking product exist?
            if (!$categoryId){

                $categoryId = $this->categoryRepository->createFeeCategory($centreId);

            }

            $productId = $this->productRepository->getAdminProduct($categoryId);

            if (!$productId){

                $productId = $this->productRepository->createAdminProduct($categoryId, ($request->has('adminFee')) ? $request->get('adminFee') : 0);

            }

            /*dd($productId, $categoryId);
            $this->bookingRepository->createBookingProduct();*/

            //insertBookingProduct

            $this->productRepository->updateFeePrice($productId, $request->get('adminFee'));
            
        }

        $centre->klarna_test_mode = $request->has('klarna_test_mode');
        $centre->klarna_only = $request->has('klarna_only');
        $centre->paypalemail = $request->has('paypalemail');
        $centre->NeedLogin = $request->NeedLogin;
		

        $centre->update($request->all());

        if ($request['payment_methods'] != null)
        {
            $this->centreRepository->updateCentrePaymentMethods($centreId, $this->centreRepository->getCentrePaymentMethodsWithInactive($centreId), $request->input('payment_methods'));

            echo "<hr/>";
        }
        else
        {
            foreach($centre->payment_methods as $index => $payment_method)
            {
                $centre->payment_methods[$index]->pivot->active = 0;
                //echo "<p>".$centre->payment_methods[$index]->pivot->active."</p>";
            }
        }

        if($request['custom_text'] != null)
        {
            $this->centreRepository->updateCustomText($centreId, $request['custom_text']);

        }
        $centre->push();

        Session::flash('message', 'Centre settings have been saved');

        return redirect($request->has('redirectUrl') ? $request->get('redirectUrl') : 'admin/settings');
    }

}
