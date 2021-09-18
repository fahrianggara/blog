@extends('layouts.blog')

@section('title')
    {{ $post->title }}
@endsection

@section('description')
    {{ $post->description }}
@endsection

@section('content')
    <!-- Title:start -->
    <h2 class="mt-4 mb-3">
        {{ $post->title }}
    </h2>
    <!-- Title:end -->

    <!-- Breadcrumb:Start -->
    {{ Breadcrumbs::render('post_detail', $post->title) }}
    <!-- Breadcrumb:end -->
    <div class="row">
        <!-- Post Content Column:start -->
        <div class="col-lg-8">
            <!-- thumbnail:start -->
            @if (file_exists(public_path($post->thumbnail)))
                <!-- true -->
                <img class="card-img-top" src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}">
            @else
                <!-- else -->
                <img class="img-fluid rounded" src="http://placehold.it/750x300" alt="{{ $post->title }}">
            @endif
            <!-- thumbnail:end -->
            <hr>
            <!-- Post Content:start -->
            <div>
                {!! $post->content !!}
            </div>
            <!-- Post Content:end -->
            <hr>
            @if (isset($prev))
                <a class="btn btn-info float-left mb-2" href="{{ url('/blog', [$prev->slug]) }}">
                    Prev
                </a>
            @endif
            @if (isset($next))
                <a class="btn btn-info float-right mb-2" href="{{ url('/blog', [$next->slug]) }}">
                    Next
                </a>
            @endif
        </div>

        <!-- Sidebar Widgets Column:start -->
        <div class="col-md-4">
            <!-- Categories Widget -->
            <div class="card mb-3">
                <h5 class="card-header">
                    {{ trans('blog.widget.categories') }}
                </h5>
                <div class="card-body">
                    <!-- category list:start -->
                    {{-- @foreach ($post->categories as $category)
                        <a href="{{ route('blog.posts.categories', ['slug' => $category->slug]) }}"
                            class="badge badge-primary py-2 mt-1">
                            {{ $category->title }}
                        </a>
                    @endforeach --}}
                    @foreach ($categories as $category)
                        <a href="{{ route('blog.posts.categories', ['slug' => $category->slug]) }}"
                            class=" badge badge-primary mt-1">
                            {{ $category->title }}
                        </a>
                    @endforeach
                    <!-- category list:end -->
                </div>
            </div>

            <!-- Side Widget tags:start -->
            <div class="card mb-3">
                <h5 class="card-header">
                    {{ trans('blog.widget.tags') }}
                </h5>
                <div class="card-body">
                    <!-- tag list:start -->
                    {{-- @foreach ($post->tags as $tag)
                        <a href="{{ route('blog.posts.tags', ['slug' => $tag->slug]) }}"
                            class="badge badge-info py-2  mt-1">
                            {{ $tag->title }}
                        </a>
                    @endforeach --}}
                    @foreach ($tags as $tag)
                        <a href="{{ route('blog.posts.tags', ['slug' => $tag->slug]) }}"
                            class=" badge badge-info  mt-1">{{ $tag->title }}</a>
                    @endforeach
                    <!-- tag list:end -->
                </div>
            </div>
            <!-- Side Widget tags:start -->
        </div>
        <!-- Sidebar Widgets Column:end -->
    </div>
@endsection
