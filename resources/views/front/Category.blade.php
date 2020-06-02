@extends('front.layouts.main')

@section('content')
    <h1>{{ $entity->name }}</h1>

    <ul>
        @forelse ($entity->products()->withRewrite()->get() as $product)
            <li><a href="{{ $product->rewrite->slug }}">{{ $product->name }}</a></li>
        @empty
            <li>{{ __('No Products in this Category') }}</li>
        @endforelse
    </ul>
@endsection