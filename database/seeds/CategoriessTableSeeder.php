<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'id' => 8,
            'parent_id' => 0,
            'name' => 'Wines',
            'type' => 'category',
        ]);

        Category::create([
            'id' => 9,
            'parent_id' => 0,
            'name' => 'Olive Oil',
            'type' => 'category',
        ]);

        Category::create([
            'id' => 10,
            'parent_id' => 0,
            'name' => 'Pasta',
            'type' => 'category',
        ]);
    }
}
