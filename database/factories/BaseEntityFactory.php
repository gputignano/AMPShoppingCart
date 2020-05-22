<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BaseEntity;
use Faker\Generator as Faker;

$factory->define(BaseEntity::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'type' => BaseEntity::class,
    ];
});
