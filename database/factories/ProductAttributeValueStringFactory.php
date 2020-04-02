<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attribute;
use App\ProductAttributeValueString;
use Faker\Generator as Faker;

$factory->define(ProductAttributeValueString::class, function (Faker $faker) {
    return [
        // 'attribute_id' => factory(Attribute::class)->create()->id,
        'value' => $faker->word,
    ];
});
