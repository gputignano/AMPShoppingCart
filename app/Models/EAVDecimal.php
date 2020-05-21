<?php

namespace App\Models;

class EAVDecimal extends EAVValue
{
    public $table = 'eav_decimals';

    protected $casts = [
        'value' => 'decimal:6',
    ];
}
