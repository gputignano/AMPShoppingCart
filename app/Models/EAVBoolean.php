<?php

namespace App\Models;

use App\Contracts\EAVValue;

class EAVBoolean extends EAVValue
{
    public $table = 'eav_booleans';
}
