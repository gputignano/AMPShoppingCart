<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\EAVBoolean;
use Faker\Generator as Faker;

$factory->define(EAVBoolean::class, function (Faker $faker) {
    return [
        'value' => $faker->boolean(50),
    ];
});
