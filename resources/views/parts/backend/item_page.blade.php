<?php 
use Illuminate\Support\Facades\Route;
$routeName = Route::currentRouteName();
$show = strpos($routeName, 'admin.'.$page) !== false;
?>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link @if(!$show) collapsed @endif" href="#" data-toggle="collapse" data-target="#collapse_{{$page}}"
        aria-expanded="true" aria-controls="collapse_{{$page}}">
        <i class="{{$icon}}"></i>
        <span>{{$title}}</span>
    </a>
    <div id="collapse_{{$page}}" class="collapse @if($show) show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item @if($routeName == 'admin.'.$page.'.index') active @endif" href="{{ route('admin.'.$page.'.index') }}">Danh sách</a>
            <a class="collapse-item @if($routeName == 'admin.'.$page.'.create') active @endif" href="{{ route('admin.'.$page.'.create') }}">Thêm mới</a>
        </div>
    </div>
</li>