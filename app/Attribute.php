<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'label', 'type',
    ];

    public $timestamps = false;

    public function attribute_sets()
    {
        return $this->belongsToMany(AttributeSet::class);
    }

    public function productAttributeValueStrings()
    {
        return $this->hasMany(ProductAttributeValueString::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'eavs');
    }
}
