<?php

namespace App\Models;

class EAVSelect extends EAVValue
{
    public $table = 'eav_strings';

    public static $hasDefaultValues = true;
}
