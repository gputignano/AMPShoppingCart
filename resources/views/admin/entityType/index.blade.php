@extends('admin.layouts.main')

@section('meta_title', __('All Entity Types'))

@section('content')
    <h1>{{ __('All Entity Types') }}</h1>

    <p><a href="{{ route('admin.entityTypes.create') }}">{{ __('Create Entity Type') }}</a></p>

    <table>
        <thead>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Label') }}</th>
        </thead>

        @forelse ($entityTypes as $entityType)
            <tr>
                <td>{{ $entityType->id }}</td>
                <td><a href="{{ route('admin.entityTypes.edit', $entityType) }}">{{ $entityType->label }}</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="2">{{ __('No Entity Type found!') }}</td>
            </tr>
        @endforelse
    </table>
@endsection

