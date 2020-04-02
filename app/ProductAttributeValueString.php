<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeValueString extends Model
{
    protected $fillable = [
        'attribute_id', 'value',
    ];

    public $timestamps = false;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function attribute_products()
    {
        return $this->morphMany(AttributeProduct::class, 'valuable');
    }
}
