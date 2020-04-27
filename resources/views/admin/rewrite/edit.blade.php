@extends('admin.layouts.main')

@section('meta_title', $rewrite->meta_title)

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
@endsection

@section('content')
    <h1>{{ $rewrite->meta_title }}</h1>

    <form method="post" action-xhr="{{ route('admin.rewrites.update', $rewrite) }}">
        @csrf
        @method('patch')

        <fieldset>
            <label for="slug">{{ __('Slug') }}</label>
            <input type="text" name="slug" value="{{ $rewrite->slug }}">
        </fieldset>

        <fieldset>
            <label for="meta_title">{{ __('Meta Title') }}</label>
            <input type="text" name="meta_title" value="{{ $rewrite->meta_title }}">
        </fieldset>

        <fieldset>
            <label for="meta_description">{{ __('Meta Description') }}</label>
            <textarea name="meta_description" cols="30" rows="10">{{ $rewrite->meta_description }}</textarea>
        </fieldset>

        <fieldset>
            <label for="meta_robots">{{ __('Meta Robots') }}</label>
            <input type="text" name="meta_robots" value="{{ $rewrite->meta_robots }}">
        </fieldset>

        <fieldset>
            <label for="template">{{ __('Template') }}</label>
            <input type="text" name="template" value="{{ $rewrite->templete }}">
        </fieldset>

        <fieldset>
            <label for="enabled">{{ __('Enabled') }}</label>
            <input type="checkbox" name="enabled" {{ $rewrite->enabled ? 'checked' : '' }}>
        </fieldset>

        <fieldset>
            <label for="rewritable_id">{{ __('Rewritable') }}</label>
            <select name="rewritable_id">
                @foreach (App\Models\Entity::all() as $entity)
                    <option value="{{ $entity->id }}" {{ $entity->id == $rewrite->id ? 'selected' : '' }}>{{ $entity->name }}</option>
                @endforeach
            </select>
        </fieldset>

        <input type="submit" value="{{ __('Update') }}">

        <div submitting>
            <template type="amp-mustache">
                {{ __('Submitting...') }}
            </template>
        </div>

        <div submit-success>
            <template type="amp-mustache">
                {{ __('Rewrite updated successfully!') }}
            </template>
        </div>

        <div submit-error>
            <template type="amp-mustache">
                <ul>
                    @{{#errors}}
                    <li><strong>@{{name}}</strong>: @{{message}}</li>
                    @{{/errors}}
                </ul>
            </template>
        </div>
    </form>

    <form action-xhr="{{ route('admin.rewrites.destroy', $rewrite) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
