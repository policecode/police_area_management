<?php 
$currentUrl = url()->current();

?>
<div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
    <ul class="pagination">
        <li class="paginate_button page-item previous disabled" id="dataTable_previous">
            <a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0"
                class="page-link">Previous</a>
        </li>
        <li class="paginate_button page-item active">
            <a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a>
        </li>
        <li class="paginate_button page-item ">
            <a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">2</a>
        </li>
      
        <li class="paginate_button page-item next" id="dataTable_next">
            <a href="#" aria-controls="dataTable"
                data-dt-idx="7" tabindex="0" class="page-link">Next</a>
            </li>
    </ul>
</div>