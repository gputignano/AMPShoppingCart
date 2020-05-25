<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class InstallationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // SEEDS ENTITY TYPES
        factory(App\Models\EntityType::class)->create(['label' => App\Models\Category::class,]);
        factory(App\Models\EntityType::class)->create(['label' => App\Models\Page::class,]);
        factory(App\Models\EntityType::class)->create(['label' => App\Models\Product::class,]);

        // SEEDS PRODUCT_TYPE ATTRIBUTE
        $product_type = factory(App\Models\Attribute::class)->create([
            'label' => $label = 'Product Type',
            'code' => Str::snake($label),
            'type' => App\Models\EAVSelect::class,
            'is_system' => true,
        ]);

        // SEEDS PRODUCT TYPE ATTRIBUTES
        $product_type->values()->saveMany([
            $product_type->type::create(['value' => 'simple']),
            $product_type->type::create(['value' => 'configurable']),
        ]);

        App\Models\EntityType::where('label', App\Models\Product::class)->first()->attributes()->sync([
            $product_type->id,
        ]);

        // $attribute_set = factory(App\Models\Attribute::class)->create([
        //     'label' => $label = 'Attribute Set',
        //     'code' => Str::snake($label),
        //     'type' => App\Models\EAVSelect::class,
        //     'is_system' => true,
        // ]);

        // SEEDS PRICE ATTRIBUTE
        $price = factory(App\Models\Attribute::class)->create([
            'label' => $label = 'Price',
            'code' => Str::snake($label),
            'type' => App\Models\EAVDecimal::class,
            'is_system' => false,
        ]);

        // SEEDS QUANTITY ATTRIBUTE
        $quantity = factory(App\Models\Attribute::class)->create([
            'label' => $label = 'Quantity',
            'code' => Str::snake($label),
            'type' => App\Models\EAVDecimal::class,
            'is_system' => false,
        ]);

        factory(App\Models\AttributeSet::class)->create([
            'label' => 'Default',
        ]);
    }
}
