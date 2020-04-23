<!doctype html>
<html amp lang="en">
    <head>
        <meta charset="utf-8">
        <script async src="https://cdn.ampproject.org/v0.js"></script>
        <title>@yield('meta_title', 'Admin Area')</title>
        <link rel="canonical" href="https://amp.dev/documentation/guides-and-tutorials/start/create/basic_markup/">
        <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
        <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
        @section('amp-components')
            
        @show
    </head>
    <body>
        <nav>
            <ul>
                <li><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
                <li><a href="{{ route('admin.users.index') }}">{{ __('Users') }}</a></li>
                <li><a href="{{ route('admin.entityTypes.index') }}">{{ __('Entity Types') }}</a></li>
                <li><a href="{{ route('admin.attributes.index') }}">{{ __('Attributes') }}</a></li>
                <li><a href="{{ route('admin.eavDecimals.index') }}">{{ __('EAVDecimals') }}</a></li>
                <li><a href="{{ route('admin.eavIntegers.index') }}">{{ __('EAVIntegers') }}</a></li>
                <li><a href="{{ route('admin.eavStrings.index') }}">{{ __('EAVStrings') }}</a></li>
                <li><a href="{{ route('admin.eavTexts.index') }}">{{ __('EAVTexts') }}</a></li>
                <li><a href="{{ route('admin.products.index') }}">{{ __('Products') }}</a></li>
            </ul>
        </nav>
        @yield('content', __('Please update me!'))
    </body>
</html>
