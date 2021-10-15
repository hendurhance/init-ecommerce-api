<?php

namespace App\Http\Controllers;

use App\Exceptions\CategoryNotParent;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    // get parent categories

    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    public function getCategory($id)
    {
        return new CategoryResource(Category::find($id));
    }

    public function getParentCategories()
    {
        return CategoryResource::collection(Category::where('parent_id', null)->get());
    }

    public function getSubCategories($id)
    {
        //  check id is a parent category if not return error
        if(Category::find($id)->parent_id == null)
        {
            return CategoryResource::collection(Category::where('parent_id', $id)->get());
        }
        else
        {
            throw new CategoryNotParent;
        }
    }

    public function getSubCategoriesIndex(Category $category, $id)
    {
        // check if id parent category is same as category id
        // check if id is equal to category childen ids
        if(in_array($id, $category->children->pluck('id')->toArray()))
        {
            return new CategoryResource(Category::find($id));
        }
        else
        {
            throw new CategoryNotParent;
        }
    }
}
