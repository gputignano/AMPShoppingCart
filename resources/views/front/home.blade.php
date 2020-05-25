@extends('front.layouts.main')

@section('content')

    <header>
        <amp-mega-menu height="30" layout="fixed-height">
            <nav>
                <ul>
                    <li>
                        <a href="{{ route('home') }}">{{ __('Home Page') }}</a>
                    </li>
                    @forelse (App\Models\Category::all() as $category)
                    <li>
                        <span role="button">{{ $category->name }}</span>
                        <div role="dialog">
                            <ul>
                                <li>Sub Category 1</li>
                                <li>Sub Category 2</li>
                                <li>Sub Category 3</li>
                            </ul>
                        </div>
                    </li>
                    @empty
                        
                    @endforelse
                </ul>
            </nav>
        </amp-mega-menu>
    </header>

    <h1>{{ __('Home Page') }}</h1>

    <ul>
        @forelse ($rewrites as $rewrite)
            <li><a href="">{{ $rewrite->entity->name }}</a></li>
        @empty
            <li>{{ __('No Product found.') }}</li>
        @endforelse
    </ul>
@endsection