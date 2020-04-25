<?php

namespace App\Models;

use App\Contracts\AbstractEntity;
use Illuminate\Database\Eloquent\Builder;

class Category extends AbstractEntity
{
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    protected static function booted()
    {
        parent::booted();

        static::creating(function ($entity) {
            $entity->forceFill([
                'type' => Category::class,
            ]);
        });

        static::deleting(function ($entity) {
            $entity->products()->detach();
        });

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', Category::class);
        });
    }
}
