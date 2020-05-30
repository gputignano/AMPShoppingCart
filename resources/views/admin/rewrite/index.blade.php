@extends('admin.layouts.main')

@section('meta_title', __('All Rewrites'))

@section('content')
    <h1>{{ __('All Rewrites') }}</h1>

    <p><a href="{{ route('admin.rewrites.create') }}">{{ __('Create Rewrite') }}</a></p>

    <table>
        <thead>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Slug') }}</th>
            <th>{{ __('Meta Title') }}</th>
            <th>{{ __('Meta Robots') }}</th>
            <th>{{ __('Is Active') }}</th>
            <th>{{ __('Entity') }}</th>
            <th>{{ __('Action') }}</th>
        </thead>

        @forelse ($rewrites as $rewrite)
            <tr>
                <td>{{ $rewrite->id }}</td>
                <td>{{ $rewrite->slug }}</td>
                <td>{{ $rewrite->meta_title }}</td>
                <td>{{ $rewrite->meta_robots }}</td>
                <td>{{ $rewrite->is_active }}</td>
                <td>{{ $rewrite->entity->name }}</td>
                <td><a href="{{ route('admin.rewrites.edit', $rewrite) }}">{{ __('Edit') }}</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="8">{{ __('No Rewrite found!') }}</td>
            </tr>
        @endforelse
    </table>
@endsection

