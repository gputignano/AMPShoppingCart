@extends('admin.layouts.main')

@section('meta_title', __('Create a New User'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
@endsection

@section('content')
    <h1>{{ __('Create a New User') }}</h1>

    <form method="post" action-xhr="{{ route('admin.users.store') }}">
        @csrf

        <fieldset>
            <label for="email">{{ __('Email') }}</label>
            <input type="email" name="email" id="email">
        </fieldset>

        <fieldset>
            <label for="password">{{ __('Password') }}</label>
            <input type="password" name="password" id="password">
        </fieldset>

        <fieldset>
            <label for="password_confirm">{{ __('Password Confirm') }}</label>
            <input type="password" name="password_confirm" id="password_confirm">
        </fieldset>

        <input type="submit" value="{{ __('Create') }}">

        <div submitting>
            <template type="amp-mustache">
                Submitting...
            </template>
        </div>

        <div submit-success>
            <template type="amp-mustache">
                Submit Success!!
            </template>
        </div>

        <div submit-error>
            <template type="amp-mustache">
                @{{message}}
                @{{#errors}}
                    <b>@{{email}}</b>
                @{{/errors}}
            </template>
        </div>
    </form>
@endsection
