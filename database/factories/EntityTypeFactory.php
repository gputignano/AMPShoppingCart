<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\EntityType;
use Faker\Generator as Faker;

$factory->define(EntityType::class, function (Faker $faker) {
    return [
        'label' => $faker->randomElement([
            'App\Models\Category',
            'App\Models\Page',
            'App\Models\Product',
        ])
    ];
});
