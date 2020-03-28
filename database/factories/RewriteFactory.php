<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rewrite;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Rewrite::class, function (Faker $faker) {
    return [
        'slug' => Str::slug($title = $faker->sentence),
        'title' => $title,
        'description' => $faker->sentence,
        'template' => $faker->word,
        'rewritable_type' => $faker->word,
        'rewritable_id' => $faker->numberBetween(1, 100),
    ];
});
