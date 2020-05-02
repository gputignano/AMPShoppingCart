@extends('admin.layouts.main')

@section('meta_title', $category->name)

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ $category->name }}</h1>

    @if ($category->parent)
        <p><a href="{{ route('admin.categories.show', $category->parent) }}">{{ $category->parent->name }}</a></p>
    @else
        <p><a href="{{ route('admin.categories.index') }}">{{ __('All Categories') }}</a></p>
    @endif

    <ul>
        @forelse ($category->children as $children)
            <li><a href="{{ route('admin.categories.show', $children) }}">{{ $children->name }}</a></li>
        @empty
            <li>{{ __('No category found') }}</li>
        @endforelse
    </ul>

    <p><a href="{{ route('admin.categories.edit', $category) }}">{{ __('Edit') }}</a></p>

    <form action-xhr="{{ route('admin.categories.destroy', $category) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
