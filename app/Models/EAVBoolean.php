<?php

namespace App\Models;

use App\Contracts\EAVValue;

class EAVBoolean extends EAVValue
{
    public $table = 'eav_booleans';

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = 1;
    }
}
