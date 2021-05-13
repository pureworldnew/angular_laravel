<?php

namespace App\Http\Controllers;

use App\BokaKanot\Repositories\AvailabilityRepository;
use App\BokaKanot\Repositories\ProductRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AvailabilityController extends ApiController
{
    /**
     * @var AvailabilityRepository
     */
    private $availabilityRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(AvailabilityRepository $availabilityRepository, ProductRepository $productRepository)
    {

        $this->availabilityRepository = $availabilityRepository;
        $this->productRepository = $productRepository;
    }


    public function productAvail (Request $request) {


        //$products = $this->availabilityRepository->searchProductDate($request->get('productId'), $request->get('startDateTime'), $request->get('endDateTime'), $request->get('quantity'));
        $products = $this->productRepository->getAvailability($request->input('productId'), $request->input('startDateTime'), $request->input('endDateTime'));

        $quantityOfProductBooked = $products->first()->totalProductPrice();

        $numberAvailableProducts = ($products[0]->quantity - $quantityOfProductBooked);

        //dd($numberAvailableProducts, $products);
        $message = "";
        if ($numberAvailableProducts < $request->get('quantity'))
        {
            $message = trans('availability.notEnough');
            $products = [];
        }
        // get the preexisting session 
        
            $invited =  Session::get('invited');
            $centreId = Session::get('centreId');
            $centreName = Session::get('centreName');
            
            Session::set('invited', true);
            Session::set('centreId', $centreId);
            Session::set('centreName', $centreName);

        //return view('home')->with(['navPage' => ""]);
        return $this->respond([
            'data' => $products,
            "message" => $message,
            'quantityAvailabile' => $numberAvailableProducts,
            "quantityOfProductBooked" => $quantityOfProductBooked
        ]);

    }

}
