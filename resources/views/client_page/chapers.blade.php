<?php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();

?>
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
      {{-- Quảng cáo adsense Start --}}
        @include('parts.ads.adsense_v1')
    {{-- Quảng cáo adsense End --}}
    <div id="app_chapter"
        :style="{
               backgroundColor: styles.backgroundColor,
               color: styles.color,
        }" >
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
                                value="{{ route('client.chaper', ['story_slug' => $story['slug'], 'chaper_position' => $item['position']]) }}"
                                {{ $item['id'] == $chaper['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>
          

                <div id="chapter-content_s"
                    style="font-size:18px;line-height:24px;font-family:Roboto;">
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
                    <div :style="{
                        fontSize: styles.fontSize + 'px',
                        lineHeight: styles.lineHeight + 'px',
                        fontFamily: styles.fontFamily
                    }" 
                    v-html="chaper.content"
                    class="s-content text-justify mt-4 published-content px-1"
                    >
                    {{-- <canvas ref="myCanvas" style="width: 100%; height: 100%;"></canvas> --}}
                        {{-- {!! $chaper['content'] !!} --}}
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
                                value="{{ route('client.chaper', ['story_slug' => $story['slug'], 'chaper_position' => $item['position']]) }}"
                                {{ $item['id'] == $chaper['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <a  @click="showFormReport" href="javascript:void(0)" title="Báo lỗi chương"
                        class="btn bg-[#f0ad4e] !text-white font-bold mr-2 last:mr-0 sm:min-w-[130px] mb-2">
                        <i class="fa-solid fa-triangle-exclamation mr-2"></i>Báo lỗi chương
                    </a>
                </div>
            </div>

        
        </section>
        <div ref="formReportChapter" class="fixed top-0 right-0 left-0 z-50 flex h-full w-full items-center justify-center overflow-hidden overflow-y-auto overflow-x-hidden bg-[#00000099] duration-500 md:inset-0 invisible pointer-events-none opacity-0">
            <div v-if="show_error_report" @click="show_error_report = false" class="fixed top-0 right-0 bottom-0 left-0"></div>
            <div class="popup-form md:max-w-[500px] bg-white relative mx-auto max-h-screen w-full max-w-[90%] overflow-y-auto rounded-md md:h-auto">
                <span @click="show_error_report = false"
                    class="close-modal bg-[#128c7e] rounded p-1 flex w-6 h-6 items-center justify-center cursor-pointer absolute top-4 right-4 z-[1]">
                    <img src="{{ asset('assets/images/close-modal.png') }}" alt="">
                </span>
                <p class="font-medium text-center text-[#000] text-[1.3rem] p-4 border-b-[1px] border-solid border-[#ebebeb]">
                    Báo lỗi chương</p>
                <div id="report_chapter_error_form" class="form p-4 formValidation" accept-charset="utf8" >
                  
                    <p class="text-note text-[#607d8b] mb-2">Nhập mô tả lỗi: <b>@{{itemDetail.content.length}}/500</b></p>
                    <textarea v-model="itemDetail.content"
                        class="form-control border border-solid border-[#ebebeb] bg-white rounded-md h-16 resize-none mb-2 w-full px-3 py-2"></textarea>
                    <span>Nội dung báo cáo không được quá 500 từ</span>
                    <button @click="sendReportChapter" id="report_chapter_error_btn" class="btn btn-green !rounded">Báo cáo</button>
                </div>
            </div>
        </div>
        <div v-if="show_setting" @click="show_setting = false" class="fixed top-0 right-0 bottom-0 left-0"></div>
        <div class="chapter-action-box-wrapper">
            <div class="position-relative">
                <div class="setting-frontend font-bold" :class="{'active' : show_setting}">
                    <p class="title-setting text-[1rem] lg:text-[1.25rem]">Cài đặt giao diện</p>
                    <div class="p-3">
                        <div class="flex justify-between items-center mb-8">
                            <p class="title-item text-[0.9375rem]">Cỡ chữ (<span class="preview-value">@{{styles.fontSize}}</span>px):</p>
                            <input v-model="styles.fontSize" type="range" id="fontsize" min="12" max="30" />
                        </div>
                        <div class="flex justify-between items-center mb-8">
                            <p class="title-item text-[0.9375rem]">Cách dòng (<span class="preview-value">@{{styles.lineHeight}}</span>px):</p>
                            <input v-model="styles.lineHeight" type="range" id="lineheight" min="20" max="50" />
                        </div>
                        <div class="flex justify-between items-center mb-8">
                            <p class="title-item text-[0.9375rem]">Font chữ :</p>
                            <select v-model="styles.fontFamily" id="fontfamily">
                                <option value="Roboto">Roboto</option>
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
                                <div @click="setStyles('#292e33', '#f0f0f0')" class="item-def-theme bg-[#f0f0f0]"></div>
                                <div @click="setStyles('#5b4636', '#eae4d3')" class="item-def-theme bg-[#eae4d3]"></div>
                                <div @click="setStyles('#b6babf', '#252c33')" class="item-def-theme bg-[#252c33]"></div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <p class="title-item text-[0.9375rem]">Màu chữ :</p>
                            <input v-model="styles.color" type="color" id="color" />
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="title-item text-[0.9375rem]">Màu nền :</p>
                            <input v-model="styles.backgroundColor" type="color" id="bg" />
                        </div>
                        {{-- <label class="flex gap-2 items-center mt-6">
                            <p class="text-[0.9375rem]">Áp dụng màu nền cho toàn trang: </p>
                            <input type="checkbox" id="site_bg_apply" class="w-auto">
                        </label> --}}
                        <div class="mt-6 text-right">
                            <a @click="resetStyles" href="javascript:void(0)"
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
                    <a @click="scrollTarget" href="javascript:void(0)" class="item-action scroll-to-commnet-box" title="Bình luận truyện">
                        <i class="fa-solid fa-comments"></i>
                    </a>
                    <a href="{{ route('client.story', ['story_slug' => $story['slug']]) }}" class="item-action"
                        title="Chi tiết truyện">
                        <i class="fa-solid fa-book"></i>
                    </a>
                    <a @click="resetStyles" href="javascript:void(0)" class="item-action" title="Trở về mặc định">
                        <i class="fa-solid fa-repeat"></i>
                    </a>
                    <a @click="showFormReport" href="javascript:void(0)" class="item-action" modal-rs-target="modal-report" title="Báo lỗi chương">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- Quảng cáo adsense Start --}}
        @include('parts.ads.adsense_v2')
    {{-- Quảng cáo adsense End --}}
    {{-- Comment Start --}}
        {{-- <div class="container mt-6">
                <div id="comment-chapter-box"
                    class="box-comment-wapper p-3 rounded bg-[#fff] mb-6 shadow-[2px_2px_6px_rgba(0,0,0,.13)]">
                    <div class="fb-comments" data-href="{{ route('client.story', ['story_slug' => $story['slug']]) }}"
                        data-width="100%" data-colorscheme="dark" data-numposts="10" data-mobile="true"></div>
                </div>
            </div> --}}
        <div id="comment_block" class="container">
            @include('client_page.part_stories.story_comment')

        </div>

    {{-- Comment End --}}

    @if (!$is_admin)
        {{-- @include('parts.ads.ads_modal_redirect') --}}
    @endif

    {{-- <a id="scroll-to-top-btn" class="bottom-right"><i class="fas fa-angle-double-up"></i></a> --}}
    <script>
        var vue_chapter_app = {
            loading: false,
            show_setting: false,
            show_error_report: false,
            user: {{ Illuminate\Support\Js::from($user) }},
            show: {
                chapter_top: false,
                chapter_bottom: false,
                setting: false
            },
            styles: {
                fontSize: LocalStorageHelper.get('chaper_font_size', 20),
                lineHeight: LocalStorageHelper.get('chaper_line_height', 24),
                fontFamily: LocalStorageHelper.get('chaper_font_family', 'Roboto'),
                backgroundColor: LocalStorageHelper.get('chaper_background_color', '#ffffff'),
                color: LocalStorageHelper.get('chaper_color', '#292e33'),
            },
            items: [],
            querySearch: {
                total: 0,
                page: 1,
                per_page: 50,
                order_by: 'id',
                order_type: 'ASC'
            },
            itemDetail: {
                story_id: {{ $story['id'] }},
                chapter_id: {{ $chaper['id'] }},
                content: ''
            },
            story: {{ Illuminate\Support\Js::from($story) }},
            chaper: {{ Illuminate\Support\Js::from($chaper) }},
            apiUrl: FVN_LARAVEL_HOME + '/read',
            apiMember: FVN_LARAVEL_HOME + '/api/member',
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
                isAuthLogin() {
                if (!this.user) {
                    jAlertCLient("Đăng nhập tài khoản", 'danger');
                    return true;
                }
             },
             showFormReport() {
                if (this.isAuthLogin()) {
                        return;
                    }
                    this.show_error_report = true
                },
                addContentToCanvas() {
                    // const element = this.$refs.htmlContentHolder;
                  
                    
                },
                addViewStory() {
                    setTimeout(async () => {
                        let jsonData = await new RouteApi().post(`${this.apiUrl}/increase-views`, {
                            story_id: this.story.id,
                            chaper_id: this.chaper.id
                        });
                        if (jsonData.status) {
                            jAlertCLient(jsonData.message, 'success');
                        } else {
                            jAlertCLient(jsonData.message, 'danger');
                        }
                    }, 60000);
                },
                showToggle(name) {
                    this.show[name] = !this.show[name];
                },
                resetStyles() {
                    this.styles = {
                            fontSize: 20,
                            lineHeight: 24,
                            fontFamily: 'Roboto',
                            backgroundColor: '#ffffff',
                            color: '#292e33'
                        };
                },
                setStyles(color, background) {
                    this.styles.color = color;
                    this.styles.backgroundColor = background;
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

                },
                scrollTarget() {
                    const target = document.getElementById('comment_block');
                    target.scrollIntoView({
                        behavior: 'smooth', // Cuộn mượt mà (không nhảy bộp phát)
                        block: 'start'      // Căn lề trên của mục tiêu sát mép trình duyệt
                    });
                },
                async sendReportChapter() {
                      let jsonData = await new RouteApi().post(`${this.apiMember}/report-chapter`, this.itemDetail);
                      this.show_error_report = false;
                        if (jsonData.status) {
                            jAlertCLient(jsonData.message, 'success');
                        } else {
                            jAlertCLient(jsonData.message, 'danger');
                        }
                }
            },
            watch: {
                'styles.fontSize'(newVal) {
                    this.addContentToCanvas();
                    LocalStorageHelper.set('chaper_font_size', newVal);
                },
                'styles.lineHeight'(newVal) {
                    this.addContentToCanvas();
                    LocalStorageHelper.set('chaper_line_height', newVal);
                },
                'styles.fontFamily'(newVal) {
                    this.addContentToCanvas();
                    LocalStorageHelper.set('chaper_font_family', newVal);
                },
                'styles.backgroundColor'(newVal) {
                    LocalStorageHelper.set('chaper_background_color', newVal);
                },
                'styles.color'(newVal) {
                    this.addContentToCanvas();
                    LocalStorageHelper.set('chaper_color', newVal);
                },
                'show_error_report'(newVal) {
                    const element = this.$refs.formReportChapter;
                    if (newVal) {
                        element.classList.remove('invisible', 'pointer-events-none', 'opacity-0');
                    } else {
                        element.classList.add('invisible', 'pointer-events-none', 'opacity-0');
                    }
                }
            },
        });
    </script>
@endsection

@section('scripts')
    @if (!$is_admin)
        <script src="{{ asset('assets_global/js/website_security.js?v=' . FVN_VERSION_LARAVEL) }}"></script>
    @endif
@endsection
