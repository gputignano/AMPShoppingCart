<?php

use App\AttributeSet;
use App\Product;
use Illuminate\Database\Seeder;

class AttributeSetProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttributeSet::find(1)->products()->saveMany([
            Product::find(1),
            Product::find(2),
            Product::find(3),
        ]);

        AttributeSet::find(2)->products()->saveMany([
            Product::find(4),
        ]);

        AttributeSet::find(3)->products()->saveMany([
            Product::find(5),
        ]);
    }
}
