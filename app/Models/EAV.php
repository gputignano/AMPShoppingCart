<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EAV extends Model
{
    public $table = 'eavs';

    protected $fillable = [
        'entity_type', 'entity_id', 'attribute_id', 'value_type', 'value_id',
    ];

    public $timestamps = false;

    public function entity()
    {
        return $this->belongsTo(
            Entity::class,
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

            $eav->value->delete();
        });
    }
}
