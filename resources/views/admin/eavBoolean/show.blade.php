@extends('admin.layouts.main')

@section('meta_title', __('Show EAVBoolean'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Show EAVBoolean') }}</h1>

    <p><a href="{{ route('admin.eavBooleans.edit', $eavBoolean) }}">{{ __('Edit') }}</a></p>

    <p>{{ $eavBoolean->value }}</p>

    <form action-xhr="{{ route('admin.eavBooleans.destroy', $eavBoolean) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
