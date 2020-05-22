<input
    type="text"
    name="{{ $name }}[{{ $attribute->id }}]"
    value="{{ optional(optional($product->attributables($attribute->id)->first())->value)->value }}"
>