@extends('admin.layouts.main')

@section('meta_title', __('All EAV Integers'))

@section('content')
    <h1>{{ __('All EAV Integers') }}</h1>

    <p><a href="{{ route('admin.eavIntegers.create') }}">{{ __('Create EAV Integer') }}</a></p>

    <table>
        <thead>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Value') }}</th>
        </thead>

        @forelse ($eavIntegers as $eavInteger)
            <tr>
                <td>{{ $eavInteger->id }}</td>
                <td><a href="{{ route('admin.eavIntegers.show', $eavInteger) }}">{{ $eavInteger->value }}</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="2">{{ __('No EAV Integer found!') }}</td>
            </tr>
        @endforelse
    </table>
@endsection

