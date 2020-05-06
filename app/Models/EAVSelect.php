<?php

namespace App\Models;

use App\Contracts\EAVValue;

class EAVSelect extends EAVValue
{
    public $table = 'eav_strings';

    public static $hasDefaultValues = true;

    public static function getInputBlade($product, $attribute)
    {
        $select = "<select name=\"attributes[" . $attribute->id . "]\">";
        $select .= "<option value=\"\">------</option>";

        foreach ($attribute->values as $id => $value) {
            $select .= "<option value=\"" . $value->id . "\" " . (optional(optional($product->eavs($attribute->id)->first())->value)->id == $value->id ? 'selected' : '') . ">" . $value->value . "</option>";
        }

        $select .= "</select>";

        return $select;
    }
}
