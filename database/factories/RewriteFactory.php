<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BaseEntity;
use App\Models\Rewrite;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Rewrite::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'slug' => Str::slug($title),
        'meta_title' => $title,
        'meta_description' => $faker->sentence,
        'entity_id' => factory(BaseEntity::class)->create(),
    ];
});
