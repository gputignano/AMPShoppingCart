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

        // SEEDS PRODUCT_TYPE ATTRIBUTES
        $attribute = factory(App\Models\Attribute::class)->create([
            'label' => $label = 'Product Type',
            'code' => Str::snake($label),
            'type' => App\Models\EAVString::class,
            'is_system' => true,
        ]);

        // SEEDS ATTRIBUTE_VARIANT ATTRIBUTES
        $attribute_variant = factory(App\Models\Attribute::class)->create([
            'label' => $label = 'Attribute Variant',
            'code' => Str::snake($label),
            'type' => App\Models\EAVString::class,
            'is_system' => true,
        ]);

        // SEEDS PRODUCT TYPE ATTRIBUTES
        $attribute->values()->saveMany([
            $attribute->type::create(['value' => 'simple']),
            $attribute->type::create(['value' => 'configurable']),
        ]);
    }
}
