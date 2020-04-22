@extends('admin.layouts.main')

@section('meta_title', $product->name)

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ $product->name }}</h1>

    <p><a href="{{ route('admin.products.edit', $product) }}">{{ __('Edit') }}</a></p>

    <p>{{ $product->parent_id }}</p>

    <p>{{ $product->name }}</p>

    <form action-xhr="{{ route('admin.products.destroy', $product) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
