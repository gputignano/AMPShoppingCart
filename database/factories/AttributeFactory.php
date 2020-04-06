<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attribute;
use Faker\Generator as Faker;

$factory->define(Attribute::class, function (Faker $faker) {
    return [
        'label' => $faker->word,
        'type' => $faker->randomElement([
            \App\EAVBoolean::class,
            \App\EAVDecimal::class,
            \App\EAVInteger::class,
            \App\EAVString::class,
            \App\EAVText::class,
        ]),
    ];
});
