<select name="{{ $name }}[{{ $attribute->id }}]" {{ $attribute->values->count() > 0 ? '' : 'disabled' }}>
    <option value="">------</option>

    @foreach ($attribute->values as $id => $value)
        <option
            value="{{ $value->id }}"
            {{ optional(optional(optional($product->attributes()->where('id', $attribute->id)->first())->attributable)->value)->id == $value->id ? 'selected' : '' }}
        >{{ $value->value }}</option>
    @endforeach
</select>
