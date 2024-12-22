<?php
$currentUrl = getUrl(['page']);
/*
$page
$per_page
$total_records
*/
$max_page = ceil($total_records / $per_page);

// $firstLink = ($page <= 1) ?'#':$currentUrl.'&page=1';
// $lastLink = ($page >= $max_page) ? '#':$currentUrl.'&page='.$max_page;

$previousLink = false;
$nextLink = false;
if ($page > 1) {
    $previousLink = $currentUrl . '&page=' . ($page - 1);
}
if ($page < $max_page) {
    $nextLink = $currentUrl . '&page=' . ($page + 1);
}
$maxviewBtn = 4;
$before = 0;
$after = 0;
if ($page - $maxviewBtn >= 1) {
    $before = $page - $maxviewBtn;
} else {
    $before = 1;
}
if ($page + $maxviewBtn <= $max_page) {
    $after = $page + $maxviewBtn;
} else {
    $after = $max_page;
}
$isLastPage = true;
if ($after + 2 >= $max_page) {
    $isLastPage = false;
}
$isPrevPage = true;
if ($before - 2 <= 1) {
    $isPrevPage = false;
}
?>
<div class="pagination">
    @if ($previousLink)
        <a class="next-page !px-4" href="$previousLink" title="Trước">Trước</a>
    @endif
    @if ($isPrevPage)
        <a href="{{ $currentUrl . '&page=1' }}">1</a>
        <a href="{{ $currentUrl . '&page=2' }}">2</a>
        <a style="pointer-events: none"> ... </a>
    @endif
    @for ($i = $before; $i <= $after; $i++)
        @if ($page == $i)
            <strong>{{ $i }}</strong>
        @else
            <a href="{{ $currentUrl . '&page=' . $i }}">{{ $i }}</a>
        @endif
    @endfor
    @if ($isLastPage)
        <a style="pointer-events: none"> ... </a>
        <a href="{{ $currentUrl . '&page=' . ($max_page - 1) }}">{{ $max_page - 1 }}</a>
        <a href="{{ $currentUrl . '&page=' . $max_page }}">{{ $max_page }}</a>
    @endif
    @if ($nextLink)
        <a class="next-page !px-4" href="$nextLink" title="Sau">Sau</a>
    @endif
    <div class="jum-box" data-lastpage="26" data-ajax="0" data-url="{{ $currentUrl }}">
        <input type="text" name="page" placeholder="Số trang">
        <button type="button">Go</button>
    </div>
</div>
