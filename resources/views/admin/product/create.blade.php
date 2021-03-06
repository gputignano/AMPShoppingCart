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
            <label for="type">{{ __('Type') }}</label>
            <select name="type">
                <option value="{{ __('simple') }}">{{ __('Simple') }}</option>
            </select>
        </fieldset>

        <fieldset>
            <label for="attribute_set">{{ __('Attribute Set') }}</label>

            <select name="attribute_set_id">
                @foreach (App\Models\AttributeSet::all() as $attribute_set)
                    <option value="{{ $attribute_set->id }}">{{ $attribute_set->label }}</option>
                @endforeach
            </select>
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
