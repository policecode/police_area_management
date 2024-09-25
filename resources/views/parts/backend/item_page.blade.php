<?php 
use Illuminate\Support\Facades\Route;
$routeName = Route::currentRouteName();
$show = strpos($routeName, 'admin.'.$page) !== false;
?>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item show__nav_item_{{$page}}" data-show="{{$show}}">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse_{{$page}}"
        aria-expanded="true" aria-controls="collapse_{{$page}}">
        <i class="{{$icon}}"></i>
        <span>{{$title}}</span>
    </a>
    <div id="collapse_{{$page}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item @if($routeName == 'admin.'.$page.'.index') active @endif" href="{{ route('admin.'.$page.'.index') }}">Danh sách</a>
            {{-- <a class="collapse-item @if($routeName == 'admin.'.$page.'.create') active @endif" href="{{ route('admin.'.$page.'.create') }}">Thêm mới</a> --}}
            @if ($child_route)
                @foreach ( $child_route as $route)
                    <a class="collapse-item @if($routeName == $route['page']) active @endif" href="{{ route($route['page']) }}">{{$route['title']}}</a>
                @endforeach
            @endif
        </div>
    </div>
</li>
<script>
    if (typeof showElement) {
        showElement = document.querySelector('.show__nav_item_{{$page}}');
        isShow = showElement.getAttribute('data-show');
    } else {
        let showElement = document.querySelector('.show__nav_item_{{$page}}');
        let isShow = showElement.getAttribute('data-show');
    }
    showElement.querySelectorAll('.collapse a').forEach(element => {
        if (element.classList.contains('active')) {
            showElement.querySelector('.collapsed').classList.remove('collapsed');
            showElement.querySelector('.collapse').classList.add('show');
            isShow = false;
        }
    });
    if (isShow) {
        showElement.querySelector('.collapsed').classList.remove('collapsed');
        showElement.querySelector('.collapse').classList.add('show');
        isShow = false;
    }
</script>