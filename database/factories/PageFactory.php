<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'parent_id' => 0,
        'name' => $faker->name,
        'type' => 'page',
    ];
});
