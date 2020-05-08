<?php

namespace App\Models;

class Category extends Entity
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
