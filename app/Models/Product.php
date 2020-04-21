<?php

namespace App\Models;

use App\Contracts\Entity;
use Illuminate\Database\Eloquent\Builder;

class Product extends Entity
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
                'type' => 'product',
            ]);
        });

        static::deleting(function ($entity) {
            $entity->children()->delete();
            $entity->eavs()->delete();
            $entity->categories()->detach();
            $entity->rewrite()->delete();
        });

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'product');
        });
    }
}
