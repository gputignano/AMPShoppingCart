@extends('admin.layouts.main')

@section('meta_title', __('Edit ' . $product->name))

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-template="amp-mustache" src="https://cdn.ampproject.org/v0/amp-mustache-0.2.js"></script>
    <script async custom-element="amp-accordion" src="https://cdn.ampproject.org/v0/amp-accordion-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ __('Edit ') . $product->name }}</h1>

    <form method="post" action-xhr="{{ route('admin.products.update', $product) }}">
        @csrf
        @method('patch')

        <fieldset>
            <label for="parent_id">{{ __('Parent ID') }}</label>

            <select name="parent_id">
                <option value="">{{ __('------') }}</option>

                @foreach (App\Models\Product::where('id', '!=', $product->id)->doesntHave('parent')->get() as $parent)
                    <option value="{{ $parent->id }}" {{ $product->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset>
            <label for="name">{{ __('Name') }}</label>
            <input type="text" name="name" value="{{ $product->name }}">
        </fieldset>

        <amp-accordion id="accordion" expand-single-section animate>
            <section>
                {{-- ADD ATTRIBUTES --}}
                <h2>{{ __('Attributes') }}</h2>

                <div>
                    <ul>
                        @if (App\Models\EntityType::where('label', App\Models\Product::class)->first()->attributes->count())
                            @foreach (App\Models\EntityType::where('label', App\Models\Product::class)->first()->attributes as $attribute)
                                <li>
                                    <label for="">{{ $attribute->label }}</label>

                                    <select name="attributes[{{ $attribute->id }}]">
                                        <option value="">{{ __('------') }}</option>
                                        @foreach ($attribute->values as $value)
                                            <option value="{{ $value->id }}" {{ optional($product->eavs()->where('attribute_id', $attribute->id)->first())->value_id == $value->id ? 'selected' : '' }}>{{ $value->value }}</option>
                                        @endforeach
                                    </select>
                                </li>
                            @endforeach
                        @else
                            <li>{!! __('No attribute found! <a href="' . route('admin.attributes.create') . ' ">Create a new one</a>') !!}</li>
                        @endif
                    </ul>
                </div>
            </section>

            <section>
                {{-- CATEGORIES --}}
                <h2>{{ __('Categories') }}</h2>

                <div>
                    <ul>
                        @if (App\Models\Category::count())
                            @foreach (App\Models\Category::all() as $category)
                                <li><input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ $category->products->contains($product->id) ? 'checked' : ''}}> {{ $category->name }}</li>
                            @endforeach
                        @else
                            <li>{!! __('No category found! <a href="' . route('admin.categories.create') . '">Create a new one</a>') !!}</li>
                        @endif
                    </ul>
                </div>
            </section>
        </amp-accordion>

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
