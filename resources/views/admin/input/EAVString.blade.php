<input
    type="text"
    name="{{ $name }}[{{ $attribute->id }}]"
    value="{{ optional(optional(optional($product->attributes()->where('id', $attribute->id)->first())->attributable)->value)->value }}"
>