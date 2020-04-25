@extends('admin.layouts.main')

@section('meta_title', __('All Categories'))

@section('content')
    <h1>{{ __('All Categories') }}</h1>

    <p><a href="{{ route('admin.categories.create') }}">{{ __('Create Category') }}</a></p>

    <ul>
        @forelse ($categories as $category)
            <li>
                <a href="{{ route('admin.categories.show', $category) }}">{{ $category->name }}</a>
            </li>
        @empty
            <li>{{ __('No Category found!') }}</li>
        @endforelse
    </ul>
@endsection
