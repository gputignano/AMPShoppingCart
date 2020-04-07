<?php

use App\Attribute;
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
            'type' => \App\EAVString::class,
        ]);

        Attribute::create([
            'id' => 2,
            'label' => 'Price',
            'type' => \App\EAVDecimal::class,
        ]);

        Attribute::create([
            'id' => 3,
            'label' => 'Quantity',
            'type' => \App\EAVInteger::class,
        ]);

        Attribute::create([
            'id' => 4,
            'label' => 'Manufacturer',
            'type' => \App\EAVString::class,
        ]);

        Attribute::create([
            'id' => 5,
            'label' => 'Year',
            'type' => \App\EAVString::class,
        ]);

        Attribute::create([
            'id' => 6,
            'label' => 'Cultivar',
            'type' => \App\EAVString::class,
        ]);

        Attribute::create([
            'id' => 7,
            'label' => 'Cooking Time',
            'type' => \App\EAVString::class,
        ]);

        Attribute::create([
            'id' => 8,
            'label' => 'Active',
            'type' => \App\EAVBoolean::class,
        ]);
    }
}
