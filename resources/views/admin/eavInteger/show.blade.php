@extends('admin.layouts.main')

@section('meta_title', __('Show EAV Integer'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Show EAVInteger') }}</h1>

    <p><a href="{{ route('admin.eavIntegers.edit', $eavInteger) }}">{{ __('Edit') }}</a></p>

    <p>{{ $eavInteger->value }}</p>

    <form action-xhr="{{ route('admin.eavIntegers.destroy', $eavInteger) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
