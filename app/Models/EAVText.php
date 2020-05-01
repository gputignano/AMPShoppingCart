<?php

namespace App\Models;

use App\Contracts\EAVValue;

class EAVText extends EAVValue
{
    public $table = 'eav_texts';

    public static function getInputBlade($product, $attribute)
    {
        return "<textarea name=\"attributes[$attribute->id]\">" . optional(optional($product->eavs()->where('attribute_id', $attribute->id)->first())->value)->value . "</textarea>";
    }
}
