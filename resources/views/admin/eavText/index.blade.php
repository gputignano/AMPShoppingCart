@extends('admin.layouts.main')

@section('meta_title', __('All EAV Texts'))

@section('content')
    <h1>{{ __('All EAVTexts') }}</h1>

    <p><a href="{{ route('admin.eavTexts.create') }}">{{ __('Create EAV Text') }}</a></p>

    <table>
        <thead>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Value') }}</th>
        </thead>

        @forelse ($eavTexts as $eavText)
            <tr>
                <td>{{ $eavText->id }}</td>
                <td><a href="{{ route('admin.eavTexts.show', $eavText) }}">{{ $eavText->value }}</a></td>
            </tr>
        @empty
            <tr>
                <td colspan="2">{{ __('No EAV Text found!') }}</td>
            </tr>
        @endforelse
    </table>
@endsection

