<?php

use App\Models\Category;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Database\Seeder;

class RewritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::find(1)->rewrite()->create([
            'id' => 1,
            'slug' => 'aglianico-del-vulture.html',
            'meta_title' => 'Aglianico del Vulture Title',
            'meta_description' => 'Description for Aglianico del Vulture',
            'template' => 'product',
            'enabled' => false,
        ]);

        Product::find(4)->rewrite()->create([
            'id' => 2,
            'slug' => 'olio-estravergine-di-oliva-coratina.html',
            'meta_title' => 'Olio Extravergine di Oliva Coratina Title',
            'meta_description' => 'Description for Olio Extravergine di Oliva Coratina',
            'template' => 'product',
            'enabled' => false,
        ]);

        Product::find(5)->rewrite()->create([
            'id' => 3,
            'slug' => 'paccheri-artigianali-de-cecco.html',
            'meta_title' => 'Paccheri Artigianali De Cecco Title',
            'meta_description' => 'Description for Paccheri Artigianali De Cecco',
            'template' => 'product',
            'enabled' => false,
        ]);

        Page::find(6)->rewrite()->create([
            'id' => 4,
            'slug' => 'home',
            'meta_title' => 'Home Page Title',
            'meta_description' => 'Description for Home Page',
            'template' => 'page',
            'enabled' => false,
        ]);

        Page::find(7)->rewrite()->create([
            'id' => 5,
            'slug' => 'cotacts',
            'meta_title' => 'Contacts Title',
            'meta_description' => 'Description for Contacts',
            'template' => 'page',
            'enabled' => false,
        ]);

        Category::find(8)->rewrite()->create([
            'id' => 6,
            'slug' => 'wines',
            'meta_title' => 'Wines Title',
            'meta_description' => 'Description for Wines',
            'template' => 'category',
            'enabled' => false,
        ]);

        Category::find(9)->rewrite()->create([
            'id' => 7,
            'slug' => 'olive-oil',
            'meta_title' => 'Olive Oil Title',
            'meta_description' => 'Description for Olive Oil',
            'template' => 'category',
            'enabled' => false,
        ]);

        Category::find(10)->rewrite()->create([
            'id' => 8,
            'slug' => 'pasta',
            'meta_title' => 'Pasta Title',
            'meta_description' => 'Description for Pasta',
            'template' => 'category',
            'enabled' => false,
        ]);
    }
}
