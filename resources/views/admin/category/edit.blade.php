@extends('admin.layouts.main')

@section('meta_title', __('Edit ' . $entity->name))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
    <script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Edit ') . $entity->name }}</h1>

    <amp-accordion id="accordion" expand-single-section animate>
        <section expanded>
            <h2>{{ __('General') }}</h2>

            <div>
                <form method="post" action-xhr="{{ route('admin.categories.update', $entity) }}">
                    @csrf
                    @method('patch')

                    <fieldset>
                        <label for="parent_id">{{ __('Parent') }}</label>
                        <select name="parent_id">
                            <option value="">{{ __('------') }}</option>
                            @forelse (App\Models\Category::where('id', '!=', $entity->id)->get() as $parent)
                                <option value="{{ $parent->id }}" {{ $entity->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                            @empty
                                <option value="" disabled>{{ __('No category available') }}</option>
                            @endforelse
                        </select>
                    </fieldset>

                    <fieldset>
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" value="{{ $entity->name }}">
                    </fieldset>
            
                    <fieldset>
                        <label for="description">{{ __('Description') }}</label>
                        <textarea name="description" cols="30" rows="10">{{ $entity->description }}</textarea>
                    </fieldset>

                    <input type="submit" value="{{ __('Update') }}">

                    @include('admin.inc.response')
                </form>
            </div>
        </section>

        @include('admin.rewrite.inc.edit_form')
    </amp-accordion>

    <form action-xhr="{{ route('admin.categories.destroy', $entity) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
