@extends('layouts.client')
@section('head')
    <meta name="robots" content="none" />
    <meta name="googlebot" content="none">
@endsection
@section('content')
    <script>
        var redirectToStory = '{{ $story['link'] }}';
        var apiUrlChapter =
            '{{ route('client.api.chaper', ['story_slug' => $story['slug'], 'chaper_slug' => $chaper['slug']]) }}';
    </script>
    <main class="overflow-hidden">
        <div class="chapter-wrapper container my-5">
            <a href="{{ route('client.story', ['story_slug' => $story['slug']]) }}" class="text-decoration-none">
                <h2 class="text-center text-success">{{ ucwords($story['title']) }}</h2>
            </a>
            <h1 class="text-center text-dark fs-6">{{ $chaper['name'] }}</h1>

            <hr class="chapter-start container-fluid">
            <div class="chapter-nav text-center">
                <div class="chapter-actions chapter-actions-origin d-flex align-items-center justify-content-center">
                    <a class="btn btn-success me-1 chapter-prev" href="{{ $link_prev }}" title="">
                        <i class="fa-solid fa-chevron-left d-sm-none"></i>
                        <span class="d-none d-sm-block">Chương trước</span>
                    </a>
                    <button class="btn btn-success chapter_jump me-1">
                        <span>
                            <i class="fa-solid fa-bars"></i>
                        </span>
                    </button>

                    <div class="choose__option_chapter me-1 w-50 d-none">
                        <select class="form-select btn btn-success" onchange="location = this.value;">
                            @foreach ($chaper_list as $item)
                                <option
                                    value="{{ route('client.chaper', ['story_slug' => $story['slug'], 'chaper_slug' => $item['slug']]) }}"
                                    {{ $item['id'] == $chaper['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <a class="btn btn-success chapter-next" href="{{ $link_next }}" title="">
                        <span class="d-none d-sm-block">Chương tiếp</span>
                        <i class="fa-solid fa-chevron-right d-sm-none"></i>
                    </a>
                    <button class="chapter_setting btn btn-success ms-1" title="cài đặt">
                        <span>
                            <i class="fa-solid fa-gear"></i>
                        </span>
                    </button>

                </div>

                <div id="app_chapter" class="choose__option_setting chapter-actions chapter-actions-origin row mt-3 d-none">
                    <div class="col-lg-3 col-sm-4 col-6"></div>
                    <div class="col-lg-3 col-sm-4 col-6">
                        <div class="input-group flex-nowrap ">
                            <span class="input-group-text bg-success text-white">Size</span>
                            <span class="btn btn-danger" @click="reduceSize">-</span>
                            <input type="number" v-model="styles.fontSize" class="form-control ms-1" min="10"
                                max="35" />
                            <span class="btn btn-primary" @click="increaseSize">+</span>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="chapter-end container-fluid">

            <div class="mb-3">
                @include('parts.ads.adsense_v5')
            </div>
            <div class="chapter-content mb-3" style="text-align: justify;">
                {!! $chaper['content'] !!}
            </div>
            <div class="mb-3">
                @include('parts.ads.adsense_v6')
            </div>

            <div class="chapter-nav text-center">
                <div class="chapter-actions chapter-actions-origin d-flex align-items-center justify-content-center">
                    <a class="btn btn-success me-1 chapter-prev" href="{{ $link_prev }}" title="">
                        <i class="fa-solid fa-chevron-left d-sm-none"></i>
                        <span class="d-none d-sm-block">Chương trước</span>
                    </a>
                    <button class="btn btn-success chapter_jump me-1">
                        <span>
                            <i class="fa-solid fa-bars"></i>
                        </span>
                    </button>

                    <div class="choose__option_chapter me-1 w-50 d-none">
                        <select class="form-select btn btn-success" onchange="location = this.value;">
                            @foreach ($chaper_list as $item)
                                <option
                                    value="{{ route('client.chaper', ['story_slug' => $story['slug'], 'chaper_slug' => $item['slug']]) }}"
                                    {{ $item['id'] == $chaper['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <a class="btn btn-success chapter-next" href="{{ $link_next }}" title="">
                        <span class="d-none d-sm-block">Chương tiếp</span>
                        <i class="fa-solid fa-chevron-right d-sm-none"></i>
                    </a>


                </div>
            </div>

            <div class="chapter-actions chapter-actions-mobile d-flex align-items-center justify-content-center">
                <a class="btn btn-success me-2 chapter-prev" href="{{ $link_prev }}" title="">
                    <i class="fa-solid fa-chevron-left"></i>
                </a>
                <button class="btn btn-success chapter_jump me-2">
                    <span>
                        <i class="fa-solid fa-bars"></i>
                    </span>
                </button>

                <div class="choose__option_chapter me-1 w-100 d-none">
                    <select class="form-select btn btn-success" onchange="location = this.value;">
                        @foreach ($chaper_list as $item)
                            <option
                                value="{{ route('client.chaper', ['story_slug' => $story['slug'], 'chaper_slug' => $item['slug']]) }}"
                                {{ $item['id'] == $chaper['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <a class="btn btn-success chapter-next" href="{{ $link_next }}" title="">
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>
    </main>
    <script>
        var vue_chapter_app = {
            loading: false,
            barBtn: {
                desktop: true,
                mobile: true,
                setting: false
            },
            styles: {
                fontSize: LocalStorageHelper.get('chaper_font_size', 20)
            },
            items: [],
            querySearch: {
                total: 0,
                page: 1,
                per_page: 50,
                order_by: 'id',
                order_type: 'ASC'
            },
            itemDetail: {},
            story: {{ Illuminate\Support\Js::from($story) }},
            chaper: {{ Illuminate\Support\Js::from($chaper) }},
            apiUrl: FVN_LARAVEL_HOME + '/read',
            pointInTime: null,
        };
        var appChapter = new Vue({
            el: '#app_chapter',
            data: vue_chapter_app,
            mounted: function() {
                this.addViewStory();
                this.addHistoryReadStory();
            },
            computed: {

            },
            methods: {
                addViewStory() {
                    setTimeout(async () => {
                        let jsonData = await new RouteApi().post(`${this.apiUrl}/increase-views`, {
                            story_id: this.story.id,
                            chaper_id: this.chaper.id
                        });
                        if (jsonData.status) {
                            console.log(jsonData.message);
                        } else {
                            console.log(jsonData.message);
                        }
                    }, 60000);
                },
                reduceSize() {
                    if (this.styles.fontSize <= 15) {
                        return;
                    }
                    --this.styles.fontSize;
                },
                increaseSize() {
                    if (this.styles.fontSize >= 35) {
                        return;
                    }
                    ++this.styles.fontSize;
                },
                addHistoryReadStory() {
                    let listStoryHistory = LocalStorageHelper.getObject('fvn_story_history', []);
                    let story = {
                        id: this.story.id,
                        title: this.story.title,
                        slug: this.story.slug,
                        link: this.story.link,
                        chapter_name: this.chaper.name,
                        slug_chapter: this.chaper.slug,
                        position: this.chaper.position,
                        link_chapter: this.chaper.link
                    }
                    let results = [];
                    results.push(story);
                    if (listStoryHistory.length > 0) {
                        for (let i = 0; i < listStoryHistory.length; i++) {
                            if (listStoryHistory[i].id != story.id) {
                                results.push(listStoryHistory[i]);
                            }
                            if (results.length >= 5) {
                                break;
                            }
                        }
                    }
                    LocalStorageHelper.setObject('fvn_story_history', results);

                }
            },
            watch: {
                'styles.fontSize'(newVal) {
                    LocalStorageHelper.set('chaper_font_size', newVal);
                    $('.chapter-content').css({
                        'font-size': newVal + 'px'
                    });
                }
            },
        });
    </script>
@endsection

@section('scripts')
    <script src="{{ asset('frontend/js/chapter.js?v=' . FVN_VERSION_LARAVEL) }}"></script>
    <script src="{{ asset('assets/js/website_security.js?v=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection
