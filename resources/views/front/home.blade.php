@extends('front.layouts.main')

@section('content')
    <h1>{{ __('Home Page') }}</h1>

    <ul>
        @forelse ($rewrites as $rewrite)
            <li><a href="{{ $rewrite->slug }}">{{ $rewrite->entity->name }}</a></li>
        @empty
            <li>{{ __('No Product found.') }}</li>
        @endforelse
    </ul>
@endsection