@extends('admin.layouts.main')

@section('meta_title', __('All Categories'))

@section('content')
    <h1>{{ __('All Categories') }}</h1>

    <p><a href="{{ route('admin.categories.create') }}">{{ __('Create Category') }}</a></p>

    <table>
        <thead>
            <th>{{ __('ID') }}</th>
            <td>{{ __('Name') }}</td>
            <th>{{ __('Parent') }}</th>
        </thead>

        @forelse ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td><a href="{{ route('admin.categories.show', $category) }}">{{ $category->name }}</a></td>
                <td>{{ $category->parent->name ?? 'none' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">{{ __('No Category found!') }}</td>
            </tr>
        @endforelse
    </table>
@endsection

