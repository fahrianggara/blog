<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('blog.home') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">

            <!-- Search for post:start -->
            <form class="input-group my-1" action="{{ route('blog.search') }}" method="GET">
                <input name="keyword" value="{{ request()->get('keyword') }}" type="search" class="form-control"
                    placeholder="{{ trans('blog.form_control.input.search.placeholder') }}">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
            <!-- Search for post:end -->

            <ul class="navbar-nav ml-auto">
                <!-- nav-home:start -->
                <li class="nav-item">
                    <a class="nav-link {{ set_active('blog.home') }}" href="{{ route('blog.home') }}">
                        {{ trans('blog.menu.home') }}
                    </a>
                </li>
                <!-- nav-home:end -->
                <!-- nav-categories:start -->
                <li class="nav-item">
                    <a class="nav-link {{ set_active(['blog.categories', 'blog.posts.categories']) }}"
                        href="{{ route('blog.categories') }}">
                        {{ trans('blog.menu.categories') }}
                    </a>
                </li>
                <!-- nav-categories:tags -->
                <li class="nav-item {{ set_active(['blog.tags', 'blog.posts.tags']) }}">
                    <a class="nav-link" href="{{ route('blog.tags') }}">
                        {{ trans('blog.menu.tags') }}
                    </a>
                </li>
                <!-- nav-tags:end -->

                <!-- lang:start -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        @switch(app()->getLocale())
                            @case('id')
                                <i class="flag-icon flag-icon-id"></i>
                            @break
                            @case('en')
                                <i class="flag-icon flag-icon-gb"></i>
                            @break
                            @default
                        @endswitch
                        {{-- {{ strtoupper(app()->getLocale()) }} --}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                        <a class="dropdown-item" href="{{ route('localization.switch', ['language' => 'id']) }}">
                            {{ trans('localization.id') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('localization.switch', ['language' => 'en']) }}">
                            {{ trans('localization.en') }}
                        </a>
                    </div>
                </li>
                <!-- lang:end -->
                <div style="border-left: 1px solid whitesmoke;
            height: 38px;"></div>
                @auth
                    <!-- Auth:start -->
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                            <a class="dropdown-item" target="_blank" href="{{ route('dashboard.index') }}">
                                {{ trans('blog.menu.dashboard') }}
                            </a>
                            <a class="dropdown-item" href=""
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ trans('blog.menu.logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>

                @else
                    <!-- Auth:else -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            {{ trans('blog.menu.login') }}
                        </a>
                    </li>
                    <!-- Auth:end -->
                @endauth
            </ul>
        </div>
    </div>
</nav>

@push('css-internal')
    <style>
        .v-hr {
            border-left: 6px solid gray;
            height: 500px;
        }

    </style>
@endpush
