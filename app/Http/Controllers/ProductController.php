<?php

namespace App\Http\Controllers;

use App\BokaKanot\PricingUtil;
use App\BokaKanot\Repositories\BookingRepository;
use App\BokaKanot\Transformers\ProductBookingTransformer;
use App\Booking;
use App\Tagword;
use App\Category;
use App\Http\Requests\ProductRequest;
use App\Price;
use App\CenterUser;
use App\Product;
use App\Product_Images;
use App\BokaKanot\Repositories\ProductRepository;
use App\Http\Requests;
use App\BokaKanot\Transformers\ProductTransformer;

//use Illuminate\Http\Request;
use Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends ApiController
{
    private $navPage;
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
        $this->middleware('auth');
        $this->productTransformer = $productTransformer;
        $this->pricingUtil = $pricingUtil;
        $this->productRepository = $productRepository;
    }

    public function testProductId()
    {
        dd(Booking::where("id", 254)->first()->getProductIdentifier(440));
        dd(Booking::find(254)->getProductIdentifier(440));
    }

    public function getPrice($id, $startDateTime, $endDateTime, $quantity){

        
        $productRepo = new ProductRepository();

        $pricingUtil = new PricingUtil($productRepo);

        $price = $pricingUtil->getPrice($id, $startDateTime, $endDateTime, $quantity);

       dd($price);


        //dd($pricingUtil->getPrice($id));
        //return view('home')->with(['navPage' => ""]);
        return $id;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductRepository $productRepository)
    {
        $products = Auth::user()->centres()->first()->products()->get();

        $priceTypes = Price::all();

        $resourceType = 'products';
        $categories = Auth::user()->centres()->first()->categories()->get();
        $categoryList = $categories = $categories->lists('name', 'id');
        $startTimes = $productRepository->getStartTimes();
        $productPerTypes = $productRepository->getAllPerTypes();
        $productPerTypeTimes = $productRepository->getAllPerTypeTimes();

            new CenterUser;
        $user_tyep = CenterUser::select('*')->where('user_id', Auth::user()->id)->get();
        $usertype =  $user_tyep[0]->user_type_id;
        return view('admin.resources.products')->with([
                "navPage" => "resources",
                "userCentreProducts" => $products,
                "resourceType" => $resourceType,
                "priceTypes" => $priceTypes,
                "categoryList" => $categoryList,
                "startTimes" => $startTimes,
                "productPerTypes" => $productPerTypes,
                "productPerTypeTimes" => $productPerTypeTimes,
                "user_type" => $usertype
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProductRepository $productRepository)
    {
        
       
        $categories = Auth::user()->centres()->first()->categories()->get();
        $categoryList = $categories = $categories->lists('name', 'id');
        $startTimes = $productRepository->getStartTimes();
        $productPerTypes = $productRepository->getAllPerTypes();
        $productPerTypeTimes = $productRepository->getAllPerTypeTimes();

          new CenterUser;
        $user_tyep = CenterUser::select('*')->where('user_id', Auth::user()->id)->get();
        $usertype =  $user_tyep[0]->user_type_id;

          //fectch the tag options over here baseed on center id
        new Tagword;
        $cntid = $user_tyep[0]->centre_id;
        $tagword = Tagword::select('description')->where('centre_id', $cntid)->get();
        $explode = $tagword[0]->description;
        $explodee = $tagword[1]->description;
        
        $string = preg_replace('/\.$/', '', $explode); 
        $stringg = preg_replace('/\.$/', '', $explodee); 
        
        $array = explode(', ', $string); 
        $arrayy = explode(', ', $stringg); 
        
        return view('admin.resources.products.create')->with([
                "navPage" => "resources",
                "resourceType" => 'products',
                "categoryList" => $categoryList,
                "startTimes" => $startTimes,
                "productPerTypes" => $productPerTypes,
                "productPerTypeTimes" => $productPerTypeTimes,
                "user_type" => $usertype, 
                "array" => $array,
                "arrayy" => $arrayy,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, ProductRepository $productRepository)
    {
        if(!$this->validateTimeProductPrices($request))
        {
            return redirect()->back()->withErrors(['Price' => "Please enter at least one price"]);
        }

        //dd($request->getValidatorInstance());
        /*$v = Validator::make($data
        $v->sometimes('reason', 'required|max:500', function($input)
        {
            return $input->games >= 100;
        });*/
      $product = new Product($request->all());
         $color_tag = implode(",",$request->tag_color); 
         $product->tag_color = $color_tag; 
          $product->tag_size = implode(",",$request->tag_color); 
        $product = $this->uploadImage($product, $request);
        $category = Category::with('products')->find($product->category_id);
        $category->products()->save($product);
        $productId = DB::getPdo()->lastInsertId();
        $LastInsertedProduct = Product::find($productId);

        if($request->has('per_type_id') AND $request->get('per_type_id') == 1) {
            $LastInsertedProduct->prices()->attach(1, ['price' => ($request->pricePerHour == "") ? 0 : $request->pricePerHour]);
            $LastInsertedProduct->prices()->attach(2, ['price' => ($request->pricePerHourWeekend == "") ? 0 : $request->pricePerHourWeekend]);
            $LastInsertedProduct->prices()->attach(3, ['price' => ($request->pricePerDay == "") ? 0 : $request->pricePerDay]);
            $LastInsertedProduct->prices()->attach(4, ['price' => ($request->pricePerDayWeekend == "") ? 0 : $request->pricePerDayWeekend]);

            $LastInsertedProduct->prices()->attach(10, ['price' => ($request->pricePerHourOverFourWeekend == "") ? 0 : $request->pricePerHourOverFourWeekend]);
            $LastInsertedProduct->prices()->attach(11, ['price' => ($request->pricePerThreeSixDays == "") ? 0 : $request->pricePerThreeSixDays]);
            $LastInsertedProduct->prices()->attach(12, ['price' => ($request->pricePerWeekExtraDay == "") ? 0 : $request->pricePerWeekExtraDay]);
            $LastInsertedProduct->prices()->attach(13, ['price' => ($request->pricePerWeek == "") ? 0 : $request->pricePerWeek]);
            $LastInsertedProduct->prices()->attach(9, ['price' => ($request->pricePerHourOverFour == "") ? 0 : $request->pricePerHourOverFour]);
            $productRepository->insertStartTimes($productId, $productRepository->getProductStartTimes($LastInsertedProduct), $request->input('startTime'));
            $productRepository->insertPerTypeTimes($productId, $productRepository->getPerTypeTimes($LastInsertedProduct), $request->input('perTypeTime'), $request->input('perTypeTimeMax'));

        }
        else if($request->has('per_type_id') AND $request->get('per_type_id') == 2) {
            $LastInsertedProduct->prices()->attach(8, ['price' => ($request->pricePerBooking == "") ? 0 : $request->pricePerBooking]);
        }
        else if($request->has('per_type_id') AND $request->get('per_type_id') == 3) {
            $LastInsertedProduct->prices()->attach(7, ['price' => ($request->pricePerProduct == "") ? 0 : $request->pricePerProduct]);
            $productRepository->insertStartTimes($productId, $productRepository->getProductStartTimes($LastInsertedProduct), $request->input('startTime'));
        }

        if ($product->image !== null) {
            $LastInsertedProduct->product_images()->save(new Product_Images(["product_id" => DB::getPdo()->lastInsertId(), "primary_image" => true, "image" => $product->image]));
        }
        //$productRepository->insertPerTypes($productId, $productRepository->getPerTypes($LastInsertedProduct), $request->input('pertype'));

        /*dd(Auth::user()->centres()->where("user_type_id" ,true)->first()->categories()->first()->products()->save($product));
        dd(Auth::user()->centres()->where("user_type_id" ,true)->first()->products()->save($product));
        Auth::user()->centres()->where("user_type_id", true)->first()->products()->save($product);*/


        return redirect('admin/resources/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->respondNotFound('Product does not exist.');
        }
        return $this->respond([
            'data' => $this->productTransformer->transform($product)
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, ProductRepository $productRepository)
    {
        //$product = Product::with('prices')->where('id', '=', $id)->first();//->with('prices')->get()
        $product = Product::findOrFail($id);
        $product->setPricesOnProduct();

        $categories = Auth::user()->centres()->first()->categories()->get();

        $categoryList = $categories->lists('name', 'id');

        $startTimes = $productRepository->getProductStartTimes($id);
        $productPerTypes = $productRepository->getAllPerTypes();

        $productPerTypeTimes = $productRepository->getPerTypeTimes($id);
/*dd($startTimes);*/
             new CenterUser;
        $user_tyep = CenterUser::select('*')->where('user_id', Auth::user()->id)->get();
        $usertype =  $user_tyep[0]->user_type_id;

          //fectch the tag options over here baseed on center id
        new Tagword;
        $cntid = $user_tyep[0]->centre_id;
        $tagword = Tagword::select('description')->where('centre_id', $cntid)->get();
        $explode = $tagword[0]->description;
        $explodee = $tagword[1]->description;
        
        $string = preg_replace('/\.$/', '', $explode); 
        $stringg = preg_replace('/\.$/', '', $explodee); 
        
        $array = explode(', ', $string); 
        $arrayy = explode(', ', $stringg); 
        
        // to validate the product
        $check = $product->tag_color;
        $tag_colorr = preg_replace('/\.$/', '', $check); 
        $tag_color = explode(', ', $tag_colorr); 
        
        $array = explode(', ', $string); 
        $arrayy = explode(', ', $stringg); 
        return view('admin.resources.products.edit')->with([
                "navPage" => "resources",
                "resourceType" => 'products',
                "product" => $product,
                "categoryList" => $categoryList,
                "startTimes" => $startTimes,
                "productPerTypes" => $productPerTypes,
                "productPerTypeTimes" => $productPerTypeTimes,
                "user_type" => $usertype,
                "array" => $array,
                'arrayy' => $arrayy,
                'tag_color' => $tag_color,
            ]
        );
    }

    private function validateTimeProductPrices($request)
    {
        if($request->has('per_type_id') and $request->get('per_type_id') == 1)
        {

            if($request->get('pricePerHourWeekend') == 0 AND $request->get('pricePerHourOverFour') == 0
                AND $request->get('pricePerHour') == 0
                AND $request->get('pricePerHourOverFourWeekend') == 0
                AND $request->get('pricePerDay') == 0
                AND $request->get('pricePerDayWeekend') == 0
                AND $request->get('pricePerTwoDays') == 0
                AND $request->get('pricePerTwoDaysWeekend') == 0
                AND $request->get('pricePerThreeSixDays') == 0
                AND $request->get('pricePerWeek') == 0
                AND $request->get('pricePerWeekExtraDay') == 0
            )
            {
                return false;

}
        }

        return true;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, ProductRequest $request, ProductRepository $productRepository)
    {
        
        $number_of_persons = $request->number_of_persons ? $request->number_of_persons : 'no';
        if(!$this->validateTimeProductPrices($request))
        {
            return redirect()->back()->withErrors(['Price' => "Please enter at least one price"]);
        }


        $product = Product::findOrFail($id);

        $product = $this->uploadImage($product, $request);

        $category = Category::with('products')->find($product->category_id);

        $category->products()->where('id', $id)->update($request->only('category_id', 'name', 'description','name_se' ,'description_se' ,'description_de' ,'name_de', 'number_of_persons' , 'quantity', 'image', 'per_type_id'));



        //$product->prices()->where("price_id" ,1)->first()->pivot->price = $request->pricePerHour;
        //$product->prices()->where("price_id" ,1)->first()->updateExistingPivot(1, $attributes); = $request->pricePerHour;
        //dd($product->prices()->newPivotStatementForId(1)->where("price_id" ,1)->first());/*->update(['price', $request->pricePerHour]);*/
        $product->prices()->newPivotStatementForId(1)->where("price_id", 1)->update(['price' => $request->pricePerHour]);


        $productRepository->updateStartTimes($id, $productRepository->getProductStartTimes($id), $request->input('startTime'));

        if($request->has('per_type_id') AND $request->input('per_type_id') == 1)
        {
            $productRepository->updatePerTypeTimes($id, $productRepository->getPerTypeTimes($id), $request->input('perTypeTime'), $request->input('perTypeTimeMax'));
        }

        $productRepository->updatePrices($id, $productRepository->getPrices($id), $request);

        if(!$product->hasPrimaryImage())
        {
            $primary = true;
        }
        else
        {
            $primary = false;
        }
        $product->product_images()->save(new Product_Images(["product_id" => DB::getPdo()->lastInsertId(), "primary_image" => $primary, "image" => $product->image]));


        return redirect('admin/resources/products');
    }
    /*public function update($id, ProductRequest $request) {

    }*/
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect('admin/resources/products');
    }

    public function uploadImage(Product $product, ProductRequest $request)
    {
        if ($request->hasFile('image')) {

            if ($request->file('image')->isValid()) {

                $fileName = $product->name. "_". uniqid().".".$request->file('image')->getClientOriginalExtension();

                $request->file('image')->move("images/products", $fileName);

                $product->image = $fileName;
            }
        }

        return $product;
    }

    public function getBookingProducts(BookingRepository $bookingRepository, ProductBookingTransformer $productBookingTransformer)
    {
        $reportsData = $bookingRepository->getBookingProducts();

        $productBookingData = $productBookingTransformer->transform($reportsData);

        return $this->respond([
            'data' => $productBookingData
        ]);

    }

    public function deleteImage(Request $request)
    {
        if($request->has('productImageId') && $request->has('productId'))
        {
            $this->productRepository->deleteProductImage($request->get('productId'), $request->get('productImageId'));
        }
    }

    public function makeImagePrimary(Request $request)
    {
        if($request->has('productImageId'))
        {
            $this->productRepository->makeProductImagePrimary($request->get('productId'), $request->get('productImageId'));
        }
    }
}

/* rough eloquent:
 //$userCentreProducts = Auth::user()->centres()->where("user_type_id" ,true)->first()->products()->get();->prices()->get()
        //$userCentreProducts = Auth::user()->with('centres', 'products', 'prices')->get();
        //$userCentreProducts = Auth::user()->centres()->where("user_type_id" ,true)->first()->products()->get();

//        /$priceHeadings = $centres[0]->products->first()->prices();

       // echo ($products->first()->prices()->first());
        /*dd ($centres[0]->products->first()->prices()->first());*/
/*dd($products);*/
//dd($products->first()->prices());
/*$products = \App\Product::with('prices')->get();
dd($products);

//Auth::user()->centres()->where("user_type_id" ,true)->get()->categories()->first() - fails
        //Auth::user()->centres()->where("user_type_id" ,true)->first()->categories()->first() - works
        //dd(Auth::user()->centres()->where("user_type_id" ,true)->first()->categories()->first()); - works
*/
