<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_id', 'attribute_set_id', 'name', 'code', 'price', 'quantity',
    ];

    public $timestamps = false;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::deleting(function ($product) {
            $product->children()->delete();
        });
    }

    public function parent()
    {
        return $this->belongsTo($this, 'product_id');
    }

    public function children()
    {
        return $this->hasMany($this);
    }

    public function attribute_set()
    {
        return $this->belongsTo(AttributeSet::class);
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
        return $this->morphMany(EAV::class, 'entity_eavable');
    }
}
