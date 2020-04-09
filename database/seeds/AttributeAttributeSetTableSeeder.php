<?php

use App\Attribute;
use App\AttributeSet;
use Illuminate\Database\Seeder;

class AttributeAttributeSetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AttributeSet::find(1)->attributes()->attach([
            Attribute::find(1)->id,
            Attribute::find(2)->id,
            Attribute::find(3)->id,
            Attribute::find(4)->id,
            Attribute::find(5)->id,
            Attribute::find(6)->id,
            Attribute::find(9)->id,
            Attribute::find(10)->id,
        ]);

        AttributeSet::find(2)->attributes()->attach([
            Attribute::find(1)->id,
            Attribute::find(2)->id,
            Attribute::find(3)->id,
            Attribute::find(4)->id,
            Attribute::find(6)->id,
            Attribute::find(7)->id,
            Attribute::find(9)->id,
            Attribute::find(10)->id,
        ]);

        AttributeSet::find(3)->attributes()->attach([
            Attribute::find(1)->id,
            Attribute::find(2)->id,
            Attribute::find(3)->id,
            Attribute::find(4)->id,
            Attribute::find(8)->id,
            Attribute::find(9)->id,
            Attribute::find(10)->id,
        ]);
    }
}
