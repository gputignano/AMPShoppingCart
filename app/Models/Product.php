<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class Product extends EntityAbstract
{
    public function parent()
    {
        return $this->belongsTo($this, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function attribute_sets()
    {
        return $this->belongsToMany(AttributeSet::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function rewrite()
    {
        return $this->morphOne(Rewrite::class, 'rewritable');
    }

    public function eavs()
    {
        return $this->morphMany(EAV::class, 'entity');
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
        });

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', 'product');
        });
    }
}
