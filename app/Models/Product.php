<?php

namespace App\Models;

use App\Contracts\AbstractEntity;

class Product extends AbstractEntity
{
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    protected static function booted()
    {
        parent::booted();

        static::deleting(function ($entity) {
            $entity->categories()->detach();
        });
    }
}
