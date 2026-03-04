@php
    $headCategories = App\Models\Category::get();
@endphp

<!--================Header Menu Area =================-->
<header class="header_area">
    <div class="main_menu">
     <style>
    @media (min-width: 992px) {
        #center-links {
            position: absolute !important;
            left: 50% !important;
            transform: translateX(-50%) !important;
            width: max-content; 
            z-index: 9999 !important; 
        }
    }
</style>

        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container box_1620">
                <a class="navbar-brand logo_h" href="{{ route('theme.index') }}">
                    <img src="{{ asset('assets') }}/img/logo.png?v=2" alt="Bamaga Blog Logo"
                        style="max-height: 100px; width: auto;">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">

                    <ul id="center-links" class="nav navbar-nav menu_nav justify-content-center">
                        <li class="nav-item @yield('home-active')">
                            <a class="nav-link" href="{{ route('theme.index') }}">Home</a>
                        </li>
                        <li class="nav-item @yield('categories-active') submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">Categories</a>
                            @if (count($headCategories) > 0)
                                <ul class="dropdown-menu">
                                    @foreach ($headCategories as $category)
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ route('theme.category', ['id' => $category->id]) }}">{{ $category->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                        <li class="nav-item @yield('contact-active')">
                            <a class="nav-link" href="{{ route('theme.contact') }}">Contact</a>
                        </li>
                    </ul>

                    @if (Auth::check())
                        <a href="{{ route('blogs.create') }}" class="btn btn-sm btn-primary mr-2 ml-auto">Add New</a>
                    @endif

                    <ul
                        class="nav navbar-nav navbar-right navbar-social @if (!Auth::check()) ml-auto @endif">
                        @if (!Auth::check())
                            <a href="{{ route('register') }}" class="btn btn-sm btn-warning">Register / Login</a>
                        @else
                            <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('blogs.my-blogs') }}">My Blogs</a>
                                    </li>
                                    @if (Auth::user()->role === 'admin')
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('admin.dashboard') }}">My Dashboard</a>
                                        </li>
                                    @endif
                                    <li class="nav-item">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                        <a class="nav-link" href="#"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
<!--================Header Menu Area =================-->
