<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'title', 
        'description', 
        'price',
        'stock',
        'discount',
        'image'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // get all categories on the product
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_categories')->withPivot('product_id', 'category_id');
    }
}
