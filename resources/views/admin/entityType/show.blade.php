@extends('admin.layouts.main')

@section('meta_title', __('Show Entity Type'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Show Entity type') }}</h1>

    <p><a href="{{ route('admin.entityTypes.edit', $entityType) }}">{{ __('Edit') }}</a></p>

    <p>{{ $entityType->label }}</p>

    <form action-xhr="{{ route('admin.entityTypes.destroy', $entityType) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>

    @if ($entityType->attributes()->count())
        <h2>Attributes</h2>

        <ul>
            @foreach ($entityType->attributes as $attribute)
                <li>{{ $attribute->label }}</li>
            @endforeach
        </ul>
    @endif
@endsection
