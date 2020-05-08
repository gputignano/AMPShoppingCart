@extends('admin.layouts.main')

@section('meta_title', __('Create Product'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
@endsection

@section('content')
    <h1>{{ __('Create Product') }}</h1>

    <form method="post" action-xhr="{{ route('admin.products.store') }}">
        @csrf

        <fieldset>
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name">
        </fieldset>

        <fieldset>
            <label for="product_type">{{ __('Product Type') }}</label>

            <select name="product_type">
                @foreach (App\Models\Attribute::withoutGlobalScope('is_system')->find(1)->values as $value)
                    <option value="{{ $value->id }}">{{ $value->value }}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset>
            <legend>{{ __('Select Attribute Variants') }}</legend>

            <ul>
                {{-- Gets attribute from Product EntityType where is_system is false --}}
                @foreach (App\Models\EntityType::where('label', App\Models\Product::class)->first()->attributes()->where('is_system', false)->get() as $attribute)
                    <label for="attribute_variants[{{ $attribute->id }}]">
                        <li><input type="checkbox" name="attribute_variants[]" value="{{ $attribute->id }}"> {{ $attribute->label }}</li>
                    </label>
                @endforeach
            </ul>
        </fieldset>

        <input type="submit" value="{{ __('Create') }}">

        <div submitting>
            <template type="amp-mustache">
                {{ __('Submitting...') }}
            </template>
        </div>

        <div submit-success>
            <template type="amp-mustache">
                {{ __('Product successfully!') }}
            </template>
        </div>

        <div submit-error>
            <template type="amp-mustache">
                <ul>
                    @{{#errors}}
                    <li><strong>@{{name}}</strong>: @{{message}}</li>
                    @{{/errors}}
                </ul>
            </template>
        </div>
    </form>
@endsection
