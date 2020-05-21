<?php

namespace App\Models;

class EAVInteger extends EAVValue
{
    public $table = 'eav_integers';

    protected $casts = [
        'value' => 'integer',
    ];
}
