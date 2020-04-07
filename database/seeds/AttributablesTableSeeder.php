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
        Attribute::find(8)->attributables()->create([
            'value' => false,
        ]);

        Attribute::find(8)->attributables()->create([
            'value' => true,
        ]);
    }
}
