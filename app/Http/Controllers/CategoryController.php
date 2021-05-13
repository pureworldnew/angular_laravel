<?php

namespace App\Http\Controllers;

use App\BokaKanot\Repositories\CategoryRepository;
use App\Category;
use App\Http\Requests\CategoryRequest;
use App\User;
use Illuminate\Http\Request;
use App\CenterUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Product;


class CategoryController extends Controller
{
    private $navPage;

    public function __construct()
    {
        $this->navPage = "resources";


        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryRepository $categoryRepository)
    {
        //dd(Auth::user()->centres()->first());
        //$centreId = Auth::user()->centres()->where("user_type_id" ,true)->first()->id;
        $centreId = Auth::user()->centres()->first()->id;
        // $centrePrimaryCategories = $categoryRepository->getPrimaryCategories($centreId);
        $centrePrimaryCategories = $categoryRepository->getPrimaryWithChildren($centreId);

      //  dd($centreId, $centrePrimaryCategories);

       /* $categoryArray = [];

        foreach($centrePrimaryCategories as $centrePrimaryCategory)
        {
            $categoryArray[]['primaryCategory'] = $centrePrimaryCategory;
            $categoryArray[] =  $categoryRepository->getSubCategoriesFromPrimary($centreId, $centrePrimaryCategory->id);
            //$centrePrimaryCategory;



            dd($categoryArray);
        }*/
        //$userCentreCategories = Auth::user()->centres()->where("user_type_id" ,true)->first()->categories()->get();

        $resourceType = 'categories';
        $categories = $this->createCategoryDropDownArray(Auth::user()->centres()->first()->categories()->get());

        //dd($centrePrimaryCategories[0]->childCategories);
                new CenterUser;
                $user_tyep = CenterUser::find(Auth::user()->id);
                
                $usertype =  $user_tyep->user_type_id;
        return view('admin.resources.categories')->with([
                "navPage" => $this->navPage,
                "userCentreCategories" => $centrePrimaryCategories,
                "resourceType" => $resourceType,
                'categories' => $categories,
                "user_type" => $usertype,
                "mmenutype" => "none",
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        //$categories = $this->createCategoryDropDownArray(Auth::user()->centres()->first()->categories()->get());
        $categories = $this->createCategoryDropDownArray(Auth::user()->getUserCategories());
        
                new CenterUser;
                $user_tyep = CenterUser::find(Auth::user()->id);
                
                $usertype =  $user_tyep->user_type_id;

        return view('admin.resources.categories.create')->with([
                "navPage" => $this->navPage,
                "resourceType" => 'categories',
                "categories" => $categories,
                "mmenutype" => "none",
                 "user_type" => $usertype,
            ]
        );
    }

    public function createCategoryDropDownArray($userCentreCategories, $categoryId = 999999999)
    {
        $categories[0]= "-";

        foreach($userCentreCategories as $category)
        {
            //dd($category);
            if ($categoryId <> $category->id)
            {
                $categories[$category->id] = $category->name;
            }
        }

        return $categories;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {

        $category = new Category($request->all());
        $category = $this->uploadImage($category, $request);

        //Auth::user()->centres()->where("user_type_id" ,true)->get()->categories()->first() - fails
        //Auth::user()->centres()->where("user_type_id" ,true)->first()->categories()->first() - works
        //dd(Auth::user()->centres()->where("user_type_id" ,true)->first()->categories()->first()); - works

        if($request->get('parentCategory') == 0)
        {
            $category->parent_category_id = null;
        }
        else
        {
            $category->parent_category_id = $request->get('parentCategory');
        }

        Auth::user()->centres()->first()->categories()->save($category);

        if($request->has('firstCategory'))
        {
            return redirect('admin/resources/products/create');
        }
        
        return redirect('admin/resources/categories');

    }

    public function uploadImage(Category $category, CategoryRequest $request)
    {
        //dd($request->file('image'));
        if ($request->hasFile('image')) {
           
            if ($request->file('image')->isValid()) {

                $fileName = $category->name. "_". uniqid().".".$request->file('image')->getClientOriginalExtension();
                $request->file('image')->move("images/categories", $fileName);
                $category->image = $fileName;

            }
        }

        return $category;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $category->parentCategory = $category->parent_category_id;
        //dd( $category->parentCategory);
        $categories = $this->createCategoryDropDownArray(Auth::user()->centres()->first()->categories()->get(), $category->id);
        
                new CenterUser;
                $user_tyep = CenterUser::find(Auth::user()->id);
                
                $usertype =  $user_tyep->user_type_id;

        return view('admin.resources.categories.edit')->with([
                "adminPage" => "resources",
                "navPage" => $this->navPage,
                "resourceType" => 'categories',
                "category" => $category,
                "categories" => $categories,
                "mmenutype" => "none",
                'user_type' => $usertype,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, CategoryRequest $request)
    {

        $category = Category::findOrFail($id);

        $category = $this->uploadImage($category, $request);

        if($request->get('parentCategory') == 0)
        {
            $category->parent_category_id = null;
        }
        else
        {
            $category->parent_category_id = $request->get('parentCategory');
        }

        $category->update($request->except('image'));

//dd($category);
        return redirect('admin/resources/categories');

        //Auth::user()->products()->save($product);





       // return redirect('products');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $count = Product::where('category_id' , $id)->get();
        if(count($count) > 0){
            return back()->with('error',trans('admin/resources/categoryForm.CantDeleteCatagory'));
        }
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('admin/resources/categories');
    }
}
