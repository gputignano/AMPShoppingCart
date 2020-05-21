<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\EAVSelect;
use Faker\Generator as Faker;

$factory->define(EAVSelect::class, function (Faker $faker) {
    return [
        'value' => $faker->word,
    ];
});
