<?php

namespace App\Models;

class Category extends BaseEntity
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
