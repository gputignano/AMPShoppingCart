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
            <th>{{ __('Meta Description') }}</th>
            <th>{{ __('Meta Robots') }}</th>
            <th>{{ __('Template') }}</th>
            <th>{{ __('Enabled') }}</th>
            <th>{{ __('Rewritable Type') }}</th>
            <th>{{ __('Rewrite ID') }}</th>
        </thead>

        @forelse ($rewrites as $rewrite)
            <tr>
                <td>{{ $rewrite->id }}</td>
                <td>{{ $rewrite->slug }}</td>
                <td>{{ $rewrite->meta_title }}</td>
                <td>{{ $rewrite->meta_description }}</td>
                <td>{{ $rewrite->meta_robots }}</td>
                <td>{{ $rewrite->template }}</td>
                <td>{{ $rewrite->enabled }}</td>
                <td>{{ $rewrite->rewritable_type }}</td>
                <td>{{ $rewrite->rewritable_id }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="8">{{ __('No Rewrite found!') }}</td>
            </tr>
        @endforelse
    </table>
@endsection

