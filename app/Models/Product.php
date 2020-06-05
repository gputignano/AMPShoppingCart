<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Product extends Entity
{
    protected $fillable = [
        'parent_id', 'name', 'description', 'type', 'attribute_set_id',
    ];

    public function attribute_set()
    {
        return $this->belongsTo(
            AttributeSet::class,
            'attribute_set_id',
            'id',
            'attribute_set',
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

        // static::creating(function ($entity) {
        //     $entity->forceFill([
        //         'type' => static::class,
        //     ]);
        // });

        // static::deleting(function ($entity) {
        //     $entity->categories()->detach();
        // });
    }
}
