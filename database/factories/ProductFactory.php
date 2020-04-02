<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AttributeSet;
use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'product_id' => 0,
        'attribute_set_id' => factory(AttributeSet::class)->create()->id,
        'name' => $faker->name,
        'code' => Str::random(5),
        'price' => $faker->randomFloat(null, 10, 4),
        'quantity' => $faker->numberBetween(0, 100),
    ];
});
