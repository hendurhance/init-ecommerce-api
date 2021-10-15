<?php

namespace App\Http\Controllers;

use App\Exceptions\CategoryNotParent;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\CategoryRequest;
use App\Exceptions\ParentCategoryNotExist;
use App\Exceptions\SubCategoryNotParentsChild;
use App\Http\Requests\CategoryUpdate;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api')->except(
            [
                'index', 
                'getCategory', 
                'getCategories', 
                'getParentCategories', 
                'getSubCategories', 
                'getSubCategoriesIndex'
            ]
        );
    }

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
        if(in_array($id, $category->children->pluck('id')->toArray()))
        {
            return new CategoryResource(Category::find($id));
        }
        else
        {
            throw new CategoryNotParent;
        }
    }

    public function store(CategoryRequest $request)
    {
        // if request parent id is not null 
        if(!is_null($request->parent_id))
        {
            if(Category::find($request->parent_id))
            {
                if(Category::find($request->parent_id)->parent_id == null)
                {
                    $subCategory = Category::create($request->all());
                    return response()->json([
                        'message' => 'SubCategory created successfully', 
                        'data' => new CategoryResource($subCategory)
                    ], Response::HTTP_CREATED);
                }
                else
                {
                    throw new ParentCategoryNotExist;
                }
            }
            else
            {
                throw new ParentCategoryNotExist;
            }
        }
        else{
            $category = Category::create($request->all());
            return response()->json([
                'message' => 'Parent Category created successfully',
                'category' => new CategoryResource($category)
            ], Response::HTTP_CREATED);
        }
    }

    public function update(CategoryUpdate $request, $id)
    {
        // check if category is parent category
        if(Category::find($id)->parent_id == null)
        {
            $category = Category::find($id);
            $category->update($request->all());
            return response()->json([
                'message' => 'Category updated successfully',
                'category' => new CategoryResource($category)
            ], Response::HTTP_OK);
        }
        else
        {
            throw new CategoryNotParent;
        }
    }

    public function updateSubCategories(CategoryUpdate $request, Category $category, $id)
    {
        // check if id is a sub category of category
        if(in_array($id, $category->children->pluck('id')->toArray()))
        {
            $subCategory = Category::find($id);
            $subCategory->update($request->all());
            return response()->json([
                'message' => 'SubCategory updated successfully',
                'category' => new CategoryResource($subCategory)
            ], Response::HTTP_OK);
        }
        else
        {
            throw new SubCategoryNotParentsChild;
        }
    }
}
