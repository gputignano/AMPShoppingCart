<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Rewrite;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Rewrite::class, function (Faker $faker) {
    $title = $faker->sentence;

    $rewritable = factory($faker->randomElement([
        \App\Models\Category::class,
        \App\Models\Page::class,
        \App\Models\Product::class,
    ]))->create();

    return [
        'slug' => Str::slug($title),
        'title' => $title,
        'description' => $faker->sentence,
        'template' => $faker->word,
        'rewritable_type' => get_class($rewritable),
        'rewritable_id' => $rewritable->id,
    ];
});
