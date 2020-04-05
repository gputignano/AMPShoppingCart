<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'parent_id' => 0,
        'name' => $faker->name,
        'type' => 'product',
    ];
});
