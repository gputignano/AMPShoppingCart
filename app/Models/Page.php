<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Page extends Entity
{
    protected static function booted()
    {
        parent::booted();

        static::deleting(function ($entity) {
            // $entity->products()->detach();
        });

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', self::class);
        });
    }
}
