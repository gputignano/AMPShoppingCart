<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Product extends Entity
{
    public function attribute_sets()
    {
        return $this->belongsToMany(
            AttributeSet::class,
            'attribute_set_product',
            'product_id',
            'attribute_set_id',
            'id',
            'id',
            'attribute_sets',
        );
    }

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
