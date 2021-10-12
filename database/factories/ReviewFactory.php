<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // product_id from Product class as random()
            'product_id' => function () {
                return Product::all()->random();
            },
            // name of customer
            'customer' => $this->faker->name,
            // review of customer on product
            'review' => $this->faker->text,
            // rating of customer on product
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
