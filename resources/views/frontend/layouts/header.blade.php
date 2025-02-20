@php
    $languages = \App\Models\Language::where('status', 1)->get();
    $featuredCategories = \App\Models\Category::where([
        'status' => 1,
        'show_at_nav' => 1,
        'language' => getLanguage(),
    ])->get();
    $categories = \App\Models\Category::where(['status' => 1, 'show_at_nav' => 0, 'language' => getLanguage()])->get();
@endphp

<header class="bg-light">
    <!-- Navbar  Top-->
    <div class="topbar d-none d-sm-block">
        <div class="container ">
            <div class="row">
                <div class="col-sm-6 col-md-8">
                    <div class="topbar-left topbar-right d-flex">

                        <ul class="topbar-sosmed p-0">
                            @foreach ($socialLinks as $socialLink)
                                <li>
                                    <a href="{{ $socialLink->url }}"><i class="{{ $socialLink->icon }}"></i></a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="topbar-text">
                            {{ date('l, F j, Y') }}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="list-unstyled topbar-right d-flex align-items-center justify-content-end">
                        <div class="topbar_language">
                            <select id="site-language">
                                @foreach ($languages as $language)
                                    <option {{ $language->lang === getLanguage() ? 'selected' : '' }}
                                        value="{{ $language->lang }}">{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <ul class="topbar-link">
                            @auth
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();this.closest('form').submit();">
                                        {{ __('frontend_localize.Logout') }}
                                    </a>
                                </form>
                            @else
                                <li><a href="{{ route('login') }}">{{ __('frontend_localize.Login') }}</a></li>
                                <li><a href="{{ route('register') }}">{{ __('frontend_localize.Register') }}</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Navbar Top  -->


    <!-- Navbar  -->
    <!-- Navbar menu  -->
    <div class="navigation-wrap navigation-shadow bg-white">
        <nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
            <div class="container">
                <div class="offcanvas-header">
                    <div data-toggle="modal" data-target="#modal_aside_right" class="btn-md">
                        <span class="navbar-toggler-icon"></span>
                    </div>
                </div>
                <figure class="mb-0 mx-auto">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset(env('SITE_LOGO_IMAGE_UPLOAD_PATH') . $settings['site_logo']) }}"
                            alt="" class="img-fluid logo">
                    </a>
                </figure>

                <div class="collapse navbar-collapse justify-content-between" id="main_nav99">
                    <ul class="navbar-nav ml-auto ">
                        @foreach ($featuredCategories as $category)
                            @if ($loop->index <= 3)
                                <li class="nav-item dropdown has-megamenu">
                                    <a class="nav-link"
                                        href="{{ route('news', ['category' => $category->slug]) }}">{{ $category->name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                        @if (count($categories) > 0)

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                                    {{ __('frontend_localize.More') }} </a>
                                <ul class="dropdown-menu animate fade-up">
                                    @foreach ($categories as $cat)
                                        <li><a class="dropdown-item"
                                                href="{{ route('news', ['category' => $cat->slug]) }}">
                                                {{ $cat->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link active"
                                href="{{ url('/') }}">{{ __('frontend_localize.home') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('about.index') }}"> {{ __('frontend_localize.about') }}
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('contact.index') }}">
                                {{ __('frontend_localize.Contact') }} </a></li>
                    </ul>


                    <!-- Search bar.// -->
                    <ul class="navbar-nav ">
                        <li class="nav-item search hidden-xs hidden-sm ">
                            <a class="nav-link" href="#">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                    </ul>

                    <!-- Search content bar.// -->
                    <div class="top-search navigation-shadow">
                        <div class="container">
                            <div class="input-group ">
                                <form action="{{ route('news') }}" method="GET">

                                    <div class="row no-gutters mt-3">
                                        <div class="col">
                                            <input class="form-control border-secondary border-right-0 rounded-0"
                                                type="search" value="" placeholder="Search "
                                                id="example-search-input4" name="search">
                                        </div>
                                        <div class="col-auto">

                                            <button type="submit"
                                                class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right"><i
                                                    class="fa fa-search"></i></button>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Search content bar.// -->
                </div> <!-- navbar-collapse.// -->
            </div>
        </nav>
    </div>
    <!-- End Navbar menu  -->


    <!-- Navbar sidebar menu  -->
    <div id="modal_aside_right" class="modal fixed-left fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-aside" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="widget__form-search-bar  ">
                        <form action="{{ route('news') }}" method="GET">
                            <div class="row no-gutters">
                                <div class="col">
                                    <input class="form-control border-secondary border-right-0 rounded-0" value=""
                                        placeholder="Search" name="search">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <nav class="list-group list-group-flush">
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <a class="nav-link active text-dark" href="{{ url('/') }}">
                                    {{ __('frontend_localize.Home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark" href="{{ route('about.index') }}">
                                    {{ __('frontend_localize.About') }} </a>
                            </li>
                            <li class="nav-item"><a class="nav-link  text-dark" href="{{ route('contact.index') }}">
                                    {{ __('frontend_localize.Contact') }} </a>
                            </li>
                            @foreach ($featuredCategories as $category)
                            @if ($loop->index <= 5)
                                <li class="nav-item">
                                    <a class="nav-link text-dark"
                                        href="{{ route('news', ['category' => $category->slug]) }}">{{ $category->name }}
                                    </a>
                                </li>
                            @endif
                        @endforeach


                            @if (count($categories) > 0)
                                <li class="nav-item">
                                    <a class="nav-link active dropdown-toggle  text-dark" href="#"
                                        data-toggle="dropdown">{{ __('frontend_localize.More') }} </a>
                                    <ul class="dropdown-menu dropdown-menu-left">
                                        @foreach ($categories as $cat)
                                            <li><a class="dropdown-item"
                                                    href="{{ route('news', ['category' => $cat->slug]) }}">
                                                    {{ $cat->name }}</a></li>
                                        @endforeach

                                    </ul>
                                </li>
                            @endif

                        </ul>

                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
