@extends('admin.layouts.main')

@section('meta_title', __('Edit ' . $product->name))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
@endsection

@section('content')
    <h1>{{ __('Edit ') . $product->name }}</h1>

    <form method="post" action-xhr="{{ route('admin.products.update', $product) }}">
        @csrf
        @method('patch')

        <fieldset>
            <label for="parent_id">{{ __('Parent ID') }}</label>

            <select name="parent_id">
                <option value="0">{{ __('------') }}</option>
                @foreach (App\Models\Product::where('id', '!=', $product->id)->get() as $parent)
                    <option value="{{ $parent->id }}" {{ $product->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset>
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" value="{{ $product->name }}">
        </fieldset>

        @if (App\Models\Category::count())
            <div>
                <ul>
                    @foreach (App\Models\Category::all() as $category)
                        <li><input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ $category->products->contains($product->id) ? 'checked' : ''}}> {{ $category->name }}</li>
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
@endsection
