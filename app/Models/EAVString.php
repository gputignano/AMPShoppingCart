<?php

namespace App\Models;

use App\Contracts\EAVValue;

class EAVString extends EAVValue
{
    public $table = 'eav_strings';

    public static function getInputBlade($product, $attribute)
    {
        return "<input type=\"text\" name=\"attributes[" . $attribute->id . "]\" value=\"" . $attribute->value . "\">";
    }
}
