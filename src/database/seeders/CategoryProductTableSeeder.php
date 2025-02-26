<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategoryProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::all()->each(function ($product){
            $categories = Category::inRandomOrder()->limit(rand(1,3))->pluck('id');
            $product->categories()->attach($categories);
        });
    }
}
