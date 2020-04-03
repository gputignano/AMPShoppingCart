<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EAVString;
use Faker\Generator as Faker;

$factory->define(EAVString::class, function (Faker $faker) {
    return [
        'value' => $faker->word,
    ];
});
