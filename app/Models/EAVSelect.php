<?php

namespace App\Models;

class EAVSelect extends EAVValue
{
    public $table = 'eav_strings';

    protected $casts = [
        'value' => 'string',
    ];

    public static $hasDefaultValues = true;
}
