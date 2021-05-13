<?php

namespace App\Http\Controllers;

use App\BokaKanot\Repositories\CategoryRepository;
use App\Tagword;
use App\Http\Requests\CategoryRequest;
use App\User;
use Illuminate\Http\Request;
use App\CenterUser;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Product;


class TagwordsController extends Controller
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
       
        $centreId = Auth::user()->centres()->first()->id;
        $centrePrimaryCategories = $categoryRepository->getPrimaryWithChildren($centreId);


        $resourceType = 'tagwords';
        $categories = $this->createCategoryDropDownArray(Auth::user()->centres()->first()->categories()->get());
        new Tagword;
        $tagwords = Tagword::select('*')->where('centre_id', $centreId)->get();

        new CenterUser;
        $user_tyep = CenterUser::select('*')->where('user_id', Auth::user()->id)->get();
        $usertype =  $user_tyep[0]->user_type_id;
        return view('admin.resources.tagwords')->with([
                "navPage" => $this->navPage,
                "userCentreCategories" => $centrePrimaryCategories,
                "resourceType" => $resourceType,
                'tagwords' => $tagwords,
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
        $user_tyep = CenterUser::select('*')->where('user_id', Auth::user()->id)->get();
        $usertype =  $user_tyep[0]->user_type_id;

        return view('admin.resources.tagwords.create')->with([
                "navPage" => $this->navPage,
                "resourceType" => 'tagwords',
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

        $tagwords = new Tagword($request->all());

        Auth::user()->centres()->first()->categories()->save($tagwords);

        if($request->has('firstCategory'))
        {
            return redirect('admin/resources/tagwords/create');
        }
        
        return redirect('admin/resources/tagwords');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Tagword::findOrFail($id);
        $category->parentCategory = $category->parent_category_id;
        //dd( $category->parentCategory);
        $categories = $this->createCategoryDropDownArray(Auth::user()->centres()->first()->categories()->get(), $category->id);
        
                new CenterUser;
                $user_tyep = CenterUser::find(Auth::user()->id);
                
                $usertype =  $user_tyep->user_type_id;

        return view('admin.resources.tagwords.edit')->with([
                "adminPage" => "resources",
                "navPage" => $this->navPage,
                "resourceType" => 'tagwords',
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

        $category = Tagword::findOrFail($id);

        $category->update($request->except('image'));

        return redirect('admin/resources/tagwords');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    //   // $count = Product::where('category_id' , $id)->get();
    //     if(count($count) > 0){
    //         return back()->with('error',trans('admin/resources/categoryForm.CantDeleteCatagory'));
    //     }
        new Tagword;
        $tagword = Tagword::findOrFail($id);
        $tagword->delete();

        return redirect('admin/resources/tagwords');
    }
}
