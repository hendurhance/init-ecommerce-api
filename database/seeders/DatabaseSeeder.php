<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // create 5 users
        \App\Models\User::factory(5)->create();
        // create 15 categories
        \App\Models\Category::factory(15)->create();
        // create 50 products
        \App\Models\Product::factory(50)->create();
        // create 250 products_categories
        \App\Models\ProductCategory::factory(250)->create();
        // create 200 reviews
        \App\Models\Review::factory(200)->create();
    }
}
