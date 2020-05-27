<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Attributable;
use App\Models\Attribute;
use App\Models\Entity;
use Faker\Generator as Faker;

$factory->define(Attributable::class, function (Faker $faker) {
    $entity = factory(Entity::class)->create();

    $attribute = factory(Attribute::class)->create();

    $value = factory($attribute->type)->create();

    return [
        'attributable_id' => $entity->id,

        'attribute_id' => $attribute,

        'value_type' => get_class($value),
        'value_id' => $value->id,
    ];
});
