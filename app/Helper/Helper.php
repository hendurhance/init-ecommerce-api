<?php

namespace App\Helper;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Category;

class Helper
{

    /**
     * Get all categories linked to a product
     *
     * @return array
     */

    public static function getCategory($arr)
    {
        $category = [];
        foreach ($arr as $key => $value) {
            $category[] = $value->pivot->category_id;
        }
        return $category;
    }
    
}