<?php
use App\Http\Helpers\SettingHelpers;
use App\Enums\TotalChapter;
use Illuminate\Support\Facades\Auth;

$option = SettingHelpers::getInstance();
$all_categories = get_all_categories();
// $totalChapter = TotalChapter::asArray();
$user = Auth::user();
?>
<h1 class="hidden">Truyện Full Việt</h1>
<header id="client_sidebar_app" class="header">
    <div class="header-top bg-[#f8f9fa] py-2">
        <div class="container flex items-center justify-between">
            <a href="{{ route('index') }}" title="{{ $option->getOptionValue('fvn_web_title') }}"
                class="h-logo block max-w-[150px] mr-2">
                <picture>
                    <source media="(min-width:0px)"
                        data-srcset="{{ $option->getOptionImage('fvn_logo') ? $option->getOptionImage('fvn_logo') : asset('assets/images/logo_text.png') }}"
                        srcset="{{ $option->getOptionImage('fvn_logo') ? $option->getOptionImage('fvn_logo') : asset('assets/images/logo_text.png') }}">
                    <img loading="auto"
                        src="{{ $option->getOptionImage('fvn_logo') ? $option->getOptionImage('fvn_logo') : asset('assets/images/logo_text.png') }}"
                        data-src="{{ $option->getOptionImage('fvn_logo') ? $option->getOptionImage('fvn_logo') : asset('assets/images/logo_text.png') }}"
                        alt="Truyện Full Việt" class="img-fluid">
                </picture>
            </a>
            <div class="header-form xl:flex-1 max-w-[70%] flex items-center justify-between">
                <form action="{{ route('client.search') }}" method="get"
                    class="relative form-search-header rounded-3xl hidden xl:block form-search-autocomplete"
                    accept-charset="utf8" autocomplete="off">
                    <input type="text" v-model="querySearch.keyword" name="keyword"
                        placeholder="Tìm truyện,tác giả..."
                        class="w-[475px] py-[0.375rem] px-[0.75rem] rounded-3xl border border-solid border-[#128c7e]">
                    <button type="submit"
                        class="btn-search absolute top-0 right-0 h-full py-[0.375rem] px-[0.75rem] text-[#128c7e]">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <div class="auto-complete-result" :class="{ 'block': querySearch.keyword.length > 0 }">
                        <div class="in-loading text-center" :class="{ 'block': loading }">
                            <div class="loader-dot">
                                <div class="loader-item"></div>
                                <div class="loader-item"></div>
                                <div class="loader-item"></div>
                                <div class="loader-item"></div>
                            </div>
                        </div>
                        <div class="text-result scrollstyle" :class="{ 'block': !loading }"
                            style="max-height:80vh;overflow:auto;">
                            <template v-if="items.length">
                                <div v-for="(item, index) in items"
                                    class="item-story-search p-2 border-b border-[#d9d9d9] hover:bg-[#f5f5f5]">
                                    <a :href="item.url" class="flex" title="Quang Âm Chi Ngoại">
                                        <div class="img w-[60px] relative">
                                            <div class="c-img pt-[140%] rounded-md overflow-hidden">
                                                <picture>
                                                    <source media="(min-width:0px)" {{-- :data-srcset="item.thumbnail" --}}
                                                        :srcset="item.thumbnail">
                                                    <img loading="lazy" {{-- :data-src="item.thumbnail" --}} :src="item.thumbnail"
                                                        :alt="item.title" class="img-fluid">
                                                </picture>
                                            </div>
                                        </div>
                                        <div
                                            class="content w-[calc(100%-60px)] flex flex-wrap justify-between flex-col pl-2">
                                            <div class="w-full">
                                                <h3 class="text-[0.9375rem] name font-bold text-[#128c7e]">
                                                    {{-- <span class="highlight">Quang</span>  --}}
                                                    @{{ capitalizeFirstLetter(item.title) }}
                                                </h3>
                                                <div class="flex flex-wrap items-center">
                                                    <p class="text-[0.75rem] block line-clamp-1 text-[#888] mt-1 mr-5">
                                                        <i class="fa-solid fa-user-pen"></i>
                                                        @{{ item.author_name }}
                                                    </p>
                                                    <span
                                                        class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded mt-1"
                                                        style="color: #0000ff;border-color:#0000ff">@{{ item.status_name }}</span>
                                                </div>
                                                <div
                                                    class="text-[#999999] leading-[1.1rem] inline-block text-[0.75rem] line-clamp-1 mt-2">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </template>

                            <p v-else class="text-center py-2">@{{ msgSearch }}</p>
                        </div>
                    </div>
                </form>
                <ul class="flex items-center user-option">
                    <li class="mr-5 last:mr-0">
                        <a href="javascript:void(0)" title="Tủ truyện" class="mystory" show-story>
                            <img src="{{ asset('assets/images/bookmark2.png') }}" class="object-contain w-7"
                                alt="Tủ truyện">
                        </a>
                    </li>
                    <li class="mr-5 last:mr-0 btn-login">
                        <div class="block xl:hidden">
                            <div class="user sm:relative flex show-info-user">
                                <span
                                    class="inline-block overflow-hidden rounded-full avatar w-7 h-7 img_full img-h-full cursor-pointer">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="{{ asset('assets/uploads/users/avatar/thumbs/150x0/user_3.png') }}"
                                            srcset="{{ asset('assets/uploads/users/avatar/thumbs/150x0/user_3.png') }}">
                                        <img loading="auto"
                                            src="{{ asset('assets/uploads/users/avatar/thumbs/150x0/user_3.png') }}"
                                            data-src="{{ asset('assets/uploads/users/avatar/thumbs/150x0/user_3.png') }}"
                                            alt="Truyện Full Việt" class="img-fluid">
                                    </picture>
                                </span>
                                <div
                                    class="box-option absolute top-[60px] sm:top-[100%] right-0 z-10 sm:w-[400px] w-full">
                                    <div class="box p-2 rounded-lg border border-solid border-[#128c7e] bg-white">
                                        <div class="box-info flex">
                                            <div class="info-user flex-1 text-center">
                                                <a href="dang-nhap.html"
                                                    class="inline-block px-4 py-2 rounded border border-solid border-[#128c7e] mr-5"
                                                    title="Đăng nhập">
                                                    <i class="fa-solid fa-right-to-bracket text-[#128c7e] mr-1"></i></i>
                                                    <span>Đăng nhập</span>
                                                </a>
                                                <a href="dang-ky.html"
                                                    class="inline-block px-4 py-2 rounded border border-solid border-[#128c7e]"
                                                    title="Đăng ký">
                                                    <i class="fa-solid fa-user-plus text-[#128c7e] mr-1"></i>
                                                    <span>Đăng ký</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hidden xl:block">
                            <a href="dang-nhap.html" class="inline-block mr-5" title="Đăng nhập">
                                <i class="fa-solid fa-right-to-bracket text-[#128c7e] mr-1"></i></i>
                                <span>Đăng nhập</span>
                            </a>
                            <a href="dang-ky.html" class="inline-block" title="Đăng ký">
                                <i class="fa-solid fa-user-plus text-[#128c7e] mr-1"></i>
                                <span>Đăng ký</span>
                            </a>
                        </div>
                    </li>
                    <li class="mr-5 last:mr-0 menu-mobile block xl:hidden relative">
                        <span class="show-menu-mobile flex cursor-pointer">
                            <svg viewBox='0 0 30 30' class="w-[30px]" xmlns='http://www.w3.org/2000/svg'>
                                <path stroke='rgba(0, 0, 0, 0.5)' stroke-width='2' stroke-linecap='round'
                                    stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22' />
                            </svg>
                        </span>
                        <div
                            class="box-menu-on-mobile absolute top-[100%] right-0 z-10 bg-white border border-solid border-[#128c7e] w-[280px] rounded-2xl p-2 hidden">
                            <div class="flex items-center">
                                <form action="{{ route('client.search') }}" method="get"
                                    class="relative overflow-hidden form-search-header rounded-3xl mr-4 flex-1 md:flex-none"
                                    accept-charset="utf8">
                                    <input type="text" name="keyword" placeholder="Tìm truyện, tác giả..."
                                        class="py-[0.375rem] px-[0.75rem] rounded-3xl border border-solid border-[#128c7e]">
                                    <button
                                        class="btn-search absolute top-0 right-0 h-full py-[0.375rem] px-[0.75rem] text-[#128c7e]">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </form>
                                <a href="{{route('client.huongdan')}}" title="Hướng dẫn" class="link text-[#128c7e]">Hướng
                                    dẫn</a>
                            </div>
                            <hr class="w-full h-[1px] bg-[#128c7e] my-2">
                            <ul>
                                <li>
                                    <a href="dang-nhap.html" class="inline-block" title="Đăng nhập">
                                        <i class="fa-solid fa-right-to-bracket text-[#128c7e] mr-1"></i></i>
                                        <span>Đăng nhập</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="dang-ky.html" class="inline-block" title="Đăng ký">
                                        <i class="fa-solid fa-user-plus text-[#128c7e] mr-1"></i>
                                        <span>Đăng ký</span>
                                    </a>
                                </li>
                                <li><a href="javascript:void(0)" modal-rs-target="modal_cate" title="Thể loại">Thể
                                        loại</a></li>
                                <li><a href="{{route('client.full-story')}}" title="Hoàn thành">Hoàn thành</a>
                                </li>
                            </ul>
                            <hr class="w-full h-[1px] bg-[#128c7e] mb-2">
                            <div class="flex items-center justify-between mb-2">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-mobile block xl:hidden pb-2 bg-[#f8f9fa]">
        <div class="container flex items-center justify-between">
            <form action="{{ route('client.search') }}" method="get"
                class="relative form-search-header rounded-3xl mr-4 flex-1 md:flex-none form-search-autocomplete"
                accept-charset="utf8">
                <input type="text" v-model="querySearch.keyword" name="keyword"
                    placeholder="Tìm truyện, tác giả..."
                    class=" md:w-[475px] py-[0.375rem] px-[0.75rem] rounded-3xl border border-solid border-[#128c7e]">
                <button type="submit"
                    class="btn-search absolute top-0 right-0 h-full py-[0.375rem] px-[0.75rem] text-[#128c7e]">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <div class="auto-complete-result" :class="{ 'block': querySearch.keyword.length > 0 }">
                    <div class="in-loading text-center" :class="{ 'block': loading }">
                        <div class="loader-dot">
                            <div class="loader-item"></div>
                            <div class="loader-item"></div>
                            <div class="loader-item"></div>
                            <div class="loader-item"></div>
                        </div>
                    </div>
                    <div class="text-result scrollstyle" :class="{ 'block': !loading }"
                        style="max-height:80vh;overflow:auto">
                        <template v-if="items.length">
                            <div v-for="(item, index) in items"
                                class="item-story-search p-2 border-b border-[#d9d9d9] hover:bg-[#f5f5f5]">
                                <a :href="item.url" class="flex" title="Quang Âm Chi Ngoại">
                                    <div class="img w-[60px] relative">
                                        <div class="c-img pt-[140%] rounded-md overflow-hidden">
                                            <picture>
                                                <source media="(min-width:0px)" {{-- :data-srcset="item.thumbnail" --}}
                                                    :srcset="item.thumbnail">
                                                <img loading="lazy" {{-- :data-src="item.thumbnail" --}} :src="item.thumbnail"
                                                    :alt="item.title" class="img-fluid">
                                            </picture>
                                        </div>
                                    </div>
                                    <div
                                        class="content w-[calc(100%-60px)] flex flex-wrap justify-between flex-col pl-2">
                                        <div class="w-full">
                                            <h3 class="text-[0.9375rem] name font-bold text-[#128c7e]">
                                                {{-- <span class="highlight">Quang</span>  --}}
                                                @{{ capitalizeFirstLetter(item.title) }}
                                            </h3>
                                            <div class="flex flex-wrap items-center">
                                                <p class="text-[0.75rem] block line-clamp-1 text-[#888] mt-1 mr-5">
                                                    <i class="fa-solid fa-user-pen"></i>
                                                    @{{ item.author_name }}
                                                </p>
                                                <span
                                                    class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded mt-1"
                                                    style="color: #0000ff;border-color:#0000ff">@{{ item.status_name }}</span>
                                            </div>
                                            <div
                                                class="text-[#999999] leading-[1.1rem] inline-block text-[0.75rem] line-clamp-1 mt-2">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </template>

                        <p v-else class="text-center py-2">@{{ msgSearch }}</p>
                    </div>
                </div>
            </form>
            <div class="flex items-center">
                <a href="{{route('client.huongdan')}}" title="Hướng dẫn" class="link text-[#128c7e] mr-4 last:mr-0">Hướng
                    dẫn</a>
                {{-- <a href="dang-nhap.html" title="Đăng truyện" class="link text-[#128c7e] mr-4 last:mr-0">Đăng
                    truyện</a> --}}
            </div>
        </div>
    </div>
</header>

<script>
    var vue_client_sidebar_app = {
        loading: false,
        items: [],
        msgSearch: '',
        // isThemeLight: LocalStorageHelper.get('sidebar_theme_web', false),
        querySearch: {
            total: 0,
            page: 1,
            per_page: 10,
            keyword: '',
            order_by: 'id',
            order_type: 'DESC'
        },
        apiUrl: FVN_LARAVEL_HOME + '/api',
        pointInTime: null
    };
    var appClientSideBar = new Vue({
        el: '#client_sidebar_app',
        data: vue_client_sidebar_app,
        mounted: function() {
            // this.changeThemes();
        },
        computed: {},
        methods: {
            async getItems() {
                this.items = [];

                this.buildQueryItem();
                const jsonData = await new RouteApi().get(this.getItemUrl)
                if (jsonData.result) {
                    if (jsonData.data.length > 0) {
                        this.items = jsonData.data;
                    } else {
                        this.msgSearch = 'Không có truyện phù hợp';
                    }
                } else {
                    this.items = [];
                    // jAlert(jsonData.message);
                }
                this.loading = false;
            },
            buildQueryItem() {
                this.getItemUrl = this.apiUrl + '/search/keyword?is_paginate=0';
                let paramSearch = {};
                for (const i in this.querySearch) {
                    let value = this.querySearch[i];
                    if (i == 'book_date_min' || i == 'book_date_max') {
                        value = format_date(value);
                    }
                    paramSearch[i] = value
                    this.getItemUrl += '&' + i + '=' + value;
                }
            },

            capitalizeFirstLetter(string) {
                const words = string.split(" ");
                for (let i = 0; i < words.length; i++) {
                    words[i] = words[i][0].toUpperCase() + words[i].substr(1);
                }
                string = words.join(" ");
                return string;
            }
        },
        watch: {
            'querySearch.keyword'(newVal) {
                this.loading = true;
                this.msgSearch = '';
                this.items = [];
                if (this.pointInTime) {
                    clearTimeout(this.pointInTime);
                }
                if (newVal.length > 3) {
                    this.pointInTime = setTimeout(() => {
                        this.getItems();
                    }, 1000);
                } else {
                    this.pointInTime = setTimeout(() => {
                        this.msgSearch = 'Từ khóa tìm kiếm phải nhiều hơn 3 ký tự';
                        this.loading = false;
                    }, 1000);
                }
            }
        },
    });
</script>
