<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'label', 'code', 'type',
    ];

    public $timestamps = false;

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'eavs',
            'attribute_id',
            'entity_id',
            'id',
            'id',
            'products',
        )->withPivot([
            'value_type',
            'value_id',
        ])->using(EAV::class);
    }

    public function eavs()
    {
        return $this->hasMany(
            EAV::class,
            'attribute_id',
            'id',
        );
    }

    public function entity_types()
    {
        return $this->belongsToMany(
            EntityType::class,
            'attribute_entity_type',
            'attribute_id',
            'entity_type_id',
            'id',
            'id',
            'entity_types',
        );
    }

    public function values()
    {
        return $this->morphedByMany(
            $this->type,
            'value',
            'attribute_value',
            'attribute_id',
            'value_id',
            'id',
            'id',
        );
    }
}
