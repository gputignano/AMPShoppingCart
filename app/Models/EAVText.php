<?php

namespace App\Models;

class EAVText extends EAVValue
{
    public $table = 'eav_texts';

    protected $casts = [
        'value' => 'string',
    ];
}
