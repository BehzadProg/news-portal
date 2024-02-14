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
      <li class="menu-header">{{__('Dashboard')}}</li>
      <li class="{{setSidebarActive(['admin.dashboard'])}}">
        <a href="{{route('admin.dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>{{__('Dashboard')}}</span></a>
      </li>


      <li class="menu-header">Starter</li>

      <li class="{{setSidebarActive(['admin.category.*'])}}"><a class="nav-link" href="{{route('admin.category.index')}}"><i class="fas fa-list"></i> <span>{{__('Category')}}</span></a></li>

      <li class="dropdown {{setSidebarActive(['admin.news.*'])}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-newspaper"></i> <span>{{__('News')}}</span></a>
        <ul class="dropdown-menu">
          <li class="{{setSidebarActive(['admin.news.*'])}}"><a class="nav-link" href="{{route('admin.news.index')}}">All {{__('News')}}</a></li>

        </ul>
      </li>

      <li class="{{setSidebarActive(['admin.social-count.*'])}}"><a class="nav-link" href="{{route('admin.social-count.index')}}"><i class="fa fa-share-alt"></i> <span>Social {{__('Count')}}</span></a></li>

      <li class="{{setSidebarActive(['admin.home-section-setting.*'])}}"><a class="nav-link" href="{{route('admin.home-section-setting.index')}}"><i class="fas fa-th-large"></i> <span>Home Section {{__('Setting')}}</span></a></li>

      <li class="{{setSidebarActive(['admin.advertisement.*'])}}"><a class="nav-link" href="{{route('admin.advertisement.index')}}"><i class="fas fa-ad"></i> <span>{{__('Advertisement')}}</span></a></li>

      <li class="{{setSidebarActive(['admin.language.*'])}}"><a class="nav-link" href="{{route('admin.language.index')}}"><i class="fa fa-globe"></i> <span>{{__('Language')}}</span></a></li>

      <li class="dropdown {{setSidebarActive(['admin.social-link.*' , 'admin.footer-info.index' , 'admin.footer-grid-one.*' , 'admin.footer-grid-two.*' , 'admin.footer-grid-three.*'])}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fa fa-info-circle"></i> <span>Footer {{__('Setting')}}</span></a>
        <ul class="dropdown-menu">
          <li class="{{setSidebarActive(['admin.social-link.*'])}}"><a class="nav-link" href="{{route('admin.social-link.index')}}">{{__('Social Links')}}</a></li>
          <li class="{{setSidebarActive(['admin.footer-info.index'])}}"><a class="nav-link" href="{{route('admin.footer-info.index')}}">{{__('Footer Info')}}</a></li>
          <li class="{{setSidebarActive(['admin.footer-grid-one.*'])}}"><a class="nav-link" href="{{route('admin.footer-grid-one.index')}}">{{__('Footer Grid One')}}</a></li>
          <li class="{{setSidebarActive(['admin.footer-grid-two.*'])}}"><a class="nav-link" href="{{route('admin.footer-grid-two.index')}}">{{__('Footer Grid Two')}}</a></li>
          <li class="{{setSidebarActive(['admin.footer-grid-three.*'])}}"><a class="nav-link" href="{{route('admin.footer-grid-three.index')}}">{{__('Footer Grid Three')}}</a></li>

        </ul>
      </li>

      <li class="dropdown {{setSidebarActive(['admin.role.*' , 'admin.role-users.*'])}}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-lock"></i> <span>{{__('Access Managment')}}</span></a>
        <ul class="dropdown-menu">
          <li class="{{setSidebarActive(['admin.role.*'])}}"><a class="nav-link" href="{{route('admin.role.index')}}">{{__('Role And Permission')}}</a></li>
          <li class="{{setSidebarActive(['admin.role-users.*'])}}"><a class="nav-link" href="{{route('admin.role-users.index')}}">{{__('Role Users')}}</a></li>

        </ul>
      </li>


      {{-- <li class="menu-header">Starter</li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
          <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
          <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
        </ul>
      </li> --}}

      {{-- <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li> --}}


    </ul>

</aside>
</div>
