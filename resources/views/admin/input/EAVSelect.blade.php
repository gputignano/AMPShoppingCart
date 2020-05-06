<select name="{{ $name }}[{{ $attribute->id }}]" {{ $attribute->values->count() > 0 ? '' : 'disabled' }}>
    <option value="">------</option>

    @foreach ($attribute->values as $id => $value)
        <option value="{{ $value->id }}" {{ (optional(optional($product->eavs($attribute->id)->first())->value)->id == $value->id ? 'selected' : '') }}>{{ $value->value }}</option>
    @endforeach
</select>
