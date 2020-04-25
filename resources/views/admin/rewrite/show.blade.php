@extends('admin.layouts.main')

@section('meta_title', $rewrite->meta_title)

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ $rewrite->meta_title }}</h1>

    <p><a href="{{ route('admin.rewrites.edit', $rewrite) }}">{{ __('Edit') }}</a></p>

    <p>{{ __('Slug') . ': ' . $rewrite->slug }}</p>

    <p>{{ __('Meta Description') . ': ' . $rewrite->meta_description }}</p>

    <p>{{ __('Meta Robots') . ': ' . $rewrite->meta_robots }}</p>

    <p>{{ __('Template') . ': ' . $rewrite->template }}</p>

    <p>{{ __('Enabled') . ': ' . $rewrite->enabled }}</p>

    <p>{{ __('Entity ID') . ': ' . $rewrite->entity_id }}</p>

    <form action-xhr="{{ route('admin.rewrites.destroy', $rewrite) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
