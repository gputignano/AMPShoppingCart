<!doctype html>
<html amp lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="preconnect" href="https://cdn.ampproject.org">
        <script async src="https://cdn.ampproject.org/v0.js"></script>
        <title>@yield('meta_title', 'Default Title')</title>
        <meta name="description" content="@yield('meta_description', 'Default Meta Description')">
        <link rel="canonical" href="{{ url()->current() }}">
        <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
        <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
        {{-- <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto"> --}}

        @section('amp-custom-style')
            @include('front.layouts.styles')
        @show

        @section('amp-components')
            <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
            {{-- <script async custom-element="amp-mega-menu" src="https://cdn.ampproject.org/v0/amp-mega-menu-0.1.js"></script> --}}
        @show

    </head>
    <body>
        {{-- https://github.com/ampproject/amphtml/blob/master/examples/amp-sidebar-autoscroll.amp.html --}}
        <amp-sidebar id="sidebar" layout="nodisplay">
            <nav toolbar="(min-width: 767px)" toolbar-target="desktop-sidebar">
                <ul class="nav-container">
                    <li><a href="{{ route('front', '/') }}">{{ __('Home Page') }}</a></li>

                    @foreach (App\Models\Category::has('rewrite')->get() as $category)
                    <li>
                        <a href="{{ route('front', $category->rewrite->slug) }}">{{ $category->name }}</a>
                    </li>
                    @endforeach
        
                    <li>
                        <a href="{{ route('cart.index') }}">{{ __('Cart') }}</a>
                    </li>
                </ul>
            </nav>
        </amp-sidebar>
        
        <header class="flex">
            <button class="hamburger mr1" on='tap:sidebar.toggle' aria-label="Click to open sidebar">=</button>
            <h2 class="m0">Header</h2>
        </header>
        
        <main>
            <article>
                @yield('content', __('Please update me!'))
            </article>

            <aside id="desktop-sidebar"></aside>
        </main>
    </body>
</html>
