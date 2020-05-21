<?php

namespace App\Models;

class EAVBoolean extends EAVValue
{
    public $table = 'eav_booleans';

    protected $casts = [
        'value' => 'boolean',
    ];

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = 1;
    }
}
