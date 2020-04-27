@extends('admin.layouts.main')

@section('meta_title', __('Edit a Entity Type'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
@endsection

@section('content')
    <form method="post" action-xhr="{{ route('admin.entityTypes.update', $entityType) }}">
        @csrf
        @method('patch')

        <fieldset>
            <label for="label">{{ __('Label') }}</label>
            <input type="text" name="label" id="label" value="{{ $entityType->label }}">
        </fieldset>

        @if (\App\Models\Attribute::count())
            <h2>Attributes</h2>

            <ul>
                @foreach (\App\Models\Attribute::all() as $attribute)
                    <li><input type="checkbox" name="attributes[]" value="{{ $attribute->id }}" {{ $entityType->attributes->find($attribute->id) ? 'checked' : '' }}>{{ $attribute->label }}</li>
                @endforeach
            </ul>
        @endif

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

    <form action-xhr="{{ route('admin.entityTypes.destroy', $entityType) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
