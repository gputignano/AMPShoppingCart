<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeProduct extends Model
{
    public $table = 'attribute_product';

    protected $fillable = [
        'attribute_id', 'product_id', 'valuable_type', 'valuable_id',
    ];

    public $timestamps = false;
}
