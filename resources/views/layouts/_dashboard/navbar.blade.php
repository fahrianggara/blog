<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="#">
        <!-- show app name -->
        {{ config('app.name') }}
    </a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="language" href="#" role="button" data-toggle="dropdown"
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
                {{ strtoupper(app()->getLocale()) }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="language">
                <a class="dropdown-item" href="{{ route('localization.switch', ['language' => 'id']) }}">
                    {{ trans('localization.id') }}
                </a>
                <a class="dropdown-item" href="{{ route('localization.switch', ['language' => 'en']) }}">
                    {{ trans('localization.en') }}
                </a>
            </div>

        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user fa-fw"></i>
                {{ Auth::user()->name }}
                <!-- show username -->
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">{{ trans('dashboard.link.profile') }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ trans('dashboard.link.logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
