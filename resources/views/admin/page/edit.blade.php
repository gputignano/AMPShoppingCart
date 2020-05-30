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
