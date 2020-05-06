<input
    type="checkbox"
    name="{{ $name }}[{{ $attribute->id }}]"
    {{ (optional(optional($product->eavs()->where('attribute_id', $attribute->id)->first())->value)->value ? 'checked' : '') }}
>