<?php 
$currentUrl = getUrl(['page']);
/*
$page
$per_page
$total_records
*/
$max_page = ceil($total_records/$per_page);
$firstLink = $currentUrl.'&page=1';
$lastLink = $currentUrl.'&page='.$max_page;

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
<div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
    <ul class="pagination">
        <li class="paginate_button page-item previous @if (!$previousLink) disabled @endif " id="dataTable_previous">
            <a href="{{$firstLink}}" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link"><<</a>
        </li>
        <li class="paginate_button page-item previous @if (!$previousLink) disabled @endif " id="dataTable_previous">
            <a href="{{$previousLink}}" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link"><</a>
        </li>
        @for ($i = $before; $i <= $after; $i++)
            <li class="paginate_button page-item @if ($page == $i) active @endif ">
                <a href="{{$currentUrl.'&page='.$i}}" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">{{$i}}</a>
            </li>
        @endfor
     
        <li class="paginate_button page-item next @if (!$nextLink) disabled @endif" id="dataTable_next">
            <a href="{{$nextLink}}" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link">></a>
        </li>
        <li class="paginate_button page-item next @if (!$nextLink) disabled @endif" id="dataTable_next">
            <a href="{{$lastLink}}" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link">>></a>
        </li>
    </ul>
</div>


{{-- <div v-show="totalPage>1" class="fvn-pagination d-flex gap-s mb-2">
    <div class="pagination__status showing-status d-flex gap-s"> 
        <span class="showing-status__pages text-nowrap">{{page}} – {{currentPage}}</span> of 
        <span class="showing-status__total">{{total}}</span>
    </div>
    <div class="d-flex paging-limit gap-s"> 
        <div class="label text-nowrap">{{limitLabel}}:</div> 
        <select class="dropdown mb-0" v-model="comPerPage" @change="$emit('change-limit',comPerPage)">
            <option v-for="i in [10,20,30]" :value="i">{{i}}</option>
        </select>
    </div>
    <div class="d-flex pagination__nav gap-s">
        <button type="button" class="button pagination__nav--prev m-0" @click="$emit('back-page')" :disabled="page==1"> < </button> 
        <span class="current-page">{{page}}/{{totalPage}}</span>
        <button type="button" class="button pagination__nav--next m-0" @click="$emit('next-page')" :disabled="page==totalPage"> > </button>
    </div>
    </div> --}}