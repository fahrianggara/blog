@extends('layouts.blog')

@section('title')
    {{ trans('blog.title.tags') }}
@endsection

@section('content')
    <h2 class="my-3">
        {{ trans('blog.title.tags') }}
    </h2>
    <!-- Breadcrumb:start -->
    {{ Breadcrumbs::render('tag_blog') }}
    <!-- Breadcrumb:end -->

    <!-- List tag -->
    <div class="row">
        <div class="col">
            @forelse ($tags as $tag)
                <a href="{{ route('blog.posts.tags', ['slug' => $tag->slug]) }}"
                    class=" badge badge-info py-3 px-5 mt-1">{{ $tag->title }}</a>
            @empty
                <!-- false -->
                <h3 class="text-center">
                    {{ trans('blog.no_data.tags') }}
                </h3>
            @endforelse
        </div>
    </div>
    <!-- List tag -->

    <!-- pagination:start -->
    @if ($tags->hasPages())
        <div class="row">
            <div class="col">
                {{ $tags->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    @endif
    <!-- pagination:end -->
@endsection
