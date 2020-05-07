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

    <amp-accordion id="accordion" expand-single-section animate>
        <section expanded>
            <h2>{{ __('General') }}</h2>

            <div>
                <form method="post" action-xhr="{{ route('admin.products.update', $product) }}">
                    @csrf
                    @method('patch')
            
                    <fieldset>
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" name="name" value="{{ $product->name }}">
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
        </section>

        {{-- ADD ATTRIBUTES --}}
        <section>
            <h2>{{ __('Attributes') }}</h2>

            <div>
                <form method="post" action-xhr="{{ route('admin.products.update', $product) }}">
                    @csrf
                    @method('patch')

                    <ul>
                        @if (App\Models\EntityType::where('label', App\Models\Product::class)->first()->attributes->count())
                            @foreach (App\Models\EntityType::where('label', App\Models\Product::class)->first()->attributes as $attribute)
                                <li>
                                    <label for="">{{ $attribute->label }}</label>

                                    @include('admin.input.' . class_basename($attribute->type), ['name' => 'attributes','product' => $product, 'attribute' => $attribute])
                                </li>
                            @endforeach
                        @else
                            <li>{!! __('No attribute found! <a href="' . route('admin.attributes.create') . ' ">Create a new one</a>') !!}</li>
                        @endif
                    </ul>

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
        </section>

        {{-- PRODUCT VARIANTS --}}
        <section>
            <h2>{{ __('Variants') }}</h2>

            <div>
                <div>
                    <ul>
                        @forelse ($product->children as $variant)
                            <li>
                                <a href="{{ route('admin.products.edit', $variant) }}">
                                    {{ $variant->name }}
                                </a>

                                <ul>
                                    {{-- THE QUERY RETURNS EAVS WHICH ATTRIBUTES ARE DEFINED IN PARENT CONFIGURABLE PRODUCT --}}
                                    @foreach (App\Models\EAV::whereHas('attribute', function ($query) use ($product) {
                                        $query->whereIn('id', json_decode(App\Models\EAVString::whereHas('eav', function ($query) use ($product) {
                                            $query->where('attribute_id', 2)->where('entity_id', $product->id);
                                        })->first()->value));
                                    })->get() as $eav)
                                        <li>{{ $eav->attribute->label }}: {{ $eav->value->value }}</li>
                                    @endforeach
                                </ul>
                            </li>
                        @empty
                            <li>{!! __('No product variant found! <a href="' . route('admin.products.create') . '">Create a new one</a>') !!}</li>
                        @endforelse
                    </ul>
                </div>

                <div>
                    <form action-xhr="{{ route('admin.products.update', $product) }}" method="post">
                        @csrf

                        {{-- TO DO --}}

                        <input type="submit" value="{{ __('Add') }}">

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
            </div>
        </section>

        {{-- CATEGORIES --}}
        <section>
            <h2>{{ __('Categories') }}</h2>

            <div>
                <form method="post" action-xhr="{{ route('admin.products.update', $product) }}">
                    @csrf
                    @method('patch')

                    <ul>
                        @if (App\Models\Category::count())
                            @foreach (App\Models\Category::all() as $category)
                                <li><input type="checkbox" name="categories[]" value="{{ $category->id }}" {{ $category->products->contains($product->id) ? 'checked' : ''}}> {{ $category->name }}</li>
                            @endforeach
                        @else
                            <li>{!! __('No category found! <a href="' . route('admin.categories.create') . '">Create a new one</a>') !!}</li>
                        @endif
                    </ul>

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
        </section>
    </amp-accordion>

    <form action-xhr="{{ route('admin.products.destroy', $product) }}" method="post">
        @csrf
        @method('delete')

        <input type="submit" value="{{ __('Delete') }}">
    </form>
@endsection
