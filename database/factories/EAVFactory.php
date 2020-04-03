<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Attribute;
use App\EAV;
use App\Product;
use Faker\Generator as Faker;

$factory->define(EAV::class, function (Faker $faker) {
    $entitable = factory(Product::class)->create();
    $attribute = factory(Attribute::class)->create();
    $valuable = factory($attribute->type)->create();

    return [
        'entity_eavable_type' => Product::class,
        'entity_eavable_id' => $entitable->id,

        'attribute_id' => $attribute,

        'value_eavable_type' => $attribute->type,
        'value_eavable_id' => $valuable->id,
    ];
});
