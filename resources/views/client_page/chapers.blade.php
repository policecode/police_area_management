@extends('layouts.client')

@section('content')
    <script>
        var redirectToStory = '{{ $story['link'] }}';
        var apiUrlChapter = '{{ route('client.api.chaper', ['story_slug' => $story['slug'], 'chaper_slug' => $chaper['slug']]) }}';
    </script>
    <main id="app_chapter">
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
                    <button @click="barBtn.desktop = !barBtn.desktop" class="btn btn-success chapter_jump me-1">
                        <span>
                            <i class="fa-solid fa-bars"></i>
                        </span>
                    </button>

                    <div class="me-1 w-50" :class="{ 'd-none': barBtn.desktop }">
                        <select class="form-select btn btn-success" :class="{ 'd-none': barBtn.desktop }"
                            onchange="location = this.value;">
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
                    <button @click="barBtn.setting = !barBtn.setting" class="btn btn-success chapter_jump ms-1"
                        title="cài đặt">
                        <span>
                            <i class="fa-solid fa-gear"></i>
                        </span>
                    </button>

                </div>

                <div v-if="barBtn.setting" class="chapter-actions chapter-actions-origin row mt-3">
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

            <div v-html="itemDetail.content" class="chapter-content mb-3" style="text-align: justify;" :style="{ 'fontSize': `${styles.fontSize}px` }">
                {{-- {!! $chaper['content'] !!} --}}
            </div>

            <div class="chapter-nav text-center">
                <div class="chapter-actions chapter-actions-origin d-flex align-items-center justify-content-center">
                    <a class="btn btn-success me-1 chapter-prev" href="{{ $link_prev }}" title="">
                        <i class="fa-solid fa-chevron-left d-sm-none"></i>
                        <span class="d-none d-sm-block">Chương trước</span>
                    </a>
                    <button @click="barBtn.desktop = !barBtn.desktop" class="btn btn-success chapter_jump me-1">
                        <span>
                            <i class="fa-solid fa-bars"></i>
                        </span>
                    </button>

                    <div class="me-1 w-50" :class="{ 'd-none': barBtn.desktop }">
                        <select class="form-select btn btn-success" :class="{ 'd-none': barBtn.desktop }"
                            onchange="location = this.value;">
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
                <button @click="barBtn.mobile = !barBtn.mobile" class="btn btn-success chapter_jump me-2">
                    <span>
                        <i class="fa-solid fa-bars"></i>
                    </span>
                </button>

                <div class="me-1 w-100" :class="{ 'd-none': barBtn.mobile }">
                    <select class="form-select btn btn-success" :class="{ 'd-none': barBtn.mobile }"
                        onchange="location = this.value;">
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
                // this.searchItem();
                this.addViewStory();
                this.addHistoryReadStory();
                this.callChapter();
            },
            computed: {

            },
            methods: {
                async callChapter() {
                    const jsonData = await new RouteApi().get(apiUrlChapter);
                    // console.log(jsonData);
                    
                    if (jsonData.result) {
                        this.itemDetail = jsonData.data;
                    } else {
                        this.itemDetail = {};
                        // jAlert(jsonData.message);
                    }
                },
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
                    LocalStorageHelper.set('chaper_font_size', newVal)
                }
            },
        });
    </script>
@endsection

@section('scripts')
    <script src="{{ asset('frontend/js/chapter.js') }}"></script>
    <script src="{{ asset('assets/js/website_security.js') }}"></script>
@endsection
