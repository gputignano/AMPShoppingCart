<?php

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attribute::create([
            'id' => 1,
            'label' => 'Code',
            'type' => \App\Models\EAVString::class,
        ]);

        Attribute::create([
            'id' => 2,
            'label' => 'Price',
            'type' => \App\Models\EAVDecimal::class,
        ]);

        Attribute::create([
            'id' => 3,
            'label' => 'Quantity',
            'type' => \App\Models\EAVInteger::class,
        ]);

        Attribute::create([
            'id' => 4,
            'label' => 'Manufacturer',
            'type' => \App\Models\EAVString::class,
        ]);

        Attribute::create([
            'id' => 5,
            'label' => 'Year',
            'type' => \App\Models\EAVString::class,
        ]);

        Attribute::create([
            'id' => 6,
            'label' => 'Size',
            'type' => \App\Models\EAVString::class,
        ]);

        Attribute::create([
            'id' => 7,
            'label' => 'Cultivar',
            'type' => \App\Models\EAVString::class,
        ]);

        Attribute::create([
            'id' => 8,
            'label' => 'Cooking Time',
            'type' => \App\Models\EAVString::class,
        ]);

        Attribute::create([
            'id' => 9,
            'label' => 'Active',
            'type' => \App\Models\EAVBoolean::class,
        ]);

        Attribute::create([
            'id' => 10,
            'label' => 'Product Description',
            'type' => \App\Models\EAVText::class,
        ]);
    }
}
