<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // name of the product
            'name' => $this->faker->word,
            // title of the product
            'title' => $this->faker->sentence,
            // description of the product
            'description' => $this->faker->paragraph,
            // price of the product from 100 to 1000
            'price' => $this->faker->numberBetween(100, 1000),
            // stock of the product random digits
            'stock' => $this->faker->randomDigit,
            // discount of the product not more than 30%
            'discount' => $this->faker->numberBetween(0, 30),
            // image of the product
            'image' => $this->faker->imageUrl(400, 400, 'technics'),
        ];
    }
}
