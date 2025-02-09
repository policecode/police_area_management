@extends('layouts.frontend_v1')
@section('head')
    <meta name="robots" content="none" />
    <meta name="googlebot" content="none">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/confirm.minb2fd.css?v=' . FVN_VERSION_LARAVEL) }}"
        type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/scss/chapterdcb9.css?v=' . FVN_VERSION_LARAVEL) }}" type="text/css">
    <link rel="stylesheet"
        href="{{ asset('assets/tech5scomment/theme/css/emojionearea.minaf78.css?v=' . FVN_VERSION_LARAVEL) }}"
        type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/tech5scomment/theme/css/commentaf78.css?v=' . FVN_VERSION_LARAVEL) }}"
        type="text/css" />
@endsection
@section('content')
    <script>
        var redirectToStory = '{{ $story['link'] }}';
        var apiUrlChapter =
            '{{ route('client.api.chaper', ['story_slug' => $story['slug'], 'chaper_slug' => $chaper['slug']]) }}';
    </script>
    <div id="app_chapter">
        <section class="py-4 read-stories">
            <div class="container chapter-content-container chapter-page-apply" style="">
                <div class="box-control py-3 flex justify-center">
                    <a href="{{ $link_prev }}" title="Chương trước"
                        class="btn btn-control xl:text-[1.25rem] text-white !rounded bg-[#128c7e] xl:py-2 xl:px-4 hover:bg-[#0e6d62] hover:text-white">
                        <i class="fa-solid fa-angle-left mr-2"></i>
                        <span class="sm:block" hidden>Chương trước</span>
                    </a>
                    <span @click="showToggle('chapter_top')"
                        class="btn show-chapter__list !rounded xl:py-2 xl:px-4 text-white bg-[#6c757d] mx-1 text-[1.25rem] cursor-pointer btn-show-list-chapter-page">
                        <i class="fa-solid fa-table-list"></i>
                    </span>
                    <a href="{{ $link_next }}" title="Chương tiếp"
                        class="btn btn-control xl:text-[1.25rem] text-white !rounded bg-[#128c7e] xl:py-2 xl:px-4 hover:bg-[#0e6d62] hover:text-white">
                        <span class="sm:block" hidden>Chương tiếp</span>
                        <i class="fa-solid fa-angle-right ml-2"></i>
                    </a>
                </div>
      
                <div class="justify-center" :class="{'flex':show.chapter_top}" hidden>
                    <select class="xl:py-2 xl:px-4 bg-[#128c7e] mx-1 py-2 text-white" onchange="location = this.value;">
                        @foreach ($chaper_list as $item)
                            <option
                                value="{{ route('client.chaper', ['story_slug' => $story['slug'], 'chaper_slug' => $item['slug']]) }}"
                                {{ $item['id'] == $chaper['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="chapter-content"
                    style="background:#ffffff;color:#292e33;font-size:18px;line-height:24px;font-family:Roboto;">
                    <h1 class="chapter-title font-bold mb-2">{{ $chaper['name'] }}</h1>
                    <p class="info-detail mb-1">
                        <i class="fa-solid fa-book mr-1"></i> {{ ucwords($story['title']) }}
                    </p>
                    <p class="info-detail lg:">
                        <span class="mr-2 last:mr-0"><i
                                class="fa-solid fa-pen-to-square mr-1"></i>{{ ucwords($story['author_name']) }}</span>
                        <span class="mr-2 last:mr-0"><i class="fa-regular fa-file-word mr-1"></i>
                            {{ $chaper['content_length'] }} Chữ</span>
                        <span class="mr-2 last:mr-0"><i class="fa-solid fa-clock mr-1"></i>
                            {{ dateFormat($chaper['created_at']) }}</span>
                    </p>
                    <div class="s-content text-justify mt-4  published-content">
                        {!! $chaper['content'] !!}
                    </div>
                </div>
            </div>
            <div class="container chapter-page-apply" style="">
    
                <div class="flex justify-between flex-wrap mt-6">
                    <p class="text-[#128c7e]">
                        Sưu Tầm, {{ dateFormat($chaper['created_at']) }}
                    </p>
                    <p class="text-[#128c7e]">Lượt xem: {{ $chaper['view'] }}</p>
                </div>
                <div class="box-control py-3 flex flex-wrap justify-center">
                    <a href="{{ $link_prev }}" title="Chương trước"
                        class="btn btn-control xl:text-[1.25rem] text-white !rounded bg-[#128c7e] xl:py-2 xl:px-4 hover:bg-[#0e6d62] hover:text-white">
                        <i class="fa-solid fa-angle-left mr-2"></i>
                        <span class="sm:block" hidden>Chương trước</span>
                    </a>
                    <span @click="showToggle('chapter_bottom')"
                        class="btn show-chapter__list !rounded xl:py-2 xl:px-4 text-white bg-[#6c757d] mx-1 text-[1.25rem] cursor-pointer btn-show-list-chapter-page">
                        <i class="fa-solid fa-table-list"></i>
                    </span>
                    <a href="{{ $link_next }}" title="Chương tiếp"
                        class="btn btn-control xl:text-[1.25rem] text-white !rounded bg-[#128c7e] xl:py-2 xl:px-4 hover:bg-[#0e6d62] hover:text-white">
                        <span class="sm:block" hidden>Chương tiếp</span>
                        <i class="fa-solid fa-angle-right ml-2"></i>
                    </a>
                </div>
      
                <div class="justify-center mb-4" :class="{'flex': show.chapter_bottom}" hidden>
                    <select class="xl:py-2 xl:px-4 bg-[#128c7e] mx-1 py-2 text-white" onchange="location = this.value;">
                        @foreach ($chaper_list as $item)
                            <option
                                value="{{ route('client.chaper', ['story_slug' => $story['slug'], 'chaper_slug' => $item['slug']]) }}"
                                {{ $item['id'] == $chaper['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <a href="javascript:void(0)" title="Báo lỗi chương"
                        class="btn bg-[#f0ad4e] !text-white font-bold mr-2 last:mr-0 sm:min-w-[130px] mb-2"
                        modal-rs-target="modal-report">
                        <i class="fa-solid fa-triangle-exclamation mr-2"></i>Báo lỗi chương
                    </a>
                </div>
            </div>
            <div class="container mt-6">
                <div id="comment-chapter-box"
                    class="box-comment-wapper p-3 rounded bg-[#fff] mb-6 shadow-[2px_2px_6px_rgba(0,0,0,.13)]">
                    <div class="fb-comments" data-href="{{ route('client.story', ['story_slug' => $story['slug']]) }}"
                        data-width="100%" data-colorscheme="dark" data-numposts="10" data-mobile="true"></div>
                </div>
            </div>
        </section>
        <div class="fixed top-0 right-0 left-0 z-50 flex h-full w-full items-center justify-center overflow-hidden overflow-y-auto overflow-x-hidden bg-[#00000099] duration-500 md:inset-0 invisible pointer-events-none opacity-0"
            modal-rs="modal-report">
            <div class="popup-form md:max-w-[500px] bg-white relative mx-auto max-h-screen w-full max-w-[90%] overflow-y-auto rounded-md md:h-auto"
                modal-rs-content="">
                <span
                    class="close-modal bg-[#128c7e] rounded p-1 flex w-6 h-6 items-center justify-center cursor-pointer absolute top-4 right-4 z-[1]"
                    modal-rs-close="">
                    <img src="{{ asset('assets/images/close-modal.png') }}" alt="">
                </span>
                <p class="font-medium text-center text-[#000] text-[1.3rem] p-4 border-b-[1px] border-solid border-[#ebebeb]">
                    Báo lỗi chương</p>
                <div id="report_chapter_error_form" class="form p-4 formValidation" accept-charset="utf8" absolute
                    data-success="NOTIFICATION.toastrMessageReload">
                    <input type="hidden" name="_token" value="f6n6nXmbaeGSTOsTpgAo7wkhO38kABB3FFG2GsG7"> <input
                        type="hidden" name="story_id" value="383">
                    <input type="hidden" name="chapter_id" value="561808">
                    <input type="hidden" name="user_id" value="">
                    <p class="text-note text-[#607d8b] mb-2">Nhập mô tả lỗi</p>
                    <textarea
                        class="form-control border border-solid border-[#ebebeb] bg-white rounded-md h-16 resize-none mb-2 w-full px-3 py-2"
                        name="content" rules="required" m-required="Vui lòng nhập mô tả lỗi"></textarea>
                    <button id="report_chapter_error_btn" class="btn btn-green !rounded">Báo cáo</button>
                </div>
            </div>
        </div>
        <div class="chapter-action-box-wrapper">
            <div class="position-relative">
                <div class="setting-frontend font-bold" :class="{'active' : show_setting}">
                    <p class="title-setting text-[1rem] lg:text-[1.25rem]">Cài đặt giao diện</p>
                    <div class="p-3">
                        <div class="flex justify-between items-center mb-8">
                            <p class="title-item text-[0.9375rem]">Cỡ chữ (<span class="preview-value"></span>px):</p>
                            <input type="range" id="fontsize" min="12" max="30" value="18">
                        </div>
                        <div class="flex justify-between items-center mb-8">
                            <p class="title-item text-[0.9375rem]">Cách dòng (<span class="preview-value"></span>px):</p>
                            <input type="range" id="lineheight" min="20" max="50" value="24">
                        </div>
                        <div class="flex justify-between items-center mb-8">
                            <p class="title-item text-[0.9375rem]">Font chữ :</p>
                            <select id="fontfamily">
                                <option value="Roboto" selected>Roboto</option>
                                <option value="Athiti">Athiti</option>
                                <option value="Tahoma">Tahoma</option>
                                <option value="Helvetica">Helvetica</option>
                                <option value="Courier New">Courier New</option>
                                <option value="Verdana">Verdana</option>
                                <option value="Arial">Arial</option>
                                <option value="Palatino Linotypeoption">Palatino Linotypeoption</option>
                                <option value="Times New Roman">Times New Roman</option>
                            </select>
                        </div>
                        <div class="flex justify-between items-center mb-6">
                            <p class="title-item text-[0.9375rem]">Kiểu nền</p>
                            <div class="flex gap-3 w-full">
                                <div class="item-def-theme bg-[#f0f0f0]" data-color="#292e33" data-bg="#f0f0f0"></div>
                                <div class="item-def-theme bg-[#eae4d3]" data-color="#5b4636" data-bg="#eae4d3"></div>
                                <div class="item-def-theme bg-[#252c33]" data-color="#b6babf" data-bg="#252c33"></div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <p class="title-item text-[0.9375rem]">Màu chữ :</p>
                            <input type="color" id="color" value="#292e33">
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="title-item text-[0.9375rem]">Màu nền :</p>
                            <input type="color" id="bg" value="#ffffff">
                        </div>
                        <label class="flex gap-2 items-center mt-6">
                            <p class="text-[0.9375rem]">Áp dụng màu nền cho toàn trang: </p>
                            <input type="checkbox" id="site_bg_apply" class="w-auto">
                        </label>
                        <div class="mt-6 text-right">
                            <a href="javascript:void(0)"
                                class="inline-block text-[1rem] !text-white !rounded bg-[#128c7e] py-2 px-4 hover:bg-[#0e6d62] mr-3"
                                title="Trở về mặc định">
                                <i class="fa-solid fa-repeat mr-2"></i>Reset
                            </a>
                            <a @click="show_setting = false" href="javascript:void(0)"
                                class="inline-block text-[1rem] !text-white !rounded bg-[#7c7c7c] py-2 px-4 hover:bg-[#4c4c4c]"
                             title="Trở về mặc định">
                                <i class="fa-regular fa-rectangle-xmark mr-2"></i>Đóng
                            </a>
                        </div>
                    </div>
                </div>
                <div class="chapter-action-box">
                    <a @click="show_setting = true" href="javascript:void(0)" class="item-action show-chapter-theme-setting" title="Cài đặt giao diện">
                        <i class="fa-solid fa-gear"></i>
                    </a>
                    <a href="javascript:void(0)" class="item-action scroll-to-commnet-box" title="Bình luận truyện">
                        <i class="fa-solid fa-comments"></i>
                    </a>
                    <a href="{{ route('client.story', ['story_slug' => $story['slug']]) }}" class="item-action"
                        title="Chi tiết truyện">
                        <i class="fa-solid fa-book"></i>
                    </a>
                    <a href="javascript:void(0)" class="item-action" title="Trở về mặc định">
                        <i class="fa-solid fa-repeat"></i>
                    </a>
                    <a href="javascript:void(0)" class="item-action" modal-rs-target="modal-report" title="Trở về mặc định">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <a id="scroll-to-top-btn" class="bottom-right"><i class="fas fa-angle-double-up"></i></a>
    <script>
        var vue_chapter_app = {
            loading: false,
            show_setting: false,
            show: {
                chapter_top: false,
                chapter_bottom: false,
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
                showToggle(name) {
                    this.show[name] = !this.show[name];
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
                        is_convert: this.story.is_convert,
                        chapter_name: this.chaper.name,
                        slug_chapter: this.chaper.slug,
                        position: this.chaper.position,
                        link_chapter: this.chaper.link,

                    }
                    let results = [];
                    results.push(story);
                    if (listStoryHistory.length > 0) {
                        for (let i = 0; i < listStoryHistory.length; i++) {
                            if (listStoryHistory[i].id != story.id) {
                                results.push(listStoryHistory[i]);
                            }
                            if (results.length >= 8) {
                                break;
                            }
                        }
                    }
                    LocalStorageHelper.setObject('fvn_story_history', results);

                }
            },
            watch: {
                // 'styles.fontSize'(newVal) {
                //     LocalStorageHelper.set('chaper_font_size', newVal);
                //     $('.chapter-content').css({
                //         'font-size': newVal + 'px'
                //     });
                // }
            },
        });
    </script>
@endsection

@section('scripts')
    {{-- <script src="{{ asset('assets_global/js/website_security.js?v=' . FVN_VERSION_LARAVEL) }}"></script> --}}
@endsection
