@extends('admin.layouts.main')

@section('meta_title', __('Create a New EAV Boolean'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
@endsection

@section('content')
    <h1>{{ __('Create a New EAV Boolean') }}</h1>

    <form method="post" action-xhr="{{ route('admin.eavBooleans.store') }}">
        @csrf

        <fieldset>
            <input type="radio" name="value" id="false" value="0">
            <label for="false">False</label>
        
            <input type="radio" name="value" id="true" value="1">
            <label for="true">True</label>
        </fieldset>

        <input type="submit" value="{{ __('Create') }}">

        <div submitting>
            <template type="amp-mustache">
                {{ __('Submitting...') }}
            </template>
        </div>

        <div submit-success>
            <template type="amp-mustache">
                {{ __('User created successfully!') }}
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
