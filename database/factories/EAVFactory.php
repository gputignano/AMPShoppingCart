<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attribute;
use App\EAV;
use App\Product;
use Faker\Generator as Faker;

$factory->define(EAV::class, function (Faker $faker) {
    $valuable = factory($valuable_type = $faker->randomElement(['App\EAVString']))->create();
    return [
        'attribute_id' => factory(Attribute::class)->create()->id,
        'product_id' => factory(Product::class)->create()->id,
        'valuable_type' => $valuable_type,
        'valuable_id' => $valuable->id,
    ];
});
