<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Log;

class EAV extends Pivot
{
    public $table = 'eavs';

    protected $fillable = [
        'entity_id', 'attribute_id', 'value_type', 'value_id',
    ];

    public $timestamps = false;

    public function entity()
    {
        return $this->belongsTo(
            BaseEntity::class,
            'entity_id',
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

    protected static function booted()
    {
        parent::booted();

        static::deleting(function ($eav) {
            if ($eav->attribute->type::$hasDefaultValues) return;

            // TO DO: Removing values related to EAV
            // EAV::where('entity_id', $eav->entity_id)->where('attribute_id', $eav->attribute_id)->first()->delete();
        });
    }
}
