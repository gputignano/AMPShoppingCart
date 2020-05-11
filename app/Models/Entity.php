<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    public $table = 'entities';

    protected $fillable = [
        'parent_id', 'name', 'type',
    ];

    public $timestamps = false;

    public function attributes()
    {
        return $this->belongsToMany(
            Attribute::class,
            'eavs',
            'entity_id',
            'attribute_id',
            'id',
            'id',
            'attributes,'
        )->withPivot([
            'value_type',
            'value_id',
        ]);
    }

    public function parent()
    {
        return $this->belongsTo(
            $this,
            'parent_id',
            'id',
            'parent',
        );
    }

    public function children()
    {
        return $this->hasMany(
            $this,
            'parent_id',
            'id',
        );
    }

    public function eavs($attribute_id = null)
    {
        return $this->hasMany(
            EAV::class,
            'entity_id',
            'id',
        )
        ->when($attribute_id, function ($query, $attribute_id) {
            return $query->where('attribute_id', $attribute_id );
        });
    }

    public function rewrite()
    {
        return $this->hasOne(
            Rewrite::class,
            'entity_id',
            'id',
        );
    }

    protected static function booted()
    {
        parent::booted();

        static::creating(function ($entity) {
            $entity->forceFill([
                'type' => static::class,
            ]);
        });

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', static::class);
        });
    }
}
