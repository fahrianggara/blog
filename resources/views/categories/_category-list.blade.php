@foreach ($categories as $cate)

    <!-- category list -->
    <li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center pr-0">
        <label class="mt-auto mb-auto">
            <!-- todo: show category title -->
            {{ str_repeat('-', $count) . ' ' . $cate->title }}
        </label>
        <div>
            <!-- detail -->
            @can('category_detail')
                <a href="{{ route('categories.show', ['category' => $cate]) }}" class="btn btn-sm btn-primary"
                    role="button">
                    <i class="fas fa-eye"></i>
                </a>
            @endcan
            <!-- edit -->
            @can('category_update')
                <a href="{{ route('categories.edit', ['category' => $cate]) }}" class="btn btn-sm btn-info" role="button">
                    <i class="fas fa-edit"></i>
                </a>
            @endcan
            <!-- delete -->
            @can('category_delete')
                <form class="d-inline" action="{{ route('categories.destroy', ['category' => $cate]) }}" role="alert"
                    method="POST" alert-title="{{ trans('categories.alert.delete.title.warning') }}"
                    alert-text="{{ trans('categories.alert.delete.message.confirm', ['title' => $cate->title]) }}"
                    btn-cancel="{{ trans('categories.button.cancel.value') }}"
                    btn-confirm="{{ trans('categories.button.delete.value') }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            @endcan
        </div>
        <!-- todo:show subcategory -->
        @if ($cate->generation && !trim(request()->get('keyword')))
            @include('categories._category-list', [
            'categories' => $cate->generation,
            'count' => $count + 1
            ])
        @endif
    </li>
    <!-- end  category list -->

@endforeach
