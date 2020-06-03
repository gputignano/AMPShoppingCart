<?php

use App\Models\Attribute;
use App\Models\AttributeSet;
use App\Models\Category;
use App\Models\EAVDecimal;
use App\Models\EAVInteger;
use App\Models\EAVSelect;
use App\Models\EAVText;
use App\Models\Product;
use App\Models\Rewrite;
use Illuminate\Database\Seeder;

class DataExampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CATEGORIES
        tap(Category::create([
            'name' => 'Wines',
            'description' => 'Description of Wines',
        ]), function ($category) {
            $category->rewrite()->save(Rewrite::create([
                'slug' => 'wines',
                'meta_title' => 'Wines Meta Title',
                'meta_description' => 'Wines Meta Description',
                'is_active' => true,
            ]));
        });

        tap(Category::create([
            'name' => 'Pasta',
            'description' => 'Description of Pasta',
        ]), function ($category) {
            $category->rewrite()->save(Rewrite::create([
                'slug' => 'pasta',
                'meta_title' => 'Pasta Meta Title',
                'meta_description' => 'Pasta Meta Description',
                'is_active' => true,
            ]));
        });

        // ATTRIBUTE SETS
        AttributeSet::create([
            'id' => 2,
            'label' => 'Wines',
        ]);

        AttributeSet::create([
            'id' => 3,
            'label' => 'Pasta',
        ]);

        // ATRIBUTES
        tap(Attribute::create([
            'label' => 'Price',
            'code' => 'price',
            'type' => EAVDecimal::class,
            'is_visible_on_front' => false,
        ]), function ($attribute) {
            $attribute->attribute_sets()->attach([
                1, 2, 3,
            ]);
        });

        tap(Attribute::create([
            'label' => 'Quantity',
            'code' => 'quantity',
            'type' => EAVInteger::class,
            'is_visible_on_front' => false,
        ]), function ($attribute) {
            $attribute->attribute_sets()->attach([
                1, 2, 3,
            ]);
        });

        tap(Attribute::create([
            'label' => 'Vintage',
            'code' => 'vintage',
            'type' => EAVSelect::class,
            'is_visible_on_front' => true,
        ]), function ($attribute) {
            $attribute->values()->attach([
                EAVSelect::create(['value' => '2015'])->id,
                EAVSelect::create(['value' => '2016'])->id,
                EAVSelect::create(['value' => '2017'])->id,
                EAVSelect::create(['value' => '2018'])->id,
                EAVSelect::create(['value' => '2019'])->id,
                EAVSelect::create(['value' => '2020'])->id,
            ]);
            $attribute->attribute_sets()->attach([
                1, 2,
            ]);
        });

        tap(Attribute::create([
            'label' => 'Size',
            'code' => 'size',
            'type' => EAVSelect::class,
            'is_visible_on_front' => true,
        ]), function ($attribute) {
            $attribute->values()->attach([
                EAVSelect::create(['value' => 'ml 375'])->id,
                EAVSelect::create(['value' => 'ml 750'])->id,
            ]);
            $attribute->attribute_sets()->attach([
                1, 2,
            ]);
        });

        tap(Attribute::create([
            'label' => 'Manufacturer',
            'code' => 'manufacturer',
            'type' => EAVSelect::class,
            'is_visible_on_front' => true,
        ]), function ($attribute) {
            $attribute->values()->attach([
                EAVSelect::create(['value' => 'Elena Fucci'])->id,
                EAVSelect::create(['value' => 'Pastificio Cocco'])->id,
                EAVSelect::create(['value' => 'Biondi Santi'])->id,
                EAVSelect::create(['value' => 'Gianfranco Fino'])->id,
                EAVSelect::create(['value' => 'Marisa Cuomo'])->id,
                EAVSelect::create(['value' => 'Vietti'])->id,
            ]);
            $attribute->attribute_sets()->attach([
                1, 2, 3,
            ]);
        });

        tap(Attribute::create([
            'label' => 'Cooking Time',
            'code' => 'cooking_time',
            'type' => EAVText::class,
            'is_visible_on_front' => true,
        ]), function ($attribute) {
            $attribute->attribute_sets()->attach([
                1, 3,
            ]);
        });

        // PRODUCTS
        tap(Product::create([
            'name' => 'Titolo Aglianico del Vulture 2018 Elena Fucci',
            'description' => 'Description of Titolo Aglianico del Vulture 2018 Elena Fucci',
        ]), function ($product) {
            $product->rewrite()->save(Rewrite::create([
                'slug' => 'titolo-aglianico-del-vulture-2018-elena-fucci',
                'meta_title' => 'Titolo Aglianico del Vulture 2018 Elena Fucci Meta Title',
                'meta_description' => 'Titolo Aglianico del Vulture 2018 Elena Fucci Meta Description',
                'is_active' => true,
            ]));
            $product->attribute_sets()->attach(2);

            $product->product_type = 1;
            $product->price = 9.99;
            $product->quantity = 3;
            $product->vintage = 6;
            $product->size = 10;
            $product->manufacturer = 11;

            $product->categories()->attach([
                2,
            ]);
        });

        tap(Product::create([
            'name' => 'Brunello di Montalcino 2015 Biondi Santi',
            'description' => 'Description of Brunello di Montalcino 2015 Biondi Santi',
        ]), function ($product) {
            $product->rewrite()->save(Rewrite::create([
                'slug' => 'brunello-di-montalcino-2015-biondi-santi',
                'meta_title' => 'Brunello di Montalcino Meta Title',
                'meta_description' => 'Brunello di Montalcino Meta Description',
                'is_active' => true,
            ]));
            $product->attribute_sets()->attach(2);

            $product->product_type = 1;
            $product->price = 52.45;
            $product->quantity = 7;
            $product->vintage = 3;
            $product->size = 10;
            $product->manufacturer = 13;

            $product->categories()->attach([
                2,
            ]);
        });

        tap(Product::create([
            'name' => 'Primitivo di Manduria Es 2019 Gianfranco Fino',
            'description' => 'Primitivo di Manduria Es 2018 Felline Gianfranco Fino',
        ]), function ($product) {
            $product->rewrite()->save(Rewrite::create([
                'slug' => 'primitivo-di-manduria-es-2019-gianfranco-fino',
                'meta_title' => 'Primitivo di Manduria Es 2019 Gianfranco Fino Meta Title',
                'meta_description' => 'Primitivo di Manduria Es 2019 Gianfranco Fino Meta Description',
                'is_active' => true,
            ]));
            $product->attribute_sets()->attach(2);

            $product->product_type = 1;
            $product->price = 15.99;
            $product->quantity = 13;
            $product->vintage = 7;
            $product->size = 10;
            $product->manufacturer = 14;

            $product->categories()->attach([
                2,
            ]);
        });

        tap(Product::create([
            'name' => 'Rigatoni Pastificio Cocco',
            'description' => 'Description of Rigatoni Pastificio Cocco',
        ]), function ($product) {
            $product->rewrite()->save(Rewrite::create([
                'slug' => 'rigatoni-pastificio-cocco',
                'meta_title' => 'Rigatoni Pastificio Cocco Meta Title',
                'meta_description' => 'Rigatoni Pastificio Cocco Meta Description',
                'is_active' => true,
            ]));
            $product->attribute_sets()->attach(3);

            $product->product_type = 1;
            $product->price = 2.11;
            $product->quantity = 157;
            $product->manufacturer = 9;
            $product->cooking_time = '4 minutes';

            $product->categories()->attach([
                3,
            ]);
        });
    }
}
