@extends('admin.layouts.main')

@section('meta_title', $category->name)

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ $category->name }}</h1>

    <p><a href="{{ route('admin.categories.edit', $category) }}">{{ __('Edit') }}</a></p>

    <form action-xhr="{{ route('admin.categories.destroy', $category) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
