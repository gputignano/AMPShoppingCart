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
        // SEEDS ATTRIBUTE SETS
        factory(App\Models\AttributeSet::class)->create(['label' => App\Models\BaseEntity::class,]);
        factory(App\Models\AttributeSet::class)->create(['label' => App\Models\Category::class, 'parent_id' => 1],);
        factory(App\Models\AttributeSet::class)->create(['label' => App\Models\Page::class, 'parent_id' => 1],);
        factory(App\Models\AttributeSet::class)->create(['label' => App\Models\Product::class, 'parent_id' => 1,]);

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

        // SEEDS PRICE ATTRIBUTE
        $price = factory(App\Models\Attribute::class)->create([
            'label' => $label = 'Price',
            'code' => Str::snake($label),
            'type' => App\Models\EAVDecimal::class,
            'is_system' => false,
        ]);

        $price->attribute_sets()->attach(1);

        // SEEDS QUANTITY ATTRIBUTE
        $quantity = factory(App\Models\Attribute::class)->create([
            'label' => $label = 'Quantity',
            'code' => Str::snake($label),
            'type' => App\Models\EAVInteger::class,
            'is_system' => false,
        ]);

        $quantity->attribute_sets()->attach(1);
    }
}
