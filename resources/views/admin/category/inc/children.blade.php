<ul>
    @foreach ($subCategories as $category)
        <li>
            <a href="{{ route('admin.categories.show', $category) }}">{{ $category->name }}</a>

            @if ($category->count())
                @include('admin.category.inc.children', ['subCategories' => $category->children])
            @endif
        </li>
    @endforeach
</ul>
