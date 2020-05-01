<?php

namespace App\Models;

use App\Contracts\EAVValue;

class EAVInteger extends EAVValue
{
    public $table = 'eav_integers';

    public static function getInputBlade($product, $attribute)
    {
        return "<input type=\"text\" name=\"attributes[$attribute->id]\" value=\"" . optional(optional($product->eavs()->where('attribute_id', $attribute->id)->first())->value)->value . "\">";
    }
}
