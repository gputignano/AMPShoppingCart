<!doctype html>
<html amp lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="preconnect" href="https://cdn.ampproject.org">
        <script async src="https://cdn.ampproject.org/v0.js"></script>
        <title>{{ $rewrite->meta_title }}</title>
        <meta name="description" content="{{ $rewrite->meta_description }}">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
        <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
        {{-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto"> --}}

        @section('amp-custom-style')
            @include('admin.layouts.styles')
        @show

        @section('amp-components')
            {{-- <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script> --}}
            {{-- <script async custom-element="amp-mega-menu" src="https://cdn.ampproject.org/v0/amp-mega-menu-0.1.js"></script> --}}
        @show

    </head>
    <body>
        <header>
            <nav>
                <ul class="flex list-reset">
                    <li class="inline-block mr1">
                        <a href="{{ route('front', '/') }}">{{ __('Home Page') }}</a>
                    </li>
                    @forelse (App\Models\Category::has('rewrite')->get() as $category)
                    <li class="inline-block mr1">
                        <a href="{{ route('front', $category->rewrite->slug) }}">{{ $category->name }}</a>
                    </li>
                    @empty
                        
                    @endforelse
                </ul>
            </nav>
        </header>

        @yield('content', __('Please update me!'))
    </body>
</html>
