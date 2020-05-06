<input
    type="number"
    name="{{ $name }}[{{ $attribute->id }}]"
    value="{{ optional(optional($product->eavs($attribute->id)->first())->value)->value }}"
    {{ optional(optional($product->eavs($attribute->id)->first())->value)->value }}
>