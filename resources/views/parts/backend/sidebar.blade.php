
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-grin-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Quản lý
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @include('parts.backend.item_page', [
        'title' => 'Quản lý tài khoản',
        'page' => 'users',
        'icon' => 'fas fa-users',
    ])

    <!-- Nav Item - Pages Collapse Menu -->
    @include('parts.backend.item_page', [
        'title' => 'Quản lý danh mục',
        'page' => 'categories',
        'icon' => 'fas fa-users',
    ])
   
    <!-- Nav Item - Pages Collapse Menu -->
    @include('parts.backend.item_page', [
        'title' => 'Quản lý khóa học',
        'page' => 'courses',
        'icon' => 'fas fa-users',
    ])

    <!-- Nav Item - Pages Collapse Menu -->
    @include('parts.backend.item_page', [
        'title' => 'Quản lý giáo viên',
        'page' => 'teachers',
        'icon' => 'fas fa-users',
    ])

    <!-- Divider -->
    <hr class="sidebar-divider">

</ul>
