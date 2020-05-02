<?php

namespace App\Models;

use App\Contracts\AbstractEntity;

class Category extends AbstractEntity
{
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    protected static function booted()
    {
        parent::booted();

        static::deleting(function ($entity) {
            $entity->products()->detach();
        });
    }
}
