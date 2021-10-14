<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create 150
        \App\Models\ProductCategory::factory(150)->create();
    }
}
