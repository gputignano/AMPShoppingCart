<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntityType extends Model
{
    protected $fillable = [
        'label',
    ];

    public $timestamps = false;

    public function attributes()
    {
        return $this->belongsToMany(
            Attribute::class,
            'attribute_entity_type',
            'entity_type_id',
            'attribute_id',
            'id',
            'id',
            'attributes',
        );
    }
}
