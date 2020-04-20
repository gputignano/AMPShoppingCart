@extends('admin.layouts.main')

@section('meta_title', __('All EAV Decimals'))

@section('content')
    <h1>{{ __('All EAV Decimals') }}</h1>

    <p><a href="{{ route('admin.eavDecimals.create') }}">{{ __('Create EAV Decimal') }}</a></p>

    <table>
        <thead>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Value') }}</th>
        </thead>

        @forelse ($eavDecimals as $eavDecimal)
            <tr>
                <td>{{ $eavDecimal->id }}</td>
                <td><a href="{{ route('admin.eavDecimals.show', $eavDecimal) }}">{{ $eavDecimal->value }}</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="2">{{ __('No EAV Decimal found!') }}</td>
            </tr>
        @endforelse
    </table>
@endsection

