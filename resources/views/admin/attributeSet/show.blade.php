@extends('admin.layouts.main')

@section('meta_title', __('Show Attribute Set'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Show Attribute Set') }}</h1>

    <p><a href="{{ route('admin.attributeSets.edit', $attributeSet) }}">{{ __('Edit') }}</a></p>

    <p>{{ $attributeSet->label }}</p>

    <form action-xhr="{{ route('admin.attributeSets.destroy', $attributeSet) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
