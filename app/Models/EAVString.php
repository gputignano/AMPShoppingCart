<?php

namespace App\Models;

use App\Contracts\EAVValue;

class EAVString extends EAVValue
{
    public $table = 'eav_strings';
}
