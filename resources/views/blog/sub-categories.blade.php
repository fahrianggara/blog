<ul>
    @foreach ($categoryRoot as $item)
        <li>
            @if ($category->slug == $item->slug)
                {{ $item->title }}
            @else
                <a href="{{ route('blog.posts.categories', ['slug' => $item->slug]) }}">
                    {{ $item->title }}
                </a>
            @endif
            @if ($item->generation)
                @include('blog.sub-categories', [
                'categoryRoot' => $item->generation,
                'category' => $category,
                ])
            @endif
        </li>
    @endforeach
</ul>
