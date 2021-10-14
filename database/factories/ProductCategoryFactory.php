<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // product id from product class as random
            'product_id' => $this->faker->randomElement(Product::pluck('id')->toArray()),

            // category id from random from 4 to 15
            'category_id' => $this->faker->numberBetween(4, 15),
        ];
    }
}
