<?php
$categories = get_all_categories();
?>

<div class="section-list-category bg-light p-2 rounded card-custom">
    <div class="head-title-global mb-2">
        <div class="col-12 col-md-12 head-title-global__left">
            <h2 class="mb-0 border-bottom border-secondary pb-1">
                <span href="#" class="d-block text-decoration-none text-dark fs-4" title="Truyện đang đọc">Thể loại
                    truyện</span>
            </h2>
        </div>
    </div>
    <div class="row">
        <!-- Horizontal under breakpoint -->
        <ul class="list-category">
            @foreach ($categories as $item)
                <li class="">
                    <a href="{{ route('client.tag', ['tag_slug' => $item['slug']]) }}"
                        class="text-decoration-none hover_primary text-dark">{{ $item['name'] }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
