<?php 
$currentUrl = getUrl(['keyword']);
?>
<form action="" method="get" class="mb-3">
    <div class="row">
        <div class="col-2">
            @include('parts.template.select2', [
                'id' => 'js-example-basic-single',
                'title_option' => 'Chọn quốc tịch',
                'name' => 'country',
                'list_option' => $country,
                'value_current' => getQuery('country')
            ])
        </div>
        <div class="col-2">
            <input type="text" name="keyword" class="form-control @error('name') is-invalid @enderror" placeholder="Tìm kiếm..." value="{{getQuery('keyword')}}">
        </div>
        <div class="col-2">
            <button class="btn btn-primary">Tìm kiếm</button>
        </div>
    </div>
</form>