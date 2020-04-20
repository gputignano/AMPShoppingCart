@extends('admin.layouts.main')

@section('meta_title', __('Edit a EAV Boolean'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
@endsection

@section('content')
    <form method="post" action-xhr="{{ route('admin.eavBooleans.update', $eavBoolean) }}">
        @csrf
        @method('patch')

        <fieldset>
            @foreach ([0 => 'false', 1 => 'true'] as $key => $value)
                <input type="radio" name="value" id="{{ $value }}" value="{{ $key }}" {{ $eavBoolean->value == $key ? 'checked' : '' }}>
                <label for="{{ $value }}">{{ $value }}</label>
            @endforeach
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
@endsection
