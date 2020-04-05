<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;

class Category extends EntityAbstract
{
    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function rewrite()
    {
        return $this->morphOne(Rewrite::class, 'rewritable');
    }

    protected static function booted()
    {
        parent::booted();

        static::creating(function ($entity) {
            $entity->forceFill([
                'type' => 'category',
            ]);
        });

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'category');
        });
    }
}
