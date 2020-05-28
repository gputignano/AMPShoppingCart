@extends('admin.layouts.main')

@section('meta_title', __('Edit ' . $page->name))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
    <script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Edit ') . $page->name }}</h1>

    <amp-accordion id="accordion" expand-single-section animate>
        <section expanded>
            <h2>{{ __('General') }}</h2>

            <div>
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
            
                    @include('admin.inc.response')
                </form>
            </div>
        </section>

        <section>
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
        </section>

        <section>
            <h2>{{ __('Meta Data') }}</h2>

            <div>
                <form method="post" action-xhr="{{ route('admin.pages.update', $page) }}">
                    @csrf
                    @method('patch')
        
                    <fieldset>
                        <label for="meta[slug]">{{ __('Slug') }}</label>
                        <input type="text" name="meta[slug]" value="{{ $page->rewrite->slug ?? null }}">
                    </fieldset>
        
                    <fieldset>
                        <label for="meta[meta_title]">{{ __('Meta Title') }}</label>
                        <input type="text" name="meta[meta_title]" value="{{ $page->rewrite->meta_title ?? null }}">
                    </fieldset>
        
                    <fieldset>
                        <label for="meta[meta_description]">{{ __('Meta Description') }}</label>
                        <textarea name="meta[meta_description]"  cols="30" rows="3">{{ $page->rewrite->meta_description ?? null }}</textarea>
                    </fieldset>
        
                    <fieldset>
                        <label for="meta[meta_robots]">{{ __('Meta Robots') }}</label>
                        <input type="text" name="meta[meta_robots]" value="{{ $page->rewrite->meta_robots ?? null }}">
                    </fieldset>
        
                    <input type="submit" value="{{ __('Update') }}">
        
                    @include('admin.inc.response')
                </form>
            </div>
        </section>
    </amp-accordion>

    <form action-xhr="{{ route('admin.pages.destroy', $page) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
