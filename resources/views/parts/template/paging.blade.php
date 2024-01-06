<?php 
$currentUrl = getUrl(['page']);
/*
$page
$per_page
$total_records
*/
$max_page = ceil($total_records/$per_page);

$previousLink = false;
$nextLink = false;

if ($page > 1) {
    $previousLink = $currentUrl.'&page='.($page - 1);
}
if ($page < $max_page) {
    $nextLink = $currentUrl.'&page='.($page + 1);
}
?>
<div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
    <ul class="pagination">
        <li class="paginate_button page-item previous @if (!$previousLink) disabled @endif " id="dataTable_previous">
            <a href="{{$previousLink}}" aria-controls="dataTable" data-dt-idx="0" tabindex="0"
                class="page-link">Previous</a>
        </li>
        @for ($i = 1; $i <= $max_page; $i++)
            <li class="paginate_button page-item @if ($page == $i) active @endif ">
                <a href="{{$currentUrl.'&page='.$i}}" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">{{$i}}</a>
            </li>
        @endfor
     
        <li class="paginate_button page-item next @if (!$nextLink) disabled @endif" id="dataTable_next">
            <a href="{{$nextLink}}" aria-controls="dataTable"
                data-dt-idx="7" tabindex="0" class="page-link">Next</a>
            </li>
    </ul>
</div>