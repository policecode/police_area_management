<?php 
$currentUrl = getUrl(['page']);
/*
$page
$per_page
$total_records
*/
$max_page = ceil($total_records/$per_page);

$firstLink = ($page <= 1) ?'#':$currentUrl.'&page=1';
$lastLink = ($page >= $max_page) ? '#':$currentUrl.'&page='.$max_page;

$previousLink = false;
$nextLink = false;
if ($page > 1) {
    $previousLink = $currentUrl.'&page='.($page - 1);
}
if ($page < $max_page) {
    $nextLink = $currentUrl.'&page='.($page + 1);
}
$maxviewBtn = 5;
$before = 0;
$after = 0;
if ($page - 5 >= 1) {
    $before = $page - 5;
} else {
    $before = 1;
}
if ($page + 5 <= $max_page) {
    $after = $page + 5;
} else {
    $after = $max_page;
}
?>

<div class="pagination" style="justify-content: center;">
    <ul>
        <li class="pagination__arrow pagination__item @if ($page <= 1) disabled @endif">
            <a href="{{$firstLink}}" class="cursor-pointer text-decoration-none w-100 h-100 d-flex justify-content-center align-items-center">
                <<
            </a>
        </li>
        @for ($i = $before; $i <= $after; $i++)
            <li class="pagination__item  @if ($page == $i) page-current @endif">
                <a class="cursor-pointer page-link story-ajax-paginate" href="{{$currentUrl.'&page='.$i}}">{{$i}}</a>
            </li>
        @endfor

        <li class="pagination__arrow pagination__item @if($page >= $max_page) disabled @endif">
            <a href="{{$lastLink}}" class="cursor-pointer text-decoration-none w-100 h-100 d-flex justify-content-center align-items-center story-ajax-paginate">
                >>
            </a>
        </li>
    </ul>

</div>