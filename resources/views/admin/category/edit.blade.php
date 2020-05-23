@extends('admin.layouts.main')

@section('meta_title', __('Edit ' . $category->name))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
@endsection

@section('content')
    <h1>{{ __('Edit ') . $category->name }}</h1>

    @if (isset($category->parent))
        <div>
            {{ _('Parent Categoory:') }} <a href="{{ route('admin.categories.show', $category->parent) }}">{{ $category->parent->name }}</a>
        </div>
    @endif

    <form method="post" action-xhr="{{ route('admin.categories.update', $category) }}">
        @csrf
        @method('patch')

        <fieldset>
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" value="{{ $category->name }}">
        </fieldset>

        <fieldset>
            <label for="description">{{ __('Description') }}</label>
            <textarea name="description" cols="30" rows="10">{{ $category->description }}</textarea>
        </fieldset>

        @if (App\Models\Product::count())
            <div>
                <h2>{{ __('Related Products') }}</h2>
                <ul>
                    @foreach (App\Models\Product::all() as $product)
                        <li><input type="checkbox" name="products[]" value="{{ $product->id }}" {{ $product->categories->contains($category->id) ? 'checked' : ''}}> {{ $product->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <input type="submit" value="{{ __('Update') }}">

        <div submitting>
            <template type="amp-mustache">
                {{ __('Submitting...') }}
            </template>
        </div>

        <div submit-success>
            <template type="amp-mustache">
                {{ __('Category updated successfully!') }}
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

    <form action-xhr="{{ route('admin.categories.destroy', $category) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
