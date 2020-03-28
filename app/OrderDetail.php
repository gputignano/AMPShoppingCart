<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id', 'code', 'name', 'price', 'quantity',
    ];

    public $timestamps = false;
}
