<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\AttributeSet;
use Faker\Generator as Faker;

$factory->define(AttributeSet::class, function (Faker $faker) {
    return [
        'label' => $faker->word,
    ];
});
