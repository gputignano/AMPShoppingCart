@extends('admin.layouts.main')

@section('meta_title', __('Create Rewrite'))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
@endsection

@section('content')
    <h1>{{ __('Create Rewrite') }}</h1>

    <form method="post" action-xhr="{{ route('admin.rewrites.store') }}">
        @csrf

        <fieldset>
            <label for="slug">{{ __('Slug') }}</label>
            <input type="text" name="slug">
        </fieldset>

        <fieldset>
            <label for="meta_title">{{ __('Meta Title') }}</label>
            <input type="text" name="meta_title">
        </fieldset>

        <fieldset>
            <label for="meta_description">{{ __('Meta Description') }}</label>
            <textarea name="meta_description" cols="30" rows="10"></textarea>
        </fieldset>

        <fieldset>
            <label for="meta_robots">{{ __('Meta Robots') }}</label>
            <input type="text" name="meta_robots">
        </fieldset>

        <fieldset>
            <label for="is_active">{{ __('Is Active') }}</label>
            <input type="checkbox" name="is_active">
        </fieldset>

        <fieldset>
            <label for="entity_id">{{ __('Entity') }}</label>
            <select name="entity_id">
                @foreach (App\Models\Entity::all() as $entity)
                    <option value="{{ $entity->id }}">{{ $entity->name }}</option>
                @endforeach
            </select>
        </fieldset>

        <input type="submit" value="{{ __('Create') }}">

        @include('admin.inc.response')
    </form>
@endsection
