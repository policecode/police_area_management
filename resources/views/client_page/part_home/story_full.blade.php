<div class="section-stories-full mb-3 mt-3">
    <div class="container">
        <div class="row">
            <div class="head-title-global d-flex justify-content-between mb-2">
                <div class="col-12 col-md-4 head-title-global__left d-flex">
                    <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                        <a href="{{ route('client.full-story') }}" class="d-block text-decoration-none text-dark fs-4 title-head-name"
                            title="Truyện đã hoàn thành">Truyện đã hoàn thành</a>
                    </h2>
                    <!-- <i class="fa-solid fa-fire-flame-curved"></i> -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="section-stories-full__list">
                    @foreach ($full_stories as $item)
                        <div class="story-item-full text-center">
                            <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                class="d-block story-item-full__image">
                                <img src="{{ $item['thumbnail'] }}" alt="Tự Cẩm" class="img-fluid w-100"
                                    width="150" height="230" loading="lazy">
                            </a>
                            <h3 class="fs-6 story-item-full__name fw-bold text-center mb-0">
                                <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                    class="text-decoration-none text-one-row story-name">
                                    {{ $item['title'] }}
                                </a>
                            </h3>
                            <span class="story-item-full__badge badge text-bg-success">Full -
                                {{ $item['total_chaper'] }} chương</span>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="col-12 mt-3">
                @include('parts.ads.adsense_v5')
            </div>

        </div>

        <div class="row mt-3">
            <div class="head-title-global d-flex justify-content-between mb-2">
                <div class="col-12 col-md-4 head-title-global__left d-flex">
                    <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                        <a href="{{ route('client.tag', ['tag_slug' => 'convert']) }}" class="d-block text-decoration-none text-dark fs-4 title-head-name"
                            title="Truyện Convert">Truyện Convert</a>
                    </h2>
                    <!-- <i class="fa-solid fa-fire-flame-curved"></i> -->
                </div>
            </div>
            <div class="col-12">
                <div class="section-stories-full__list">
                    @foreach ($convert_stories as $item)
                        <div class="story-item-full text-center">
                            <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                class="d-block story-item-full__image">
                                <img src="{{ $item['thumbnail'] }}" alt="Tự Cẩm" class="img-fluid w-100"
                                    width="150" height="230" loading="lazy">
                            </a>
                            <h3 class="fs-6 story-item-full__name fw-bold text-center mb-0">
                                <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                    class="text-decoration-none text-one-row story-name">
                                    {{ $item['title'] }}
                                </a>
                            </h3>
                            <span class="story-item-full__badge badge text-bg-success">{{ $item['total_chaper'] }}
                                chương</span>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
