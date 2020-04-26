<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'parent_id' => null,
        'name' => $faker->sentence,
        'type' => Product::class,
    ];
});
