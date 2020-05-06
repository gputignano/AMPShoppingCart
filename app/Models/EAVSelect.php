<?php

namespace App\Models;

use App\Contracts\EAVValue;

class EAVSelect extends EAVValue
{
    public $table = 'eav_strings';

    public static $hasDefaultValues = true;
}
