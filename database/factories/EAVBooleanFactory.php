<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\EAVBoolean;
use Faker\Generator as Faker;

$factory->define(EAVBoolean::class, function (Faker $faker) {
    return [
        'value' => 1,
    ];
});
