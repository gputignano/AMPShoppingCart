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
            'label' => 'Wine',
        ]);

        AttributeSet::create([
            'label' => 'Olive Oil',
        ]);

        AttributeSet::create([
            'label' => 'Pasta',
        ]);
    }
}
