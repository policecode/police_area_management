<div class="container">
    <div class="row align-items-start">
        <div class="col-12 col-md-8 col-lg-9">
            <div class="section-stories-new mb-3">
                <div class="row">
                    <div class="head-title-global d-flex justify-content-between mb-2">
                        <div class="col-6 col-md-4 col-lg-4 head-title-global__left d-flex align-items-center">
                            <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                                <a href="https://suustore.com/#"
                                    class="d-block text-decoration-none text-dark fs-4 story-name"
                                    title="Truyện Mới">Truyện Mới</a>
                            </h2>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="section-stories-new__list">
                            @foreach ($new_stories as $item)
                                <div class="story-item-no-image">
                                    <div class="story-item-no-image__name d-flex align-items-center">
                                        <h3 class="me-1 mb-0 d-flex align-items-center">

                                            <svg style="width: 10px; margin-right: 5px;"
                                                xmlns="http://www.w3.org/2000/svg" height="1em"
                                                viewBox="0 0 320 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                                <path
                                                    d="M278.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-160 160c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L210.7 256 73.4 118.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l160 160z">
                                                </path>
                                            </svg>
                                            <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                                class="text-decoration-none text-dark fs-6 hover-title text-one-row story-name">{{ $item['title'] }}</a>
                                        </h3>
                                        @if ($item['after_day'] < 30)
                                            <span class="badge text-bg-info text-light me-1">New</span>
                                        @endif
                                        @if ($item['status'] == 1)
                                            <span class="badge text-bg-success text-light me-1">Full</span>
                                        @endif
                                        @if ($item['star_average'] > 7)
                                            <span class="badge text-bg-danger text-light">Hot</span>
                                        @endif

                                    </div>

                                    <div class="story-item-no-image__categories ms-2 d-none d-lg-block">
                                        <p class="mb-0">
                                            @foreach ($item['categories'] as $value)
                                                <a href="{{ route('client.tag', ['tag_slug' => $value['slug']]) }}"
                                                    class="hover_primary text-decoration-none text-dark category-name">{{ $value['name'] }},
                                                </a>
                                            @endforeach
                                        </p>
                                    </div>

                                    <div class="story-item-no-image__chapters ms-2">
                                        <a href="{{ route('client.chaper', ['story_slug' => $item['slug'], 'chaper_slug' => $item['chaper_slug']]) }}"
                                            title="{{ $item['chaper_name'] }}"
                                            class="hover-title text-decoration-none text-info">Chương
                                            {{ $item['position'] }}</a>
                                    </div>

                                    <div class="story-item-no-image__chapters ms-2">
                                        <span>{{ get_string_after_time($item['after_minutes']) }}</span>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3 sticky-md-top">
            <div class="row">
                <div class="col-12">
                    @include('parts.client.table_categories')
                </div>
            </div>
        </div>

    </div>
</div>
