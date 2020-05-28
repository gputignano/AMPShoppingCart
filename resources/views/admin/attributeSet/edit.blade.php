@extends('admin.layouts.main')

@section('meta_title', __('Edit Attribute Set'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
    <script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
@endsection

@section('content')
    <amp-accordion id="attributeSets" expand-single-section animate>
        <section>
            <h2>{{ __('Default Attributes') }}</h2>

            <form method="post" action-xhr="{{ route('admin.attributeSets.update', $attributeSet) }}">
                @csrf
                @method('patch')
        
                <fieldset>
                    <label for="label">{{ __('Label') }}</label>
                    <input type="text" name="label" value="{{ $attributeSet->label }}">
                </fieldset>
        
                <input type="submit" value="{{ __('Update') }}">
        
                @include('admin.inc.response')
            </form>
        </section>

        <section>
            <h2>{{ __('Attributes') }}</h2>

            <form method="post" action-xhr="{{ route('admin.attributeSets.update', $attributeSet) }}">
                @csrf
                @method('patch')

                <ul>
                    @foreach (App\Models\Attribute::isSystem(false)->get() as $attribute)
                        @if ($attribute->products->count())
                            <input type="hidden" name="attributes[]" value="{{ $attribute->id }}">
                        @endif
                        <li>
                            <input
                                type="checkbox"
                                name="attributes[]"
                                value="{{ $attribute->id }}"
                                {{ $attributeSet->attributes()->find($attribute->id) ? 'checked' : '' }}
                                {{ $attributeSet->attributes()->find($attribute->id) && $attribute->products->count() ? 'disabled' : '' }}
                            >
                            {{ $attribute->label }}
                        </li>
                    @endforeach
                </ul>

                <input type="submit" value="{{ __('Update') }}">

                @include('admin.inc.response')
            </form>
        </section>
    </amp-accordion>

    <form action-xhr="{{ route('admin.attributeSets.destroy', $attributeSet) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}" {{ $attributeSet->products->count() ? 'disabled' : '' }}>
    </form>
@endsection
