@extends('admin.layouts.main')

@section('meta_title', __('Edit a EAV Integer'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
@endsection

@section('content')
    <h1>{{ __('Edit EAVInteger') }}</h1>

    <form method="post" action-xhr="{{ route('admin.eavIntegers.update', $eavInteger) }}">
        @csrf
        @method('patch')

        <fieldset>
            <label for="value">{{ __('Value') }}</label>
            <input type="number" name="value" value="{{ $eavInteger->value }}">
        </fieldset>

        <input type="submit" value="{{ __('Update') }}">

        <div submitting>
            <template type="amp-mustache">
                {{ __('Submitting...') }}
            </template>
        </div>

        <div submit-success>
            <template type="amp-mustache">
                {{ __('EAV Integer updated successfully!') }}
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

    <form action-xhr="{{ route('admin.eavIntegers.destroy', $eavInteger) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
