@extends('admin.layouts.main')

@section('meta_title', __('Edit Attribute'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
    <script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Edit Attribute') }}</h1>

    {{-- ATTRIBUTE VALUES --}}
    <amp-accordion id="attributes" expand-single-section animate>
        <section>
            <h2>{{ __('Default Attributes') }}</h2>

            <form method="post" action-xhr="{{ route('admin.attributes.update', $attribute) }}">
                @csrf
                @method('patch')

                <fieldset>
                    <label for="label">{{ __('Label') }}</label>
                    <input type="text" name="label" value="{{ $attribute->label }}">
                </fieldset>
    
                <fieldset disabled>
                    <label for="code">{{ __('Code') }}</label>
                    <input type="text" name="code" value="{{ $attribute->code }}">
                </fieldset>
    
                <fieldset disabled>
                    <label for="type">{{ __('Type') }}</label>
                    <input type="text" name="type" value="{{ class_basename($attribute->type) }}">
                </fieldset>

                <fieldset>
                    <label for="is_system">{{ __('Is System') }}</label>
                    <input type="checkbox" name="is_system" {{ $attribute->checked($attribute, 'is_system') }}>
                </fieldset>
    
                <fieldset>
                    <label for="is_visible_on_front">{{ __('Is Visible on Front') }}</label>
                    <input type="checkbox" name="is_visible_on_front" {{ $attribute->checked($attribute, 'is_visible_on_front') }}>
                </fieldset>

                <input type="submit" value="{{ __('Update') }}">

                @include('admin.inc.response')
            </form>
        </section>

        @if ($attribute->type::$hasDefaultValues)
        <section>
            <h2>{{ __('Attribute Values') }}</h2>

            <form method="post" action-xhr="{{ route('admin.attributes.update', $attribute) }}">
                @csrf
                @method('patch')

                <ul>
                    @forelse ($attribute->values as $value)
                        <li>
                            {{ $value->value }}
                        </li>
                    @empty
                        <li>{{ __('No attribute found') }}</li>
                    @endforelse
                </ul>
    
                @if ($attribute->type::$hasDefaultValues)
                    <fieldset>
                        <label for="value">{{ __('Value') }}</label>
                        <input type="text" name="value">
                    </fieldset>
                @endif

                <input type="submit" value="{{ __('Update') }}">

                @include('admin.inc.response')
            </form>
        </section>
        @endif
    </amp-accordion>

    <form action-xhr="{{ route('admin.attributes.destroy', $attribute) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}" {{ $attribute->products->count() ? 'disabled' : '' }}>
    </form>
@endsection
