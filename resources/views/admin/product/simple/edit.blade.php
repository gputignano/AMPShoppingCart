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

                        <fieldset>
                            <label for="description">{{ __('Description') }}</label>
                            <textarea name="description" cols="30" rows="10">{{ $product->description }}</textarea>
                        </fieldset>

                        <fieldset>
                            <label for="parent_id">{{ __('Parent ID') }}</label>
                
                            <select name="parent_id">
                                <option value="">{{ __('------') }}</option>
                
                                @foreach (App\Models\Product::whereIn('id', $eavs)->get() as $parent)
                                    <option value="{{ $parent->id }}" {{ $product->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
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
                    <form method="post" action-xhr="{{ route('admin.products.update.attributes', $product) }}">
                        @csrf
                        @method('patch')

                        <ul>
                            @if (App\Models\Attribute::where('is_system', false)->count())
                                @foreach (App\Models\Attribute::where('is_system', false)->get() as $attribute)
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

            {{-- CATEGORIES --}}
            <section>
                <h2>{{ __('Categories') }}</h2>

                <div>
                    <form method="post" action-xhr="{{ route('admin.products.update.categories', $product) }}">
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
