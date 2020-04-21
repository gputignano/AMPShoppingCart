<?php

namespace App\Models;

use App\Contracts\Entity;
use Illuminate\Database\Eloquent\Builder;

class Page extends Entity
{
    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function rewrite()
    {
        return $this->morphOne(Rewrite::class, 'rewritable');
    }

    public function eavs()
    {
        return $this->morphMany(EAV::class, 'entity');
    }

    protected static function booted()
    {
        parent::booted();

        static::creating(function ($entity) {
            $entity->forceFill([
                'type' => 'page',
            ]);
        });

        static::deleting(function ($entity) {
            $entity->children()->delete();
            $entity->eavs()->delete();
            $entity->rewrite()->delete();
        });

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'page');
        });
    }
}
