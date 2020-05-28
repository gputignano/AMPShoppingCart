@extends('admin.layouts.main')

@section('meta_title', __('Edit ' . $page->name))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
@endsection

@section('content')
    <h1>{{ __('Edit ') . $page->name }}</h1>

    <form method="post" action-xhr="{{ route('admin.pages.update', $page) }}">
        @csrf
        @method('patch')

        <fieldset>
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" value="{{ $page->name }}">
        </fieldset>

        <fieldset>
            <label for="description">{{ __('Description') }}</label>
            <textarea name="description" cols="30" rows="10">{{ $page->description }}</textarea>
        </fieldset>

        <input type="submit" value="{{ __('Update') }}">

        <div submitting>
            <template type="amp-mustache">
                {{ __('Submitting...') }}
            </template>
        </div>

        <div submit-success>
            <template type="amp-mustache">
                {{ __('Page updated successfully!') }}
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

    <h2>{{ __('Design') }}</h2>

    <div>
        <form method="post" action-xhr="{{ route('admin.pages.update', $page) }}">
            @csrf
            @method('patch')

            <fieldset>
                <label for="template">{{ __('Template') }}</label>
                <input type="text" name="template" value="{{ $page->template }}">
            </fieldset>

            <input type="submit" value="{{ __('Update') }}">
        </form>
    </div>

    <h2>{{ __('Meta Data') }}</h2>

    <div>
        <form method="post" action-xhr="{{ route('admin.pages.update', $page) }}">
            @csrf
            @method('patch')

            <fieldset>
                <label for="meta[slug]">{{ __('Slug') }}</label>
                <input type="text" name="meta[slug]" value="{{ $page->rewrite->slug }}">
            </fieldset>

            <fieldset>
                <label for="meta[meta_title]">{{ __('Meta Title') }}</label>
                <input type="text" name="meta[meta_title]" value="{{ $page->rewrite->meta_title }}">
            </fieldset>

            <fieldset>
                <label for="meta[meta_description]">{{ __('Meta Description') }}</label>
                <textarea name="meta[meta_description]"  cols="30" rows="3">{{ $page->rewrite->meta_description }}</textarea>
            </fieldset>

            <fieldset>
                <label for="meta[meta_robots]">{{ __('Meta Robots') }}</label>
                <input type="text" name="meta[meta_robots]" value="{{ $page->rewrite->meta_robots }}">
            </fieldset>

            <input type="submit" value="{{ __('Update') }}">

            <div submitting>
                <template type="amp-mustache">
                    {{ __('Submitting...') }}
                </template>
            </div>

            <div submit-success>
                <template type="amp-mustache">
                    {{ __('Product updated successfully!') }}
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
    </div>

    <form action-xhr="{{ route('admin.pages.destroy', $page) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
