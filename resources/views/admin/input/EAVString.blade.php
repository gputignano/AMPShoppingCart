<input
    type="text"
    name="{{ $name }}[{{ $attribute->id }}]"
    value="{{ optional(optional($product->eavs($attribute->id)->first())->value)->value }}"
>