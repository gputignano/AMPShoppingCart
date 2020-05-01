<?php

namespace App\Models;

use App\Contracts\EAVValue;

class EAVString extends EAVValue
{
    public $table = 'eav_strings';

    public static $hasDefaultValues = true;

    public static function getInputBlade($product, $attribute)
    {
        // return "<input type=\"text\" name=\"attributes[$attribute->id]\">";

        $select = "<select name=\"attributes[" . $attribute->id . "]\">";
        $select .= "<option value=\"\">------</option>";

        foreach ($attribute->values as $id => $value) {
            $select .= "<option value=\"" . $value->id . "\" " . (optional(optional($product->eavs()->where('attribute_id', $attribute->id)->first())->value)->id == $value->id ? 'selected' : '') . ">" . $value->value . "</option>";
        }

        $select .= "</select>";

        return $select;
    }
}
