<div class="navbar-bg"></div>

@include('admin.layouts.navbar')

<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">{{ __('admin_localize.Dashboard') }}</li>
            <li class="{{ setSidebarActive(['admin.dashboard']) }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>{{ __('admin_localize.Dashboard') }}</span></a>
            </li>


            <li class="menu-header">Starter</li>
            @if (canAccess(['category index']))
                <li class="{{ setSidebarActive(['admin.category.*']) }}"><a class="nav-link"
                        href="{{ route('admin.category.index') }}"><i class="fas fa-list"></i>
                        <span>{{ __('admin_localize.Category') }}</span></a></li>
            @endif

            @if (canAccess(['news index']))
                <li class="dropdown {{ setSidebarActive(['admin.news.*' , 'admin.pending-news']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fa fa-newspaper"></i> <span>{{ __('admin_localize.News') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.news.*']) }}"><a class="nav-link"
                                href="{{ route('admin.news.index') }}">{{ __('admin_localize.All News') }}</a></li>
                        <li class="{{ setSidebarActive(['admin.pending-news']) }}"><a class="nav-link"
                                href="{{ route('admin.pending-news') }}">{{ __('admin_localize.Pending News') }}</a></li>
                    </ul>
                </li>
            @endif

            @if (canAccess(['about index', 'contact index']))
                <li class="dropdown {{ setSidebarActive(['admin.about.index', 'admin.contact.index']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-file"></i>
                        <span>{{ __('admin_localize.Pages') }}</span></a>
                    <ul class="dropdown-menu">
                        @if (canAccess(['about index']))
                            <li class="{{ setSidebarActive(['admin.about.index']) }}"><a class="nav-link"
                                    href="{{ route('admin.about.index') }}">{{ __('admin_localize.About Page') }}</a></li>
                        @endif
                        @if (canAccess(['contact index']))
                            <li class="{{ setSidebarActive(['admin.contact.index']) }}"><a class="nav-link"
                                    href="{{ route('admin.contact.index') }}">{{ __('admin_localize.Contact Page') }}</a></li>
                        @endif
                    </ul>
                </li>
            @endif

            @if (canAccess(['contact message index']))
                <li class="{{ setSidebarActive(['admin.contact-message.*']) }}"><a
                        class="nav-link {{ $unReadMessages > 0 ? 'beep beep-sidebar' : '' }}"
                        href="{{ route('admin.contact-message.index') }}"><i class="fa fa-envelope"></i>
                        <span>{{ __('admin_localize.Contact Messages') }}</span>
            @endif
            </a></li>

            @if (canAccess(['social count index']))
                <li class="{{ setSidebarActive(['admin.social-count.*']) }}"><a class="nav-link"
                        href="{{ route('admin.social-count.index') }}"><i class="fa fa-share-alt"></i>
                        <span>{{ __('admin_localize.Social Count') }}</span></a></li>
            @endif
            @if (canAccess(['home section index']))
                <li class="{{ setSidebarActive(['admin.home-section-setting.*']) }}"><a class="nav-link"
                        href="{{ route('admin.home-section-setting.index') }}"><i class="fas fa-th-large"></i>
                        <span>{{ __('admin_localize.Home Section Setting') }}</span></a></li>
            @endif
            @if (canAccess(['advertisement index']))
                <li class="{{ setSidebarActive(['admin.advertisement.*']) }}"><a class="nav-link"
                        href="{{ route('admin.advertisement.index') }}"><i class="fas fa-ad"></i>
                        <span>{{ __('admin_localize.Advertisement') }}</span></a></li>
            @endif
            @if (canAccess(['language index']))
                <li class="{{ setSidebarActive(['admin.language.*']) }}"><a class="nav-link"
                        href="{{ route('admin.language.index') }}"><i class="fa fa-globe"></i>
                        <span>{{ __('admin_localize.Language') }}</span></a></li>
            @endif
            @if (canAccess(['footer index']))
                <li
                    class="dropdown {{ setSidebarActive(['admin.social-link.*', 'admin.footer-info.index', 'admin.footer-grid-one.*', 'admin.footer-grid-two.*', 'admin.footer-grid-three.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fa fa-info-circle"></i>
                        <span>Footer {{ __('admin_localize.Setting') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.social-link.*']) }}"><a class="nav-link"
                                href="{{ route('admin.social-link.index') }}">{{ __('admin_localize.Social Links') }}</a></li>
                        <li class="{{ setSidebarActive(['admin.footer-info.index']) }}"><a class="nav-link"
                                href="{{ route('admin.footer-info.index') }}">{{ __('admin_localize.Footer Info') }}</a></li>
                        <li class="{{ setSidebarActive(['admin.footer-grid-one.*']) }}"><a class="nav-link"
                                href="{{ route('admin.footer-grid-one.index') }}">{{ __('admin_localize.Footer Grid One') }}</a></li>
                        <li class="{{ setSidebarActive(['admin.footer-grid-two.*']) }}"><a class="nav-link"
                                href="{{ route('admin.footer-grid-two.index') }}">{{ __('admin_localize.Footer Grid Two') }}</a></li>
                        <li class="{{ setSidebarActive(['admin.footer-grid-three.*']) }}"><a class="nav-link"
                                href="{{ route('admin.footer-grid-three.index') }}">{{ __('admin_localize.Footer Grid Three') }}</a>
                        </li>

                    </ul>
                </li>
            @endif

            @if (canAccess(['access management index']))
                <li class="dropdown {{ setSidebarActive(['admin.role.*', 'admin.role-users.*']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-lock"></i>
                        <span>{{ __('admin_localize.Access Managment') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.role.*']) }}"><a class="nav-link"
                                href="{{ route('admin.role.index') }}">{{ __('admin_localize.Role And Permission') }}</a></li>
                        <li class="{{ setSidebarActive(['admin.role-users.*']) }}"><a class="nav-link"
                                href="{{ route('admin.role-users.index') }}">{{ __('admin_localize.Role Users') }}</a></li>

                    </ul>
                </li>
            @endif
            @if (canAccess(['setting index']))
                <li class="{{ setSidebarActive(['admin.setting.*']) }}"><a class="nav-link"
                        href="{{ route('admin.setting.index') }}"><i class="fa fa-cog"></i>
                        <span>{{ __('admin_localize.Setting') }}</span></a></li>
            @endif



                <li class="dropdown {{ setSidebarActive(['admin.admin-localization.index', 'admin.frontend-localization.index']) }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-language"></i>
                        <span>{{ __('admin_localize.Localization') }}</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setSidebarActive(['admin.admin-localization.index']) }}"><a class="nav-link"
                            href="{{ route('admin.admin-localization.index') }}">
                            <span>{{ __('admin_localize.Admin') }}</span></a></li>

                        <li class="{{ setSidebarActive(['admin.frontend-localization.index']) }}"><a class="nav-link"
                            href="{{ route('admin.frontend-localization.index') }}">
                            <span>{{ __('admin_localize.Frontend') }}</span></a></li>
                    </ul>
                </li>
        </ul>

    </aside>
</div>
