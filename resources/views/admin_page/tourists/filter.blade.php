<?php 
$currentUrl = getUrl(['keyword']);
?>
<form id="filter__query_mrdat" method="get" class="mb-3">
    <div class="row">
        {{-- <div class="col-2">
            @include('parts.template.select2', [
                'id' => 'js-example-basic-single',
                'title_option' => 'Chọn quốc tịch',
                'name' => 'country',
                'list_option' => $country,
                'value_current' => getQuery('country')
            ])
        </div> --}}
        <div class="col-2">
            @include('parts.template.select', [
                    'title_option' => 'Dữ liệu trên một trang',
                    'name' => 'per_page',
                    'list_option' => [
                        [
                            "value" => 10,
                            "key" => 10
                        ],
                        [
                            "value" => 20,
                            "key" => 20
                        ],
                        [
                            "value" => 30,
                            "key" => 30
                        ],
                        [
                            "value" => 40,
                            "key" => 40
                        ],
                        [
                            "value" => 50,
                            "key" => 50
                        ],
                        [
                            "value" => 60,
                            "key" => 60
                        ]
                    ],
                    'value_current' => getQuery('per_page', 20)
                ])
        </div>
        <div class="col-2">
            <input type="text" name="keyword" class="form-control @error('name') is-invalid @enderror" placeholder="Tìm kiếm..." value="{{getQuery('keyword')}}">
        </div>
        <div class="col-2">
            <button class="button btn btn-primary">Tìm kiếm</button>
        </div>
    </div>
</form>

<script>
    // $('#filter__query_mrdat').click(function (e) { 
    //     e.preventDefault();
    //     console.log($('#filter__query_mrdat select').value);
      
        
    // });
</script>