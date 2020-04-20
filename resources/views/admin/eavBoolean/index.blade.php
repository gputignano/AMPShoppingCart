@extends('admin.layouts.main')

@section('meta_title', __('All EAV Booleans'))

@section('content')
    <h1>{{ __('All EAV Booleans') }}</h1>

    <p><a href="{{ route('admin.eavBooleans.create') }}">{{ __('Create EAV Boolean') }}</a></p>

    <table>
        <thead>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Value') }}</th>
        </thead>

        @forelse ($eavBooleans as $eavBoolean)
            <tr>
                <td>{{ $eavBoolean->id }}</td>
                <td><a href="{{ route('admin.eavBooleans.show', $eavBoolean) }}">{{ $eavBoolean->value }}</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="2">{{ __('No EAV Boolean found!') }}</td>
            </tr>
        @endforelse
    </table>
@endsection

