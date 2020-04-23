@extends('admin.layouts.main')

@section('meta_title', __('All Pages'))

@section('content')
    <h1>{{ __('All Pages') }}</h1>

    <p><a href="{{ route('admin.pages.create') }}">{{ __('Create Page') }}</a></p>

    <table>
        <thead>
            <th>{{ __('ID') }}</th>
            <td>{{ __('Name') }}</td>
            <th>{{ __('Parent') }}</th>
        </thead>

        @forelse ($pages as $page)
            <tr>
                <td>{{ $page->id }}</td>
                <td><a href="{{ route('admin.pages.show', $page) }}">{{ $page->name }}</a></td>
                <td>{{ $prage->parent->name ?? 'none' }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">{{ __('No Page found!') }}</td>
            </tr>
        @endforelse
    </table>
@endsection

