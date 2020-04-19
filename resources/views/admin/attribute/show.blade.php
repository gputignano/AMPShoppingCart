@extends('admin.layouts.main')

@section('meta_title', __('Show Entity Type'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Show Attribute') }}</h1>

    <p><a href="{{ route('admin.attributes.edit', $attribute) }}">{{ __('Edit') }}</a></p>

    <p>{{ $attribute->label }}</p>

    <p>{{ $attribute->type }}</p>

    <form action-xhr="{{ route('admin.attributes.destroy', $attribute) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>

    @if ($attribute->entity_types()->count())
        <h2>{{ __('Entity Types') }}</h2>

        <ul>
            @foreach ($attribute->entity_types as $entity_type)
                <li>{{ $entity_type->label }}</li>
            @endforeach
        </ul>
    @endif
@endsection
