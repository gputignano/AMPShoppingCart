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
            'label' => 'Code',
            'type' => \App\EAVString::class,
        ]);

        Attribute::create([
            'label' => 'Price',
            'type' => \App\EAVDecimal::class,
        ]);

        Attribute::create([
            'label' => 'Quantity',
            'type' => \App\EAVInteger::class,
        ]);

        Attribute::create([
            'label' => 'Manufacturer',
            'type' => \App\EAVString::class,
        ]);

        Attribute::create([
            'label' => 'Year',
            'type' => \App\EAVString::class,
        ]);

        Attribute::create([
            'label' => 'Cultivar',
            'type' => \App\EAVString::class,
        ]);

        Attribute::create([
            'label' => 'Cooking Time',
            'type' => \App\EAVString::class,
        ]);
    }
}
