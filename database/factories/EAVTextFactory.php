<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\EAVText;
use Faker\Generator as Faker;

$factory->define(EAVText::class, function (Faker $faker) {
    return [
        'value' => $faker->paragraph,
    ];
});
