<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'product_id',
        'category_id'
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    //  belongs to child category
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
