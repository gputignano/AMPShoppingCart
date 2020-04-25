<?php

namespace App\Models;

use App\Contracts\AbstractEntity;
use Illuminate\Database\Eloquent\Builder;

class Product extends AbstractEntity
{
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        parent::booted();

        static::creating(function ($entity) {
            $entity->forceFill([
                'type' => Product::class,
            ]);
        });

        static::deleting(function ($entity) {
            $entity->categories()->detach();
        });

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', Product::class);
        });
    }
}
