<header>
    <div class="flex h2">
        <div class="m1">&#9776;</div>
        <div class="m1">
            <nav>
                <ul class="flex list-reset my0">
                    <li class="inline-block mr1">
                        <a href="{{ route('front', '/') }}">{{ __('Home Page') }}</a>
                    </li>
                    @forelse (App\Models\Category::has('rewrite')->get() as $category)
                    <li class="inline-block mr1">
                        <a href="{{ route('front', $category->rewrite->slug) }}">{{ $category->name }}</a>
                    </li>
                    @empty
                        
                    @endforelse
        
                    <li class="inline-block mr1">
                        <a href="{{ route('cart.index') }}">{{ __('Cart') }}</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
