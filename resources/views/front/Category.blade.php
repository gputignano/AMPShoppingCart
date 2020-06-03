@extends('front.layouts.main')

@section('meta_title', $rewrite->meta_title)

@section('meta_description', $rewrite->meta_description)

@section('amp-components')
    @parent

    <script async custom-element="amp-form" src="https://cdn.ampproject.org/v0/amp-form-0.1.js"></script>
    <script async custom-element="amp-fit-text" src="https://cdn.ampproject.org/v0/amp-fit-text-0.1.js"></script>
@endsection

@section('content')
    <h1>{{ $entity->name }}</h1>

    <div class="flex flex-wrap">
        @forelse ($entity->products as $product)
            <div class="col-12 md-col-6 lg-col-4">
                <div class="p1">
                    <amp-img
                        alt="{{ __('Alt Image') }}"
                        src="https://picsum.photos/320"
                        width="320"
                        height="320"
                        layout="responsive"
                    ></amp-img>

                    <h2>
                        <a href="{{ $product->rewrite->slug }}">
                            <amp-fit-text width="200" height="20" layout="responsive">{{ $product->name }}</amp-fit-text>
                        </a>
                    </h2>

                    <div class="h3">
                        {{ __('Price:') }} {{ $product->price }}
                    </div>

                    <div>
                        <form action-xhr="{{ route('cart.store') }}" method="post">
                            @csrf

                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <input type="hidden" name="name" value="{{ $product->name }}">
                            <input type="hidden" name="price" value="{{ $product->price }}">

                            <input type="submit" value="{{ __('Add to Cart') }}" class="btn btn-outline orange col-12">
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div>
                {{ __('No Products in this Category') }}
            </div>
        @endforelse
    </div>
@endsection