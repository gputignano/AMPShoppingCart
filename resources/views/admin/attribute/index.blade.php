@extends('admin.layouts.main')

@section('meta_title', __('All Attributes'))

@section('content')
    <h1>{{ __('All Attributes') }}</h1>

    <p><a href="{{ route('admin.attributes.create') }}">{{ __('Create New Attribute') }}</a></p>

    <table>
        <thead>
            <th>{{ __('ID') }}</th>
            <th>{{ __('Label') }}</th>
            <th>{{ __('Type') }}</th>
        </thead>

        @forelse ($attributes as $attribute)
            <tr>
                <td>{{ $attribute->id }}</td>
                <td><a href="{{ route('admin.attributes.show', $attribute) }}">{{ $attribute->label }}</a></td>
                <td>{{ $attribute->type }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3">{{ __('No Attribute found!') }}</td>
            </tr>
        @endforelse
    </table>
@endsection
