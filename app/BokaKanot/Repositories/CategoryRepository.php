<?php namespace App\BokaKanot\Repositories;

use App\Category;
use DB;
use Illuminate\Console\Scheduling\CallbackEvent;

class CategoryRepository
{
    public function getPrimaryWithChildren($centreId)
    {
        return Category::where('centre_id', $centreId)
            ->whereNull('parent_category_id')
            ->with('childCategories')
            ->get();
    }

    public function getSubCategories($categories)
    {

        $primaryCategoryString = "";
        $primaryCategoryString2 = "";

        foreach($categories as $category)
        {
            $primaryCategoryString .= "'".$category->id."',";
            $primaryCategoryString2 .= $category->id.",";
        }

        $primaryCategoryString = rtrim($primaryCategoryString, ',');

        if ($primaryCategoryString == "")
            return [];

        $query = "SELECT * FROM `categories` WHERE parent_category_id in ($primaryCategoryString) and deleted_at is null";

        $results = DB::select($query);

        return $results;
    }

   /* public function getCategories ($parentCategoryId)
    {
        $query = "SELECT * FROM `categories` WHERE parent_category_id = :parentCategoryId";

         $results = DB::select($query, array('parentCategoryId' => $parentCategoryId));

        return $results;
    }*/

    public function getPrimaryCategories ($centreId)
    {
        $adminFeeCategoryId = $this->getFeeCategory($centreId);
        $query = "SELECT * FROM `categories` WHERE parent_category_id is null and deleted_at is null and centre_id = :centreId and id <> :adminFeeCategoryId";
        $results = DB::select($query, ['centreId'=> $centreId, 'adminFeeCategoryId' => $adminFeeCategoryId]);
        return $results;
    }

    public function getFeeCategory($centreId)
    {
        $feeCategory = Category::where('is_admin_category', 1)
        ->where('centre_id', $centreId)->get();
        $count=$feeCategory->count();
       
        if($count >0 )
        {
            return $count ->id;
        }
        else
        {
            return 0;
        }
    }
    public function createFeeCategory($centreId)
    {
        $category = new Category()      ;
        $category->name = "Fees";
        $category->description = "This is an auto-generated category used to house the Admin Fee product";
        $category->centre_id = $centreId;
        $category->is_admin_category = 1;
        $category->save();
        return $category->id;
    }
}