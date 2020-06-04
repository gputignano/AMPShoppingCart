<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Category extends Entity
{
    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'category_product',
            'category_id',
            'product_id',
            'id',
            'id',
            'products',
        );
    }

    protected static function booted()
    {
        parent::booted();

        static::deleting(function ($entity) {
            $entity->products()->detach();
        });
    }
}
