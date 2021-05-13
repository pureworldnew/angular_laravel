<?php

namespace App\Http\Controllers;

use App\BokaKanot\PricingUtil;
use App\BokaKanot\Repositories\ProductRepository;
use App\BokaKanot\Transformers\ProductTransformer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PriceController extends ApiController
{
    /**
     * @var ProductTransformer
     */
    private $productTransformer;
    /**
     * @var PricingUtil
     */
    private $pricingUtil;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductTransformer $productTransformer, PricingUtil $pricingUtil, ProductRepository $productRepository)
    {

        $this->productTransformer = $productTransformer;
        $this->pricingUtil = $pricingUtil;
        $this->productRepository = $productRepository;
    }
    /**
     * @param $id
     * @return mixed
     */
    public function getPrice(Request $request){

        $products = $this->productRepository->getAvailability($request->input('productId'), $request->input('startDateTime'), $request->input('endDateTime'));

        //$quantityOfProductBooked =  $products->sum('booking_product.quantity');
        
        $quantityOfProductBooked = $products->first()->totalProductPrice();

        $numberAvailableProducts = ($products[0]->quantity - $quantityOfProductBooked);


        if($request->input('quantity') > ($products[0]->quantity - $quantityOfProductBooked))
        {
            $productPrice = 0;
            $message = trans('availability.notEnoughPriceMessage1').$request->input('quantity').
                trans('availability.notEnoughPriceMessage2').$numberAvailableProducts.trans('availability.notEnoughPriceMessage3');
            $success = false;
        }
        else
        {
            $productPrice = $this->pricingUtil->getLowestPrice($request->input('productId'),
                $request->input('startDateTime'),
                $request->input('endDateTime'));
            $message = trans('booking/index.priceIs').($productPrice* $request->input('quantity')).
                trans('booking/index.currency');

            $success = true;
        }
        //echo $productPrice * $request->input('quantity');
       /* return view('index')->with([
                "navPage" => "home"
            ]
        );*/
        return $this->respond([
            'data' => [
                'price' => $productPrice * $request->input('quantity')/*,
                'singlePrice' => $productPrice,
                'quantity' => $request->input('quantity'),
                'duration' => $request->input('duration')*/
            ],
            "message" => $message,
            "success" => $success,
            'quantityAvailabile' => $numberAvailableProducts,
            "quantityOfProductBooked" => $quantityOfProductBooked
        ]);
    }
}
