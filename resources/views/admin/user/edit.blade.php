@extends('admin.layouts.main')

@section('meta_title', __('Edit a New User'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
@endsection

@section('content')
    <h1>{{ __('Edit User') }}</h1>

    <form method="post" action-xhr="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('patch')

        <fieldset disabled>
            <label for="email">{{ __('Email') }}</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}">
        </fieldset>

        <fieldset>
            <label for="password">{{ __('Password') }}</label>
            <input type="password" name="password" id="password">
        </fieldset>

        <input type="submit" value="{{ __('Update') }}">

        <div submitting>
            <template type="amp-mustache">
                {{ __('Submitting...') }}
            </template>
        </div>

        <div submit-success>
            <template type="amp-mustache">
                {{ __('User updated successfully!') }}
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

    <form action-xhr="{{ route('admin.users.destroy', $user) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
