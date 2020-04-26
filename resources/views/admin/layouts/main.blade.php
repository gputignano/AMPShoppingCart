<!doctype html>
<html amp lang="en">
    <head>
        <meta charset="utf-8">
        <script async src="https://cdn.ampproject.org/v0.js"></script>
        <title>@yield('meta_title', 'Admin Area')</title>
        <link rel="canonical" href="https://amp.dev/documentation/guides-and-tutorials/start/create/basic_markup/">
        <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
        <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto">

        @section('amp-custom-style')
            @include('admin.layouts.styles')
        @show

        @section('amp-components')
            <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
            <script async custom-element="amp-mega-menu" src="https://cdn.ampproject.org/v0/amp-mega-menu-0.1.js"></script>
        @show

    </head>
    <body>
        <amp-sidebar id="sidebar" layout="nodisplay" side="left">
            <amp-nested-menu layout="fill">
                <ul>
                    <li>
                        <li><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
                    </li>
                    <li>
                        <h4 amp-nested-submenu-open>{{ __('Users') }}</h4>
                        <div amp-nested-submenu>
                            <ul>
                                <li>
                                    <h4 amp-nested-submenu-close>{{ __('Back') }}</h4>
                                </li>
                                <li><a href="{{ route('admin.users.index') }}">{{ __('All Users') }}</a></li>
                                <li><a href="{{ route('admin.users.create') }}">{{ __('Create User') }}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <h4 amp-nested-submenu-open>{{ __('Entity Types') }}</h4>
                        <div amp-nested-submenu>
                            <ul>
                                <li>
                                    <h4 amp-nested-submenu-close>{{ __('Back') }}</h4>
                                </li>
                                <li><a href="{{ route('admin.entityTypes.index') }}">{{ __('All Entity Types') }}</a></li>
                                <li><a href="{{ route('admin.entityTypes.create') }}">{{ __('Create Entity Type') }}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <h4 amp-nested-submenu-open>{{ __('Attributes') }}</h4>
                        <div amp-nested-submenu>
                            <ul>
                                <li>
                                    <h4 amp-nested-submenu-close>{{ __('Back') }}</h4>
                                </li>
                                <li><a href="{{ route('admin.attributes.index') }}">{{ __('All Attributes') }}</a></li>
                                <li><a href="{{ route('admin.attributes.create') }}">{{ __('Create Attribute') }}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <h4 amp-nested-submenu-open>{{ __('EAVDecimals') }}</h4>
                        <div amp-nested-submenu>
                            <ul>
                                <li>
                                    <h4 amp-nested-submenu-close>{{ __('Back') }}</h4>
                                </li>
                                <li><a href="{{ route('admin.eavDecimals.index') }}">{{ __('All EAVDecimals') }}</a></li>
                                <li><a href="{{ route('admin.eavDecimals.create') }}">{{ __('Create EAVDecimal') }}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <h4 amp-nested-submenu-open>{{ __('EAVIntegers') }}</h4>
                        <div amp-nested-submenu>
                            <ul>
                                <li>
                                    <h4 amp-nested-submenu-close>{{ __('Back') }}</h4>
                                </li>
                                <li><a href="{{ route('admin.eavIntegers.index') }}">{{ __('All EAVIntegers') }}</a></li>
                                <li><a href="{{ route('admin.eavIntegers.create') }}">{{ __('Create EAVInteger') }}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <h4 amp-nested-submenu-open>{{ __('EAVStrings') }}</h4>
                        <div amp-nested-submenu>
                            <ul>
                                <li>
                                    <h4 amp-nested-submenu-close>{{ __('Back') }}</h4>
                                </li>
                                <li><a href="{{ route('admin.eavStrings.index') }}">{{ __('All EAVStrings') }}</a></li>
                                <li><a href="{{ route('admin.eavStrings.create') }}">{{ __('Create EAVString') }}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <h4 amp-nested-submenu-open>{{ __('EAVTexts') }}</h4>
                        <div amp-nested-submenu>
                            <ul>
                                <li>
                                    <h4 amp-nested-submenu-close>{{ __('Back') }}</h4>
                                </li>
                                <li><a href="{{ route('admin.eavTexts.index') }}">{{ __('All EAVTexts') }}</a></li>
                                <li><a href="{{ route('admin.eavTexts.create') }}">{{ __('Create EAVText') }}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <h4 amp-nested-submenu-open>{{ __('Products') }}</h4>
                        <div amp-nested-submenu>
                            <ul>
                                <li>
                                    <h4 amp-nested-submenu-close>{{ __('Back') }}</h4>
                                </li>
                                <li><a href="{{ route('admin.products.index') }}">{{ __('All Products') }}</a></li>
                                <li><a href="{{ route('admin.products.create') }}">{{ __('Create Product') }}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <h4 amp-nested-submenu-open>{{ __('Pages') }}</h4>
                        <div amp-nested-submenu>
                            <ul>
                                <li>
                                    <h4 amp-nested-submenu-close>{{ __('Back') }}</h4>
                                </li>
                                <li><a href="{{ route('admin.pages.index') }}">{{ __('All Pages') }}</a></li>
                                <li><a href="{{ route('admin.pages.create') }}">{{ __('Create Page') }}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <h4 amp-nested-submenu-open>{{ __('Categories') }}</h4>
                        <div amp-nested-submenu>
                            <ul>
                                <li>
                                    <h4 amp-nested-submenu-close>{{ __('Back') }}</h4>
                                </li>
                                <li><a href="{{ route('admin.categories.index') }}">{{ __('All Categories') }}</a></li>
                                <li><a href="{{ route('admin.categories.create') }}">{{ __('Create Category') }}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <h4 amp-nested-submenu-open>{{ __('Rewrites') }}</h4>
                        <div amp-nested-submenu>
                            <ul>
                                <li>
                                    <h4 amp-nested-submenu-close>{{ __('Back') }}</h4>
                                </li>
                                <li><a href="{{ route('admin.rewrites.index') }}">{{ __('All Rewrites') }}</a></li>
                                <li><a href="{{ route('admin.rewrites.create') }}">{{ __('Create Rewrite') }}</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <h4 amp-nested-submenu-open>{{ __('Orders') }}</h4>
                        <div amp-nested-submenu>
                            <ul>
                                <li>
                                    <h4 amp-nested-submenu-close>{{ __('Back') }}</h4>
                                </li>
                                <li><a href="{{ route('admin.orders.index') }}">{{ __('All Orders') }}</a></li>
                                <li><a href="{{ route('admin.orders.create') }}">{{ __('Create Order') }}</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </amp-nested-menu>
        </amp-sidebar>

        <header>
            <button id="sidebar-open-btn" on="tap:sidebar.toggle">{{ __('Menu') }}</button>
            <amp-mega-menu id="mega-menu" height="30" layout="fixed-height">
                <nav>
                    <ul>
                        <li><a href="{{ route('admin.home') }}">{{ __('Home') }}</a></li>
                        <li>
                            <span role="button">{{ __('Users') }}</span>
                            <div role="dialog">
                                <ul>
                                    <li><a href="{{ route('admin.users.index') }}">{{ __('All Users') }}</a></li>
                                    <li><a href="{{ route('admin.users.create') }}">{{ __('Create User') }}</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <span role="button">{{ __('Entity Type') }}</span>
                            <div role="dialog">
                                <ul>
                                    <li><a href="{{ route('admin.entityTypes.index') }}">{{ __('All Entity Types') }}</a></li>
                                    <li><a href="{{ route('admin.entityTypes.create') }}">{{ __('Create Entity Type') }}</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <span role="button">{{ __('Attributes') }}</span>
                            <div role="dialog">
                                <ul>
                                    <li><a href="{{ route('admin.attributes.index') }}">{{ __('All Attributes') }}</a></li>
                                    <li><a href="{{ route('admin.attributes.create') }}">{{ __('Create Attribute') }}</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <span role="button">{{ __('EAVDecimals') }}</span>
                            <div role="dialog">
                                <ul>
                                    <li><a href="{{ route('admin.eavDecimals.index') }}">{{ __('All EAVDecimals') }}</a></li>
                                    <li><a href="{{ route('admin.eavDecimals.create') }}">{{ __('Create EAVDecimal') }}</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <span role="button">{{ __('EAVIntegers') }}</span>
                            <div role="dialog">
                                <ul>
                                    <li><a href="{{ route('admin.eavIntegers.index') }}">{{ __('All EAVIntegers') }}</a></li>
                                    <li><a href="{{ route('admin.eavIntegers.create') }}">{{ __('Create EAVInteger') }}</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <span role="button">{{ __('EAVStrings') }}</span>
                            <div role="dialog">
                                <ul>
                                    <li><a href="{{ route('admin.eavStrings.index') }}">{{ __('All EAVStrings') }}</a></li>
                                    <li><a href="{{ route('admin.eavStrings.create') }}">{{ __('Create EAVString') }}</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <span role="button">{{ __('EAVTexts') }}</span>
                            <div role="dialog">
                                <ul>
                                    <li><a href="{{ route('admin.eavTexts.index') }}">{{ __('All EAVTexts') }}</a></li>
                                    <li><a href="{{ route('admin.eavTexts.create') }}">{{ __('Create EAVText') }}</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <span role="button">{{ __('Products') }}</span>
                            <div role="dialog">
                                <ul>
                                    <li><a href="{{ route('admin.products.index') }}">{{ __('All Products') }}</a></li>
                                    <li><a href="{{ route('admin.products.create') }}">{{ __('Create Product') }}</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <span role="button">{{ __('Pages') }}</span>
                            <div role="dialog">
                                <ul>
                                    <li><a href="{{ route('admin.pages.index') }}">{{ __('All Pages') }}</a></li>
                                    <li><a href="{{ route('admin.pages.create') }}">{{ __('Create Page') }}</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <span role="button">{{ __('Categories') }}</span>
                            <div role="dialog">
                                <ul>
                                    <li><a href="{{ route('admin.categories.index') }}">{{ __('All Categories') }}</a></li>
                                    <li><a href="{{ route('admin.categories.create') }}">{{ __('Create Categorie') }}</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <span role="button">{{ __('Rewrites') }}</span>
                            <div role="dialog">
                                <ul>
                                    <li><a href="{{ route('admin.rewrites.index') }}">{{ __('All Rewrites') }}</a></li>
                                    <li><a href="{{ route('admin.rewrites.create') }}">{{ __('Create Rewrite') }}</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <span role="button">{{ __('Orders') }}</span>
                            <div role="dialog">
                                <ul>
                                    <li><a href="{{ route('admin.orders.index') }}">{{ __('All Orders') }}</a></li>
                                    <li><a href="{{ route('admin.orders.create') }}">{{ __('Create Order') }}</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </amp-mega-menu>
        </header>

        @yield('content', __('Please update me!'))
    </body>
</html>
