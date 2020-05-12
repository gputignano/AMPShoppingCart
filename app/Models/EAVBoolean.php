<?php

namespace App\Models;

class EAVBoolean extends EAVValue
{
    public $table = 'eav_booleans';

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = 1;
    }
}
