<?php

namespace App\Models;

use App\Contracts\EAVValue;

class EAVBoolean extends EAVValue
{
    public $table = 'eav_booleans';

    public function setValueAttribute($value)
    {
        $this->attributes['value'] = 1;
    }

    public static function getInputBlade($product, $attribute)
    {
        // return "<input type=\"checkbox\" name=\"attributes[$attribute->id]\" value=\"1\" " . (optional(optional($product->eavs()->where('attribute_id', $attribute->id)->first())->value)->value ? 'checked' : '') . ">";
        return "<input type=\"checkbox\" name=\"attributes[$attribute->id]\" " . (optional(optional($product->eavs()->where('attribute_id', $attribute->id)->first())->value)->value ? 'checked' : '') . ">";
    }
}
