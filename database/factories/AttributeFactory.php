<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Attribute;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Attribute::class, function (Faker $faker) {
    return [
        'label' => $label = $faker->unique()->word,
        'code' => Str::snake($label),
        'type' => $faker->randomElement([
            \App\Models\EAVBoolean::class,
            \App\Models\EAVDecimal::class,
            \App\Models\EAVInteger::class,
            \App\Models\EAVString::class,
            \App\Models\EAVText::class,
        ]),
    ];
});
