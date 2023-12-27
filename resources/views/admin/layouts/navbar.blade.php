<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">

                @if (Auth::guard('admin')->user()->image)
                    <img alt="image" src="{{ asset(env('ADMIN_PROFILE_IMAGE_UPLOAD_PATH') . Auth::guard('admin')->user()->image) }}"
                        class="rounded-circle mr-1">
                @else
                    <img alt="image" src="{{ asset('backend/assets/img/avatar/avatar-1.png') }}"
                        class="rounded-circle mr-1">
                @endif
                <div class="d-sm-none d-lg-inline-block">{{__('Hi')}}, {{Auth::guard('admin')->user()->name}}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.profile.index') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> {{__('Profile')}}
                </a>
                <a href="features-settings.html" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> {{__('Settings')}}
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <a href="#" class="dropdown-item has-icon text-danger"
                        onclick="event.preventDefault();
            this.closest('form').submit();">
                        <i class="fas fa-sign-out-alt"></i> {{__('Logout')}}
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>
