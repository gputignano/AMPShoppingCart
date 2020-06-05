@extends('admin.layouts.main')

@section('meta_title', __('Create a New Attribute'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
@endsection

@section('content')
    <h1>{{ __('Create Attribute') }}</h1>

    <form method="post" action-xhr="{{ route('admin.attributes.store') }}">
        @csrf

        <div>
            <label for="label" class="label">{{ __('Label') }}</label>
            <input type="text" name="label" class="input m0 p0">
        </div>

        <div>
            <label for="code" class="label">{{ __('Code') }}</label>
            <input type="text" name="code" class="input">
        </div>

        <div>
            <label for="type" class="label">{{ __('Type') }}</label>
            <select name="type" class="select">
                <option value="0" selected>{{ ('--select--') }}</option>
                @foreach ([
                    App\Models\EAVBoolean::class,
                    App\Models\EAVDecimal::class,
                    App\Models\EAVInteger::class,
                    App\Models\EAVSelect::class,
                    App\Models\EAVString::class,
                    App\Models\EAVText::class,
                ] as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <input type="submit" value="{{ __('Create') }}" class="btn btn-primary col-12">

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
