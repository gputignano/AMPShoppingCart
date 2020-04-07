<?php

use App\Attribute;
use Illuminate\Database\Seeder;

class AttributablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attribute::find(4)->attributables()->createMany([ // Manufacturer
            ['value' => 'Elena Fucci'],
            ['value' => 'Feudi di San Gregorio'],
            ['value' => 'Vietti'],
            ['value' => 'Allegrini'],
            ['value' => 'Cusumano'],
        ]);

        Attribute::find(5)->attributables()->createMany([ // Year
            ['value' => '2015'],
            ['value' => '2016'],
            ['value' => '2017'],
            ['value' => '2018'],
            ['value' => '2019'],
            ['value' => '2020'],
        ]);

        Attribute::find(6)->attributables()->createMany([ // Cultivar
            ['value' => 'Coratine'],
            ['value' => 'Moraiolo'],
            ['value' => 'Bosana'],
            ['value' => 'Biancolelle'],
        ]);

        Attribute::find(7)->attributables()->createMany([
            ['value' => '5 minutes'],
            ['value' => '10 minutes'],
            ['value' => '15 minutes'],
            ['value' => '20 minutes'],
            ['value' => '25 minutes'],
        ]);

        Attribute::find(8)->attributables()->createMany([ // Active
            ['value' => false],
            ['value' => true],
        ]);
    }
}
