<input
    type="checkbox"
    name="{{ $name }}[{{ $attribute->id }}]"
    {{ optional(optional(optional($product->attributes()->where('id', $attribute->id)->first())->attributable)->value)->value ? 'checked' : '' }}
>