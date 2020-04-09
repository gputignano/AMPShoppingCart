<?php

use App\EAV;
use App\EAVDecimal;
use App\EAVInteger;
use App\EAVString;
use App\EAVText;
use App\Product;
use Illuminate\Database\Seeder;

class EAVsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PRODUCT 1
        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 1,
            'attribute_id' => 4,
            'value_type' => EAVString::class,
            'value_id' => EAVString::firstOrCreate([
                'value' => 'Elena Fucci',
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 1,
            'attribute_id' => 10,
            'value_type' => EAVText::class,
            'value_id' => EAVText::create([
                'value' => 'Description for Aglianico del Vulture',
            ])->id,
        ]);

        // PRODUCT 2
        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 2,
            'attribute_id' => 1,
            'value_type' => EAVString::class,
            'value_id' => EAVString::create([
                'value' => '00001',
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 2,
            'attribute_id' => 2,
            'value_type' => EAVDecimal::class,
            'value_id' => EAVDecimal::create([
                'value' => 10.5,
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 2,
            'attribute_id' => 3,
            'value_type' => EAVInteger::class,
            'value_id' => EAVInteger::create([
                'value' => 7,
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 2,
            'attribute_id' => 5,
            'value_type' => EAVString::class,
            'value_id' => EAVString::firstOrCreate([
                'value' => '2017',
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 2,
            'attribute_id' => 6,
            'value_type' => EAVString::class,
            'value_id' => EAVString::create([
                'value' => 'ml 375',
            ])->id,
        ]);

        // PRODUCT 3
        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 3,
            'attribute_id' => 1,
            'value_type' => EAVString::class,
            'value_id' => EAVString::create([
                'value' => '00002',
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 3,
            'attribute_id' => 2,
            'value_type' => EAVDecimal::class,
            'value_id' => EAVDecimal::create([
                'value' => 12.0,
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 3,
            'attribute_id' => 3,
            'value_type' => EAVInteger::class,
            'value_id' => EAVInteger::create([
                'value' => 11,
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 3,
            'attribute_id' => 5,
            'value_type' => EAVString::class,
            'value_id' => EAVString::firstOrCreate([
                'value' => '2018',
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 3,
            'attribute_id' => 6,
            'value_type' => EAVString::class,
            'value_id' => EAVString::create([
                'value' => 'ml 750',
            ])->id,
        ]);

        // PRODUCT 4
        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 4,
            'attribute_id' => 1,
            'value_type' => EAVString::class,
            'value_id' => EAVString::create([
                'value' => '00003',
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 4,
            'attribute_id' => 2,
            'value_type' => EAVDecimal::class,
            'value_id' => EAVDecimal::create([
                'value' => 30.0,
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 4,
            'attribute_id' => 3,
            'value_type' => EAVInteger::class,
            'value_id' => EAVInteger::create([
                'value' => 3,
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 4,
            'attribute_id' => 4,
            'value_type' => EAVString::class,
            'value_id' => EAVString::firstOrCreate([
                'value' => 'Oleificio De Carlo',
            ])->id,
        ]);
 
        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 4,
            'attribute_id' => 6,
            'value_type' => EAVString::class,
            'value_id' => EAVString::create([
                'value' => 'Lt 3',
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 4,
            'attribute_id' => 7,
            'value_type' => EAVString::class,
            'value_id' => EAVString::firstOrCreate([
                'value' => 'Coratina',
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 4,
            'attribute_id' => 10,
            'value_type' => EAVText::class,
            'value_id' => EAVText::create([
                'value' => 'Description for Extravirgin Olive Oil Coratina',
            ])->id,
        ]);

        // PRODUCT 5
        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 5,
            'attribute_id' => 1,
            'value_type' => EAVString::class,
            'value_id' => EAVString::create([
                'value' => '00005',
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 5,
            'attribute_id' => 2,
            'value_type' => EAVDecimal::class,
            'value_id' => EAVDecimal::create([
                'value' => 3.75,
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 5,
            'attribute_id' => 3,
            'value_type' => EAVInteger::class,
            'value_id' => EAVInteger::create([
                'value' => 150,
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 5,
            'attribute_id' => 4,
            'value_type' => EAVString::class,
            'value_id' => EAVString::firstOrCreate([
                'value' => 'De Cecco',
            ])->id,
        ]);
  
        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 5,
            'attribute_id' => 6,
            'value_type' => EAVString::class,
            'value_id' => EAVString::create([
                'value' => 'gr 500',
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 5,
            'attribute_id' => 8,
            'value_type' => EAVString::class,
            'value_id' => EAVString::firstOrCreate([
                'value' => '15 minutes',
            ])->id,
        ]);

        EAV::create([
            'entity_type' => Product::class,
            'entity_id' => 5,
            'attribute_id' => 10,
            'value_type' => EAVText::class,
            'value_id' => EAVText::create([
                'value' => 'Description for Paccheri Artigianali De Cecco',
            ])->id,
        ]);
    }
}
