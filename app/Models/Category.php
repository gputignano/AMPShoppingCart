<?php

namespace App\Models;

use App\Contracts\Entity;
use Illuminate\Database\Eloquent\Builder;

class Category extends Entity
{
    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function eavs()
    {
        return $this->morphMany(EAV::class, 'entity');
    }

    public function rewrite()
    {
        return $this->morphOne(Rewrite::class, 'rewritable');
    }

    protected static function booted()
    {
        parent::booted();

        static::creating(function ($entity) {
            $entity->forceFill([
                'type' => 'category',
            ]);
        });

        static::deleting(function ($entity) {
            $entity->children()->delete();
            $entity->products()->detach();
            $entity->eavs()->delete();
            $entity->rewrite()->delete();
        });

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'category');
        });
    }
}
