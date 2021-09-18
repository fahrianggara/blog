@extends('layouts.blog')

@section('title')
    {{ trans('blog.title.tags') }}? {{ $tag->title }}
@endsection

@section('content')
    <!-- Title -->
    <h2 class="mt-4 mb-3">
        {{ trans('blog.title.tag', ['title' => $tag->title]) }} |
        {{ trans('blog.menu.result') }}: {{ count($posts) }}
    </h2>

    <!-- Breadcrumb:start -->
    {{ Breadcrumbs::render('posts_tag_blog', $tag->title) }}
    <!-- Breadcrumb:end -->
    <div class="row">
        <div class="col-lg-8">
            <!-- Post list:start -->
            @forelse ($posts as $post)
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <!-- thumbnail:start -->
                                @if (file_exists(public_path($post->thumbnail)))
                                    <!-- true -->
                                    <img class="card-img-top" src="{{ asset($post->thumbnail) }}"
                                        alt="{{ $post->title }}">
                                @else
                                    <!-- else -->
                                    <img class="img-fluid rounded" src="http://placehold.it/750x300"
                                        alt="{{ $post->title }}">
                                @endif
                                <!-- thumbnail:end -->
                            </div>
                            <div class="col-lg-6">
                                <h2 class="card-title">{{ $post->title }}</h2>
                                <p class="card-text">{{ $post->description }}</p>
                                <a href="{{ route('blog.posts.detail', ['slug' => $post->slug]) }}"
                                    class="btn btn-primary">
                                    {{ trans('blog.button.read_more.value') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- empty -->
                <h3 class="text-center">
                    {{ trans('blog.no_data.tags') }}
                </h3>
            @endforelse
            <!-- Post list:end -->
        </div>
        <div class="col-md-3">
            <!-- Tags list:start -->
            <div class="card mb-1">
                <h5 class="card-header">
                    {{ trans('blog.title.tags') }}
                </h5>
                <div class="card-body">
                    @foreach ($tags as $tag)
                        <a href="{{ route('blog.posts.tags', ['slug' => $tag->slug]) }}"
                            class="badge badge-info py-3 px-5 mt-1">{{ $tag->title }}</a>
                    @endforeach
                </div>
            </div>
            <!-- Categories list:end -->
        </div>
    </div>

    @if ($posts->hasPages())
        <div class="row">
            <div class="col">
                {{ $posts->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    @endif
@endsection

@push('css-internal')
    <style>
        #sticky-sidebar {
            position: fixed
        }

    </style>
@endpush
