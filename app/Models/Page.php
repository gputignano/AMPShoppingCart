<?php

namespace App\Models;

use App\Contracts\AbstractEntity;
use Illuminate\Database\Eloquent\Builder;

class Page extends AbstractEntity
{
    protected static function booted()
    {
        parent::booted();

        static::creating(function ($entity) {
            $entity->forceFill([
                'type' => self::class,
            ]);
        });

        static::deleting(function ($entity) {
        });

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', self::class);
        });
    }
}
