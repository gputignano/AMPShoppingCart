<input
    type="number"
    step="0.01"
    name="{{ $name }}[{{ $attribute->id }}]"
    value="{{ optional(optional($product->attributables($attribute->id)->first())->value)->value }}"
>