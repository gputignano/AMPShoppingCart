<?php

namespace App\Models;

class EAVString extends EAVValue
{
    public $table = 'eav_strings';

    protected $casts = [
        'value' => 'string',
    ];
}
