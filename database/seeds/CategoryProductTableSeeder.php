<?php

use App\Category;
use App\Product;
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
        Category::find(8)->products()->save(
            Product::find(1),
        );

        Category::find(9)->products()->save(
            Product::find(4),
        );

        Category::find(10)->products()->save(
            Product::find(5),
        );
    }
}
