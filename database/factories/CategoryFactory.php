<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // actual category name
            'name' => $this->faker->word,
            // category slug
            'slug' => $this->faker->slug,
            // category id some have null value
            'parent_id' => null,
            // image url
            'image' => $this->faker->imageUrl(),
        ];
    }
}
