@extends('admin.layouts.main')

@section('meta_title', __('Show EAV Decimal'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Show EAV Decimal') }}</h1>

    <p><a href="{{ route('admin.eavDecimals.edit', $eavDecimal) }}">{{ __('Edit') }}</a></p>

    <p>{{ $eavDecimal->value }}</p>

    <form action-xhr="{{ route('admin.eavDecimals.destroy', $eavDecimal) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
