<?php

namespace App\Models;

use App\Contracts\Entity;
use Illuminate\Database\Eloquent\Builder;

class Page extends Entity
{
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
