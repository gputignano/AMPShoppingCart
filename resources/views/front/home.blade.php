@extends('front.layouts.main')

@section('content')
    <h1>{{ __('Home Page') }}</h1>

    <ul>
        @forelse (App\Models\Product::all() as $product)
            <li><a href="{{ $product->rewrite->slug }}">{{ $product->name }}</a></li>
        @empty
            <li>{{ __('No Product found.') }}</li>
        @endforelse
    </ul>
@endsection