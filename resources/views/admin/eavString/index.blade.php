@extends('admin.layouts.main')

@section('meta_title', __('All EAV Strings'))

@section('content')
    <h1>{{ __('All EAVStrings') }}</h1>

    <p><a href="{{ route('admin.eavStrings.create') }}">{{ __('Create EAV String') }}</a></p>

    <table>
        <thead>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Value') }}</th>
        </thead>

        @forelse ($eavStrings as $eavString)
            <tr>
                <td>{{ $eavString->id }}</td>
                <td><a href="{{ route('admin.eavStrings.edit', $eavString) }}">{{ $eavString->value }}</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="2">{{ __('No EAV Integer found!') }}</td>
            </tr>
        @endforelse
    </table>
@endsection

