<input
    type="number"
    step="0.01"
    name="{{ $name }}[{{ $attribute->id }}]"
    value="{{ optional(optional(optional($product->attributes()->where('id', $attribute->id)->first())->attributable)->value)->value }}"
>