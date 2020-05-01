<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Attribute;
use App\Models\EAV;
use App\Models\EAVBoolean;
use App\Models\Entity;
use Faker\Generator as Faker;

$factory->define(EAV::class, function (Faker $faker) {
    $entity = factory(Entity::class)->create();

    $attribute = factory(Attribute::class)->create();

    // $value = ($attribute->type == 'App\Models\EAVBoolean') ? EAVBoolean::all()->random() : factory($attribute->type)->create();
    $value = factory($attribute->type)->create();

    return [
        'entity_id' => $entity->id,

        'attribute_id' => $attribute,

        'value_type' => get_class($value),
        'value_id' => $value->id,
    ];
});
