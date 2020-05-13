<?php

namespace App\Models;

class Product extends BaseEntity
{
    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'category_product',
            'product_id',
            'category_id',
            'id',
            'id',
            'categories',
        );
    }

    protected static function booted()
    {
        parent::booted();

        static::deleting(function ($entity) {
            $entity->categories()->detach();
        });
    }
}
