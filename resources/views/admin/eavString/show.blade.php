@extends('admin.layouts.main')

@section('meta_title', __('Show EAV String'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Show EAVString') }}</h1>

    <p><a href="{{ route('admin.eavStrings.edit', $eavString) }}">{{ __('Edit') }}</a></p>

    <p>{{ $eavString->value }}</p>

    <form action-xhr="{{ route('admin.eavStrings.destroy', $eavString) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
