<?php

use App\Category;
use App\Page;
use App\Product;
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
            'title' => 'Aglianico del Vulture Title',
            'description' => 'Description for Aglianico del Vulture',
            'template' => 'product',
            'enabled' => false,
        ]);

        Product::find(4)->rewrite()->create([
            'id' => 2,
            'slug' => 'olio-estravergine-di-oliva-coratina.html',
            'title' => 'Olio Extravergine di Oliva Coratina Title',
            'description' => 'Description for Olio Extravergine di Oliva Coratina',
            'template' => 'product',
            'enabled' => false,
        ]);

        Product::find(5)->rewrite()->create([
            'id' => 3,
            'slug' => 'paccheri-artigianali-de-cecco.html',
            'title' => 'Paccheri Artigianali De Cecco Title',
            'description' => 'Description for Paccheri Artigianali De Cecco',
            'template' => 'product',
            'enabled' => false,
        ]);

        Page::find(6)->rewrite()->create([
            'id' => 4,
            'slug' => 'home',
            'title' => 'Home Page Title',
            'description' => 'Description for Home Page',
            'template' => 'page',
            'enabled' => false,
        ]);

        Page::find(7)->rewrite()->create([
            'id' => 5,
            'slug' => 'cotacts',
            'title' => 'Contacts Title',
            'description' => 'Description for Contacts',
            'template' => 'page',
            'enabled' => false,
        ]);

        Category::find(8)->rewrite()->create([
            'id' => 6,
            'slug' => 'wines',
            'title' => 'Wines Title',
            'description' => 'Description for Wines',
            'template' => 'category',
            'enabled' => false,
        ]);

        Category::find(9)->rewrite()->create([
            'id' => 7,
            'slug' => 'olive-oil',
            'title' => 'Olive Oil Title',
            'description' => 'Description for Olive Oil',
            'template' => 'category',
            'enabled' => false,
        ]);

        Category::find(10)->rewrite()->create([
            'id' => 8,
            'slug' => 'pasta',
            'title' => 'Pasta Title',
            'description' => 'Description for Pasta',
            'template' => 'category',
            'enabled' => false,
        ]);
    }
}
