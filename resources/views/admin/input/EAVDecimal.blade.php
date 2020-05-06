<input
    type="number"
    step="0.01"
    name="{{ $name }}[{{ $attribute->id }}]"
    value="{{ optional(optional($product->eavs($attribute->id)->first())->value)->value }}"
    {{ optional(optional($product->eavs($attribute->id)->first())->value)->value }}
>