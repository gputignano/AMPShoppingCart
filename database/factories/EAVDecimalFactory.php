<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EAVDecimal;
use Faker\Generator as Faker;

$factory->define(EAVDecimal::class, function (Faker $faker) {
    return [
        'value' => $faker->randomFloat(5, 10, 100),
    ];
});
