<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\OrderDetail;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'order_id' => factory(Order::class)->create()->id,
        'code' => Str::random(5),
        'name' => $faker->name,
        'price' => $faker->randomFloat(null, 10, 4),
        'quantity' => $faker->numberBetween(1, 10),
    ];
});
