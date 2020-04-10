<?php

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'id' => 1,
            'parent_id' => 0,
            'name' => 'Aglianico del Vulture',
            'type' => 'product',
        ]);

        Product::create([
            'id' => 2,
            'parent_id' => 1,
            'name' => 'Aglianico del Vulture 2',
            'type' => 'product',
        ]);

        Product::create([
            'id' => 3,
            'parent_id' => 1,
            'name' => 'Aglianico del Vulture 3',
            'type' => 'product',
        ]);

        Product::create([
            'id' => 4,
            'parent_id' => 0,
            'name' => 'Olio Extravergine di Oliva Coratina',
            'type' => 'product',
        ]);

        Product::create([
            'id' => 5,
            'parent_id' => 0,
            'name' => 'Paccheri Artigianali De Cecco',
            'type' => 'product',
        ]);
    }
}
