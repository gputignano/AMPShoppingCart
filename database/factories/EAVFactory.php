<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attribute;
use App\Category;
use App\EAV;
use App\Page;
use App\Product;
use Faker\Generator as Faker;

$factory->define(EAV::class, function (Faker $faker) {
    $entitable = factory($faker->randomElement([
        Category::class,
        Product::class,
        Page::class,
    ]))->create();

    $attribute = factory(Attribute::class)->create();

    $valuable = factory($attribute->type)->create();

    return [
        'entity_eavable_type' => get_class($entitable),
        'entity_eavable_id' => $entitable->id,

        'attribute_id' => $attribute,

        'value_eavable_type' => get_class($valuable),
        'value_eavable_id' => $valuable->id,
    ];
});
