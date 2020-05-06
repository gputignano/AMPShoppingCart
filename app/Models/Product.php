<?php

namespace App\Models;

use App\Contracts\AbstractEntity;

class Product extends AbstractEntity
{
    public function getValueOfAttribute($id)
    {
        if (is_string($id)) $id = Attribute::where('code', $id)->first()->id ?? null;

        return $this->eavs($id)->first()->value->value ?? null;
    }

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
