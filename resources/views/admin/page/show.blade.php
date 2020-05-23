@extends('admin.layouts.main')

@section('meta_title', $page->name)

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ $page->name }}</h1>

    <p><a href="{{ route('admin.pages.edit', $page) }}">{{ __('Edit') }}</a></p>

    <form action-xhr="{{ route('admin.pages.destroy', $page) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
