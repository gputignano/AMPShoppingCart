<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttributeValueString extends Model
{
    protected $fillable = [
        'attribute_id', 'value',
    ];

    public $timestamps = false;
}
