<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model
{
    protected $fillable = [
        'label',
    ];

    public $timestamps = false;
}
