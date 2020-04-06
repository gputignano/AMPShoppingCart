<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EAVInteger;
use Faker\Generator as Faker;

$factory->define(EAVInteger::class, function (Faker $faker) {
    return [
        'value' => $faker->randomDigit,
    ];
});
