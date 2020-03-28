<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'parent_id', 'attribute_set_id', 'name', 'code', 'price', 'quantity',
    ];

    public $timestamps = false;
}
