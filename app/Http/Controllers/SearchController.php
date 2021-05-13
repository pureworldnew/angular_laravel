<?php

namespace App\Http\Controllers;

use App\BokaKanot\Repositories\BookingRepository;
use App\BokaKanot\Repositories\SearchRepository;
use App\BokaKanot\Transformers\ProductTransformer;
use App\BokaKanot\Transformers\SearchResultTransformer;
use App\BokaKanot\Repositories\ProductRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SearchController extends ApiController
{
    /**
     * @var SearchResultTransformer
     */
    private $searchResultTransformer;
    private $productRepository;

    /**
     * @var ProductTransformer
     */
    public function __construct(SearchResultTransformer $searchResultTransformer, ProductRepository $productRepository)
    {
        $this->searchResultTransformer = $searchResultTransformer;
        $this->productRepository = $productRepository;
    }

    public function index(Request $request, SearchRepository $searchRepository) {


        if (null !== $request->get('quantity') AND
            null !== $request->get('primaryCategoryId') AND
            null !== $request->get('childCategoryId') AND
            null !== $request->get('startDate'))
        {

            $products = $searchRepository->search($request->get('primaryCategoryId'), $request->get('childCategoryId'), $request->get('quantity'), $request->get('startDate'), $request->get('endDate'));
            
            foreach ($products as $key => $value) {
                $getDate = explode(' ', $request->get('startDate'));
                $makeDate = $getDate[0].' '.$value->start_times[0]->start_time.':01';
                $availableproducts = $this->productRepository->getAvailability($value->id, $makeDate, $makeDate);
                //$products = $this->productRepository->getAvailability($request->input('productId'), '2020-03-25 0:0:0', '2020-03-25 0:0:0');
                //dd($products);
                $quantityOfProductBooked = $availableproducts->first()->totalProductPrice();
                $numberAvailableProducts = ($products[$key]->quantity - $quantityOfProductBooked);
                $products[$key]->availableProduct = $numberAvailableProducts;
            }   
            //dd($products[0]->totalProductPrice());
            //$quantityOfProductBooked = $products->first()->totalProductPrice();
            //dd($products[0]->original_quantity);
            $searchResults = $this->searchResultTransformer->transform($products);

            return $this->respond([
                'data' => $products
            ]);


        }

    }

    public function pruneSearches(BookingRepository $bookingRepository)
    {
        dd($bookingRepository->pruneSearchBookings());

    }

}
