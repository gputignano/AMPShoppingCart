<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attribute;
use App\AttributeProduct;
use App\Product;
use Faker\Generator as Faker;

$factory->define(AttributeProduct::class, function (Faker $faker) {
    return [
        'attribute_id' => factory(Attribute::class)->create()->id,
        'product_id' => factory(Product::class)->create()->id,
        'valuable_type' => $faker->word,
        'valuable_id' => $faker->numberBetween(1, 100),
    ];
});
