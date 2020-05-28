<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model
{
    protected $fillable = [
        'label',
    ];

    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo(
            $this,
            'parent_id',
            'id',
            'parent',
        );
    }

    public function children()
    {
        return $this->hasMany(
            $this,
            'parent_id',
            'id',
        );
    }

    public function attributes()
    {
        return $this->belongsToMany(
            Attribute::class,
            'attribute_attribute_set',
            'attribute_set_id',
            'attribute_id',
            'id',
            'id',
            'attributes',
        );
    }

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'attribute_set_product',
            'attribute_set_id',
            'product_id',
            'id',
            'id',
            'products',
        );
    }
}
