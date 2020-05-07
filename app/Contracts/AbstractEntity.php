<?php

namespace App\Contracts;

use App\Models\Attribute;
use App\Models\EAV;
use App\Models\EntityType;
use App\Models\Rewrite;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractEntity extends Model
{
    public $table = 'entities';

    protected $fillable = [
        'parent_id', 'name', 'type',
    ];

    public $timestamps = false;

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'eavs', 'entity_id', 'attribute_id');
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function eavs($attribute_id = null)
    {
        return $this->hasMany(EAV::class, 'entity_id')
        ->when($attribute_id, function ($query, $attribute_id) {
            return $query->where('attribute_id', $attribute_id );
        });
    }

    public function rewrite()
    {
        return $this->hasOne(Rewrite::class, 'entity_id');
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
