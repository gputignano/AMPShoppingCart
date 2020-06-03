@extends('front.layouts.main')

@section('meta_title', $rewrite->meta_title)

@section('meta_description', $rewrite->meta_description)

@section('amp-components')
    @parent

@endsection

@section('content')
    <h1>{{ __('Home Page') }}</h1>

    <ul>
        @forelse (App\Models\Product::has('rewrite')->get() as $product)
            <li><a href="{{ $product->rewrite->slug }}">{{ $product->name }}</a></li>
        @empty
            <li>{{ __('No Product found.') }}</li>
        @endforelse
    </ul>
@endsection