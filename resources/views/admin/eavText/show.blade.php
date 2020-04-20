@extends('admin.layouts.main')

@section('meta_title', __('Show EAV Text'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Show EAVText') }}</h1>

    <p><a href="{{ route('admin.eavTexts.edit', $eavText) }}">{{ __('Edit') }}</a></p>

    <p>{{ $eavText->value }}</p>

    <form action-xhr="{{ route('admin.eavTexts.destroy', $eavText) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
