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
        'child_route' => [],
    ])
    @include('parts.backend.item_page', [
        'title' => 'Quản lý truyện',
        'page' => 'stories',
        'icon' => 'fa-solid fa-book',
        'child_route' => [
            [ 'page' => 'admin.author.index', 'title' => 'Danh sách tác giả'],
            [ 'page' => 'admin.category.index', 'title' => 'Thể loại truyện'],
        ],
    ])
     @include('parts.backend.item_page', [
        'title' => 'Cài đặt',
        'page' => 'setting',
        'icon' => 'fa-solid fa-gear',
        'child_route' => [
        ],
    ])
    <!-- Nav Item - Pages Collapse Menu -->
    {{-- @include('parts.backend.item_page', [
        'title' => 'Quản lý doanh nghiệp',
        'page' => 'companies',
        'icon' => 'far fa-building',
        'child_route' => array()

    ]) --}}

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- @include('parts.backend.item_page', [
        'title' => 'Địa điểm kinh doanh',
        'page' => 'businesses',
        'icon' => 'fas fa-business-time',
        'child_route' => array(
            [ 'page' => 'admin.users.index', 'title' => 'Danh sách User'],
            [ 'page' => 'admin.users.create',  'title' => 'Thêm mới user']
        )
    ]) --}}

    <!-- Nav Item - Pages Collapse Menu -->
    {{-- @include('parts.backend.item_page', [
        'title' => 'Người nước ngoài',
        'page' => 'tourists',
        'icon' => 'fa-solid fa-person',
        'child_route' => array(
            [ 'page' => 'admin.users.index', 'title' => 'Danh sách User'],
            [ 'page' => 'admin.users.create',  'title' => 'Thêm mới user']
        )
    ]) --}}
    <!-- Divider -->
    <hr class="sidebar-divider">

</ul>
