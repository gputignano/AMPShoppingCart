@extends('admin.layouts.main')

@section('meta_title', __('All Attribute Sets'))

@section('content')
    <h1>{{ __('All Attribute Sets') }}</h1>

    <p><a href="{{ route('admin.attributeSets.create') }}">{{ __('Create AttributeSet') }}</a></p>

    <ul>
        @forelse ($attributeSets as $attributeSet)
            <li>
                <a href="{{ route('admin.attributeSets.show', $attributeSet) }}">{{ $attributeSet->name }}</a>
            </li>
        @empty
            <li>{{ __('No Attribute Set found!') }}</li>
        @endforelse
    </ul>
@endsection
