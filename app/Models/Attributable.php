<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Log;

class Attributable extends Pivot
{
    protected $fillable = [
        'attributable_id', 'attribute_id', 'value_type', 'value_id',
    ];

    public $timestamps = false;

    public function entity()
    {
        return $this->belongsTo(
            Entity::class,
            'attributable_id',
            'id',
            'entity',
        );
    }

    public function attribute()
    {
        return $this->belongsTo(
            Attribute::class,
            'attribute_id',
            'id',
            'attribute',
        );
    }

    public function value()
    {
        return $this->morphTo(
            'value',
            'value_type',
            'value_id',
            'id',
        );
    }

    // protected static function booted()
    // {
    //     parent::booted();

    //     static::deleting(function ($attributable) {
    //         if ($attributable->attribute->type::$hasDefaultValues) return;
    //     });
    // }
}
