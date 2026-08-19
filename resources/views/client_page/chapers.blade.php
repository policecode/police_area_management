<?php
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\SettingHelpers;
$option = SettingHelpers::getInstance();
$user = Auth::user();

$affiliate;
switch (mt_rand(1, 2)) {
    case 1:
        $affiliate = $option->getOptionValue('affiliate_in_chapter_1');
        break;
    case 2:
        $affiliate = $option->getOptionValue('affiliate_in_chapter_2');
        break;
    default:
        $affiliate = $option->getOptionValue('affiliate_in_chapter_2');
        break;
}

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

    <div id="app_chapter"
        :style="{
            backgroundColor: styles.backgroundColor,
            color: styles.color,
        }">
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

                <div class="justify-center" :class="{ 'flex': show.chapter_top }" hidden>
                    <select class="xl:py-2 xl:px-4 bg-[#128c7e] mx-1 py-2 text-white" onchange="location = this.value;">
                        @foreach ($chaper_list as $item)
                            <option
                                value="{{ route('client.chaper', ['story_slug' => $story['slug'], 'chaper_position' => $item['position']]) }}"
                                {{ $item['id'] == $chaper['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>


                <div id="chapter-content_s" style="font-size:18px;line-height:24px;font-family:Roboto;">
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
                    
                    <div v-if="isAffiliate" :style="{
                        fontSize: styles.fontSize + 'px',
                        lineHeight: styles.lineHeight + 'px',
                        fontFamily: styles.fontFamily
                    }"
                        v-html="chaper.content" class="s-content text-justify mt-4 published-content px-1">
                    </div>
                    {{-- affiliate --}}
                    <div v-else class="bg-[#f0f0f0] text-center">
                     
                        {!!$affiliate['desc']!!}
                        <p style="font-size: 16px;margin-bottom: 0.4rem;">
                            <a @click="affLinkClick" id="affLink" href="{{$affiliate['link']}}" target="_blank" rel="noopener"><b>{{$affiliate['link']}}</b></a></p>
                        <p class="flex justify-center" style="font-size: 16px;margin-bottom: 0.4rem;">
                            <a @click="affLinkClick" href="{{$affiliate['link']}}" target="_blank" rel="noopener">
                                <img src="{{asset($affiliate['banner'])}}" alt="" style="max-width: 410px; width: 100%;">
                            </a>
                        </p>
                        <h4 class="text-center text-primary" style="font-size: 20px;margin: 1rem 0;">Hahoangdaide xin chân thành cảm ơn!</h4>
                    </div>
                    {{-- affiliate --}}
                    
                </div>


            </div>
            <div class="container chapter-page-apply" style="">
                <template v-if="(chaper.money > 0) && !chaper.unlocked_content">
                    <div
                        class="lock flex justify-center my-2 relative before:absolute before:w-full before:h-[1px] before:bg-[#ccc] before:top-1/2 before:left-0 before:translate-y-1/2">
                        <span
                            class="lock-icon bg-white relative flex items-center justify-center w-9 h-9 rounded-full border border-solid border-[#ccc]"><i
                                class="fa-solid fa-lock"></i></span>
                    </div>
                    <div class="box-buy-chapter my-5">
                        <p class="title text-center lg:text-[1.5rem] text-[1.25rem] font-bold mb-3">
                            Cần @{{ chaper.money }} Linh Thạch để mở khóa chương này
                        </p>
                        <div class="flex flex-col mb-3 text-[1.125rem]">
                            <a @click="buyChapter" href="javascript:void(0)" title="Mở khóa chương"
                                class="btn btn-green !rounded mb-1 min-w-[200px] w-fit mx-auto unlock-chapter-btn"
                                data-chapter="297136">Mở khóa chương</a>

                            <a @click="showFormBuyCombo" href="javascript:void(0)" title="Mở Combo/Full"
                                class="btn btn-open !rounded text-white bg-[#f90] min-w-[200px] w-fit mx-auto mb-1 btn-unlock-all-chapter"><i
                                    class="fa-solid fa-gift mr-2"></i> Mở Combo/Full</a>
                            <a href="{{ route('member.payment.client') }}" title="Thêm Linh Thạch"
                                class="btn btn-green !rounded mb-1 min-w-[200px] w-fit mx-auto"><i
                                    class="fa-solid fa-crown mr-1"></i> Thêm Linh Thạch</a>
                        </div>
                    </div>
                </template>

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

                <div class="justify-center mb-4" :class="{ 'flex': show.chapter_bottom }" hidden>
                    <select class="xl:py-2 xl:px-4 bg-[#128c7e] mx-1 py-2 text-white" onchange="location = this.value;">
                        @foreach ($chaper_list as $item)
                            <option
                                value="{{ route('client.chaper', ['story_slug' => $story['slug'], 'chaper_position' => $item['position']]) }}"
                                {{ $item['id'] == $chaper['id'] ? 'selected' : '' }}>{{ $item['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <a @click="showFormReport" href="javascript:void(0)" title="Báo lỗi chương"
                        class="btn bg-[#f0ad4e] !text-white font-bold mr-2 last:mr-0 sm:min-w-[130px] mb-2">
                        <i class="fa-solid fa-triangle-exclamation mr-2"></i>Báo lỗi chương
                    </a>
                </div>
            </div>


        </section>

        <div v-if="loading" id="loader">
            <div class="sk-cube-grid">
                <div class="sk-cube sk-cube1"></div>
                <div class="sk-cube sk-cube2"></div>
                <div class="sk-cube sk-cube3"></div>
                <div class="sk-cube sk-cube4"></div>
                <div class="sk-cube sk-cube5"></div>
                <div class="sk-cube sk-cube6"></div>
                <div class="sk-cube sk-cube7"></div>
                <div class="sk-cube sk-cube8"></div>
                <div class="sk-cube sk-cube9"></div>
            </div>
        </div>

        <div ref="formReportChapter"
            class="fixed top-0 right-0 left-0 z-50 flex h-full w-full items-center justify-center overflow-hidden overflow-y-auto overflow-x-hidden bg-[#00000099] duration-500 md:inset-0 invisible pointer-events-none opacity-0">
            <div v-if="show_error_report" @click="show_error_report = false" class="fixed top-0 right-0 bottom-0 left-0">
            </div>
            <div
                class="popup-form md:max-w-[500px] bg-white relative mx-auto max-h-screen w-full max-w-[90%] overflow-y-auto rounded-md md:h-auto">
                <span @click="show_error_report = false"
                    class="close-modal bg-[#128c7e] rounded p-1 flex w-6 h-6 items-center justify-center cursor-pointer absolute top-4 right-4 z-[1]">
                    <img src="{{ asset('assets/images/close-modal.png') }}" alt="">
                </span>
                <p
                    class="font-medium text-center text-[#000] text-[1.3rem] p-4 border-b-[1px] border-solid border-[#ebebeb]">
                    Báo lỗi chương</p>
                <div id="report_chapter_error_form" class="form p-4 formValidation" accept-charset="utf8">

                    <p class="text-note text-[#607d8b] mb-2">Nhập mô tả lỗi: <b>@{{ itemDetail.content.length }}/500</b></p>
                    <textarea v-model="itemDetail.content"
                        class="form-control border border-solid border-[#ebebeb] bg-white rounded-md h-16 resize-none mb-2 w-full px-3 py-2"></textarea>
                    <span>Nội dung báo cáo không được quá 500 từ</span>
                    <button @click="sendReportChapter" id="report_chapter_error_btn" class="btn btn-green !rounded">Báo
                        cáo</button>
                </div>
            </div>
        </div>
        <div v-if="show_setting" @click="show_setting = false" class="fixed top-0 right-0 bottom-0 left-0"></div>
        <div class="chapter-action-box-wrapper">
            <div class="position-relative">
                <div class="setting-frontend font-bold" :class="{ 'active': show_setting }">
                    <p class="title-setting text-[1rem] lg:text-[1.25rem]">Cài đặt giao diện</p>
                    <div class="p-3">
                        <div class="flex justify-between items-center mb-8">
                            <p class="title-item text-[0.9375rem]">Cỡ chữ (<span
                                    class="preview-value">@{{ styles.fontSize }}</span>px):</p>
                            <input v-model="styles.fontSize" type="range" id="fontsize" min="12"
                                max="30" />
                        </div>
                        <div class="flex justify-between items-center mb-8">
                            <p class="title-item text-[0.9375rem]">Cách dòng (<span
                                    class="preview-value">@{{ styles.lineHeight }}</span>px):</p>
                            <input v-model="styles.lineHeight" type="range" id="lineheight" min="20"
                                max="50" />
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
                    <a @click="show_setting = true" href="javascript:void(0)"
                        class="item-action show-chapter-theme-setting" title="Cài đặt giao diện">
                        <i class="fa-solid fa-gear"></i>
                    </a>
                    <a @click="scrollTarget" href="javascript:void(0)" class="item-action scroll-to-commnet-box"
                        title="Bình luận truyện">
                        <i class="fa-solid fa-comments"></i>
                    </a>
                    <a href="{{ route('client.story', ['story_slug' => $story['slug']]) }}" class="item-action"
                        title="Chi tiết truyện">
                        <i class="fa-solid fa-book"></i>
                    </a>
                    <a @click="resetStyles" href="javascript:void(0)" class="item-action" title="Trở về mặc định">
                        <i class="fa-solid fa-repeat"></i>
                    </a>
                    <a @click="showFormReport" href="javascript:void(0)" class="item-action"
                        modal-rs-target="modal-report" title="Báo lỗi chương">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </a>
                </div>
            </div>
        </div>
        {{-- Combo Mua chuowng Start --}}
        <div v-if="show_buy_chapter" class="jconfirm-light jconfirm-open" :class="{ 'jconfirm': show_buy_chapter }">
            <div class="jconfirm-bg"
                style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1);"></div>
            <div class="jconfirm-scrollpane">
                <div class="jconfirm-row">
                    <div class="jconfirm-cell">
                        <div class="jconfirm-holder" style="padding-top: 40px; padding-bottom: 40px;">
                            <div class="jc-bs3-container container">
                                <div
                                    class="jc-bs3-row row justify-content-md-center justify-content-sm-center justify-content-xs-center justify-content-lg-center">
                                    <div class="jconfirm-box-container jconfirm-animated open-full-combo-box jconfirm-no-transition"
                                        style="transform: translate(0px, 0px); transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1);">
                                        <div class="jconfirm-box jconfirm-hilight-shake jconfirm-type-default jconfirm-type-animated"
                                            role="dialog" aria-labelledby="jconfirm-box27957" tabindex="-1"
                                            style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); transition-property: all, margin;">
                                            <div @click="show_buy_chapter = false" class="jconfirm-closeIcon"
                                                style="display: block;">×</div>
                                            <div class="jconfirm-title-c"><span class="jconfirm-icon-c"></span><span
                                                    class="jconfirm-title">
                                                    <p class="title-open-full-combo">Mở Khóa Combo</p>
                                                </span></div>
                                            {{-- Step 1 --}}
                                            <div v-if="buy_combo_chapter.show == 'step_1'"
                                                class="jconfirm-content-pane no-scroll"
                                                style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: 298.422px; max-height: 741.141px;">
                                                <div class="jconfirm-content" id="jconfirm-box27957">
                                                    <div class="show-form-unlock-chapter-combo-result">
                                                        <form
                                                            class="relative text-[14px] md:text-[16px] pb-[5px] show-form-unlock-chapter-combo">

                                                            <div class="text-[#128c7e]">
                                                                <p class="mb-[2px]">- Số chương còn lại bạn chưa mở là
                                                                    <span
                                                                        class="font-bold italic">@{{ buy_combo_chapter.total_chapter }}</span>
                                                                    ,
                                                                    tương ứng là <span
                                                                        class="font-bold italic">@{{ buy_combo_chapter.total_coint }}LT</span>
                                                                    !
                                                                </p>

                                                            </div>
                                                            <p class="mb-1 mt-3 font-bold text-[#128c7e]">Từ chương (STT)
                                                            </p>
                                                            <select class="border border-[#ced4da] rounded py-2 w-[100%]"
                                                                v-model="buy_combo.start">
                                                                <option v-for="item in buy_combo_chapter.list_chapter"
                                                                    :value="item.position">@{{ item.name }}</option>
                                                            </select>

                                                            <p class="mb-1 mt-3 font-bold text-[#128c7e]">Đến chương (STT)
                                                            </p>
                                                            <select class="border border-[#ced4da] rounded py-2 w-[100%]"
                                                                v-model="buy_combo.end">
                                                                <option v-for="item in buy_combo_chapter.list_chapter"
                                                                    :value="item.position">@{{ item.name }}</option>
                                                            </select>
                                                            <p v-if="buy_combo.start > buy_combo.end"
                                                                class="text-[14px] text-[#ef1310]">Hãy lựa chọn chương theo
                                                                thứ tự tăng dần để mua combo!</p>

                                                            <p class="my-4 text-[#128c7e]">Hệ thống sẽ tự động lọc những
                                                                chương bạn đã mở!</p>
                                                            <div class="jconfirm-buttons !float-none !pb-0 inline-block">
                                                                <button @click="handleBuyCombo" type="button"
                                                                    class="btn btn-main-shadow !mb-0">Mở Combo</button>
                                                            </div>
                                                            <div class="jconfirm-buttons">
                                                                <button @click="show_buy_chapter = false" type="button"
                                                                    class="btn btn-default">Hủy</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Step 1  --}}
                                            {{-- Step 2 --}}
                                            <div v-if="buy_combo_chapter.show === 'step_2'"
                                                class="jconfirm-content-pane no-scroll"
                                                style="transition-duration: 0.4s; transition-timing-function: cubic-bezier(0.36, 0.55, 0.19, 1); height: 104.422px; max-height: 741.141px;">
                                                <div class="jconfirm-content" id="jconfirm-box68931">
                                                    <div class="show-form-unlock-chapter-combo-result">
                                                        <div class="show-form-unlock-chapter-combo-result">
                                                            <form
                                                                class="relative text-[14px] md:text-[16px] pb-[5px] formValidation"
                                                                accept-charset="utf8">

                                                                <div class="text-[#128c7e] mb-4">
                                                                    <p class="mb-[2px]">- Số chương sẽ mở: <span
                                                                            class="font-bold italic">@{{ buy_combo_chapter.show_chapter }}</span></p>
                                                                    <p class="mb-[2px]">- Giá: <span
                                                                            class="font-bold italic">@{{ buy_combo_chapter.show_coint }}LT</span></p>
                                                                </div>
                                                                <div
                                                                    class="jconfirm-buttons !float-none !pb-0 inline-block">
                                                                    <button @click="handleBuyComboServer" type="button"
                                                                        class="btn btn-main-shadow !mb-0">Thanh
                                                                        toán</button>
                                                                    <button @click="buy_combo_chapter.show = 'step_1'"
                                                                        type="button"
                                                                        class="btn btn-gray-shadow !mb-0 btn-unlock-all-chapter">Quay
                                                                        lại</button>
                                                                </div>
                                                                <div class="jconfirm-buttons">
                                                                    <button @click="show_buy_chapter = false"
                                                                        type="button"
                                                                        class="btn btn-default">Hủy</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Step 2 --}}
                                            <div class="jconfirm-clear"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Combo Mua chuowng End --}}

    </div>

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
    {{-- Quảng cáo adsense Start --}}
    @if (((bool) env('IS_ADSENSE', false)) && $chaper['money'] == 0)
        @include('parts.ads.adsense_social')
    @endif
    {{-- Quảng cáo adsense End --}}

    {{-- <a id="scroll-to-top-btn" class="bottom-right"><i class="fas fa-angle-double-up"></i></a> --}}
    <script>
        var vue_chapter_app = {
            loading: false,
            show_setting: false,
            show_error_report: false,
            show_buy_chapter: false,
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
            buy_combo_chapter: {
                total_chapter: 0,
                total_coint: 0,
                list_chapter: [],
                show: 'step_1',
                show_chapter: 0,
                show_coint: 0
            },
            buy_combo: {
                start: 0,
                end: 0,
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
                isAffiliate() {
                    if (!(this.chaper.position % 10 == 0) || (this.chaper.money > 0)) {
                        return true;
                    } else {
                        return false;
                    }
                }
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
                        block: 'start' // Căn lề trên của mục tiêu sát mép trình duyệt
                    });
                },
                affLinkClick() {
                    this.chaper.position += 1;
                    
                },

                async sendReportChapter() {
                    let jsonData = await new RouteApi().post(`${this.apiMember}/report-chapter`, this
                        .itemDetail);
                    this.show_error_report = false;
                    if (jsonData.status) {
                        jAlertCLient(jsonData.message, 'success');
                    } else {
                        jAlertCLient(jsonData.message, 'danger');
                    }
                },
                async buyChapter() {
                    this.loading = true;
                    let jsonData = await new RouteApi().post(`${this.apiMember}/order-chapter`, {
                        story_id: this.story.id,
                        chaper_position: this.chaper.position
                    });
                    this.loading = false;

                    if (jsonData.status) {
                        jAlertCLient(jsonData.message, 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
                    } else {
                        jAlertCLient(jsonData.message, 'danger');
                    }
                },
                async getBuyComboChapter() {
                    this.loading = true;
                    let jsonData = await new RouteApi().get(
                        `${this.apiMember}/total-buy-chapter/${this.story.id}`);
                    if (jsonData.status) {
                        this.buy_combo_chapter.total_chapter = jsonData.total_chapter;
                        this.buy_combo_chapter.total_coint = jsonData.total_coint;
                        this.buy_combo_chapter.show = 'step_1';
                        this.buy_combo_chapter.list_chapter = jsonData.data;
                        this.buy_combo.start = jsonData.data[0].position;
                        this.buy_combo.end = jsonData.data[jsonData.data.length - 1].position;
                    } else {
                        jAlertCLient(jsonData.message, 'danger');
                    }
                    this.loading = false;
                },
                async showFormBuyCombo() {
                    await this.getBuyComboChapter();
                    this.show_buy_chapter = true;
                },
                handleBuyCombo() {
                    if (this.buy_combo.start > this.buy_combo.end) {
                        jAlertCLient("Hãy lựa chọn chương theo thứ tự tăng dần để mua combo!", 'danger');
                        return;
                    }
                    // Xử lý logic mua combo ở đây
                    this.buy_combo_chapter.show_chapter = 0;
                    this.buy_combo_chapter.show_coint = 0;
                    for (let i = 0; i < this.buy_combo_chapter.list_chapter.length; i++) {
                        const chapter = this.buy_combo_chapter.list_chapter[i];
                        if (chapter.position >= this.buy_combo.start && chapter.position <= this.buy_combo.end) {
                            this.buy_combo_chapter.show_chapter += 1;
                            this.buy_combo_chapter.show_coint += chapter.money;
                        }
                    }
                    this.buy_combo_chapter.show = 'step_2';
                },
                async handleBuyComboServer() {
                    this.loading = true;
                    let jsonData = await new RouteApi().post(`${this.apiMember}/buy-combo-chapter`, {
                        story_id: this.story.id,
                        start_position: this.buy_combo.start,
                        end_position: this.buy_combo.end
                    });
                    this.loading = false;
                    if (jsonData.status) {
                        jAlertCLient(jsonData.message, 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 3000);
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
