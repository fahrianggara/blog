<ul class="pl-1 my-1" style="list-style: none;">
    @foreach ($categories as $cate)
        <li class="form-group form-check my-1">
            @if ($cateChecked && in_array($cate->id, $cateChecked))
                <input class="form-check-input" value="{{ $cate->id }}" type="checkbox" name="category[]" checked>
            @else
                <input class="form-check-input" value="{{ $cate->id }}" type="checkbox" name="category[]">
            @endif

            <label class="form-check-label">
                {{ $cate->title }}
            </label>

            @if ($cate->generation)
                @include('posts._category-list', [
                'categories' => $cate->generation,
                'cateChecked' => $cateChecked
                ])
            @endif
        </li>
    @endforeach
</ul>
