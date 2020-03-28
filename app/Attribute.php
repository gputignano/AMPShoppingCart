<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = [
        'label', 'type',
    ];

    public $timestamps = false;
}
