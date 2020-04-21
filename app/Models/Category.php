<?php

namespace App\Models;

use App\Contracts\Entity;
use Illuminate\Database\Eloquent\Builder;

class Category extends Entity
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
