<?php

use App\AttributeSet;
use Illuminate\Database\Seeder;

class AttributeSetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttributeSet::create([
            'id' => 1,
            'label' => 'Wine',
        ]);

        AttributeSet::create([
            'id' => 2,
            'label' => 'Olive Oil',
        ]);

        AttributeSet::create([
            'id' => 3,
            'label' => 'Pasta',
        ]);
    }
}
