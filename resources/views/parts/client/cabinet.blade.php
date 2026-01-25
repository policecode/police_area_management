<?php
use Illuminate\Support\Facades\Auth;
$user = Auth::user();

?>
<div id="story__cabinet_vue">
    <div class="box-storyboard" :class="{ 'active': active }">
        <div class="head p-4 flex items-center justify-content-between">
            <p class="title font-bold text-[1.25rem]">
                Tàng kinh các
            </p>
            <span @click="active=false" class="btn-close-board"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <div class="px-4 mb-4 ">
            <ul
                class="tab-categories-title tab-categories-title-admin border border-solid bg-[#128c7e] border-[#128c7e] text-[13px] flex justify-between items-center rounded-xl overflow-hidden text-white storyboard-box">
                <li @click="querySearch.status='read';">
                    <a href="javascript:void(0)" title="Công pháp đang luyện"
                        class="block not-login main-item-storyboard text-center p-2 border-r-[1px] border-solid border-[#128c7e] bg-white text-[#128c7e]"
                        :class="{ 'active': querySearch.status === 'read' }">Công pháp đang luyện</a>
                </li>
                {{-- <li>
                    <a href="javascript:void(0)" title="Truyện đang mua" data-type="2"
                        data-action="https://banlong.us/load-item-storyboard"
                        class="block not-login text-center p-2 border-r-[1px] border-solid border-[#128c7e] bg-white text-[#128c7e]">Truyện
                        đang mua</a>
                </li> --}}
                <li @click="querySearch.status='favorite';">
                    <a href="javascript:void(0)" title="Truyện đã lưu"
                        class="block not-login text-center p-2 border-r-[1px] border-solid border-[#128c7e] bg-white text-[#128c7e]"
                        :class="{ 'active': querySearch.status === 'favorite' }">Công
                        pháp đã lưu</a>
                </li>
            </ul>
        </div>
        @if ($user)
            <div v-if="loading" class="in-loading text-center">
                <div class="loader-dot">
                    <div class="loader-item"></div>
                    <div class="loader-item"></div>
                    <div class="loader-item"></div>
                    <div class="loader-item"></div>
                </div>
            </div>
            <div class="board-content board-content-result flex-1 p-4">
                {{-- Read Start --}}
                <div v-if="querySearch.status === 'read'" v-for="(item, index) in items"
                    class="card-readed p-4 relative">
                    <div class="flex items-center justify-between mb-3">
                        <a :href="item.story_url" :title="item.title"
                            class="name line-camp-1 2xl:text-[1.25rem] mr-4">
                            <span v-if="item.is_convert" class="text-[#128c7e]">[Convert]</span>
                            <span v-else style="color:#0000ff;">[Dịch]</span>
                            @{{ capitalizeFirstLetter(item.story_title) }}
                        </a>
                        <a :href="item.author_url"
                            class="author text-[#999] text-[0.875rem] line-camp-1">@{{ capitalizeFirstLetter(item.author_name) }}</a>
                    </div>
                    <a :href="item.chapter_url" class="cate-items text-[#999] text-[0.875rem]">
                        @{{ capitalizeFirstLetter(item.chapter_title) }}
                    </a>
                </div>
                {{-- Read End --}}
                {{-- Favorite Start --}}
                <div v-if="querySearch.status === 'favorite'" v-for="(item, index) in items"
                    class="card-readed rounded p-4 relative">
                    <div class="block mr-2">
                        <a :href="item.story_url" :title="item.story_title"
                            class="name font-bold lg:text-[1.25rem] text-[1rem] text-[#222222] block mb-1">
                            @{{ capitalizeFirstLetter(item.story_title) }}
                        </a>
                    </div>
                    <div class="my-1">
                        <a :href="item.author_url"
                            class="text-[0.8125rem] text-[#999] inline-block mr-4">@{{ capitalizeFirstLetter(item.author_name) }}</a>
                        <span v-if="item.is_convert" class="inline-block text-[#128c7e]">[Convert]</span>
                        <span v-else class="inline-block text-[0.875rem]" style="color: #0000ff">[Dịch]</span>
                    </div>
                    <div class="story-info lg:text-[0.875rem]">
                        {{-- <span class="text-[#dc3545] mr-2">2.351.447 chữ</span> --}}
                        <span class="text-[#28a745] mr-2">@{{ item.total_chapter }} chương</span>
                        <span class="text-[#007bff]">@{{ item.view_count }} đọc</span>
                    </div>
                    <span @click="clearFavoriteStory(item.story_id, index)"
                        class="delete absolute top-1 right-2 z-[3] text-[#252525] hover:text-[#de3939] cursor-pointer delete-item-storyboard">
                        <i class="fa-solid fa-xmark"></i>
                    </span>
                </div>
                {{-- Favorite End --}}

            </div>
            <div class="board-footer py-4 text-center">
                <a href="{{ route('member.mystory') }}" title="Tàng Kinh Các" class="link">Xem Đầy Đủ Tàng Kinh
                    Các</a>
            </div>
        @else
            <div v-if="querySearch.status === 'read'" class="board-content board-content-result flex-1 p-4">
                <div v-for="(item, index) in items"
                    class="card-readed p-4 relative">
                    <a @click="clearStory(index)" href="javascript:void(0)" title="Xóa"
                        class="delete-item delete-item-storyboard-lc"><i class="fa-solid fa-xmark"></i></a>
                    <div class="flex items-center justify-between mb-3">
                        <a :href="item.link" :title="item.title"
                            class="name line-camp-1 2xl:text-[1.25rem] mr-4">
                            <span v-if="item.is_convert" class="text-[#128c7e]">[Convert]</span>
                            <span v-else style="color:#0000ff;">[Dịch]</span>
                            @{{ capitalizeFirstLetter(item.title) }}
                        </a>
                        {{-- <a :href="item.link_author"
                            class="author text-[#999] text-[0.875rem] shrink-0 line-camp-1">@{{ capitalizeFirstLetter(item.author_name) }}</a> --}}
                    </div>
                    <a :href="item.link_chapter" class="cate-items text-[#999] text-[0.875rem]">
                        @{{ capitalizeFirstLetter(item.chapter_name) }}
                    </a>
                </div>
            </div>
            <p v-else class="p-3 text-center">Vui lòng đăng nhập để sử dụng tính năng này!</p>
        @endif
    </div>
    <div @click="active=false" class="overlay-board" :class="{ 'show': active }"></div>
</div>

<script>
    var story_cabinet_app = {
        loading: false,
        active: false,
        getItemUrl: '',
        items: [],
        itemDetail: {},
        user: {{ Illuminate\Support\Js::from($user) }},
        querySearch: {
            total: 0,
            page: 1,
            per_page: 10,
            keyword: '',
            status: 'read',
            order_by: 'updated_at',
            order_type: 'DESC'
        },
        apiUrl: FVN_LARAVEL_HOME + '/api/member',
    };
    var appStoryCabinet = new Vue({
        el: '#story__cabinet_vue',
        data: story_cabinet_app,
        mounted: function() {
            // this.getItems();

        },
        computed: {

        },
        methods: {
            async getItems() {
                if (this.user) {
                    this.items = [];
                    this.loading = true;
                    this.buildQueryItem();
                    // Lưu trạng thái url cuối cùng trước khi chuyển trang
                    const jsonData = await new RouteApi().get(this.getItemUrl)
                    this.loading = false;
                    if (jsonData.result) {
                        this.items = jsonData.data;
                    } else {
                        this.items = [];
                    }
                } else {
                    this.items = LocalStorageHelper.getObject('fvn_story_history', []);
                }
                // console.log(this.items);
            },
            clearStory(index) {
                this.items.splice(index, 1);
                LocalStorageHelper.setObject('fvn_story_history', this.items);
            },
            async clearFavoriteStory(story_id, index) {

                let jsonData = await new RouteApi().post(`${this.apiUrl}/save-favorite-story`, {
                    story_id: story_id
                });
                if (jsonData.status) {
                    jAlertCLient(jsonData.message, 'success');
                    this.items.splice(index, 1);
                } else {
                    jAlertCLient(jsonData.message, 'danger');
                }
            },
            buildQueryItem(task, changeUrl) {
                if (changeUrl == undefined) {
                    changeUrl = true;
                }
                if (task == 'export') {
                    this.getItemUrl = this.apiUrl + '.export';
                } else if (task) {
                    this.getItemUrl = this.apiUrl + '/my-story?is_paginate=1';
                } else {
                    this.getItemUrl = this.apiUrl + '/my-story?is_paginate=';
                }
                for (const i in this.querySearch) {
                    let value = this.querySearch[i];
                    if (value) {
                        if (i == 'book_date_min' || i == 'book_date_max') {
                            value = format_date(value);
                        }
                        this.getItemUrl += '&' + i + '=' + value;
                    }
                }

            },
            capitalizeFirstLetter(string) {
                if (string) {
                    const words = string.split(" ");
                    for (let i = 0; i < words.length; i++) {
                        if (words[i]) {
                            words[i] = words[i][0].toUpperCase() + words[i].substr(1);
                        }
                    }
                    string = words.join(" ");
                    return string;
                } else {
                    return '';
                }
            }
        },
        watch: {
            'active': function(newVal, oldVal) {
                if (newVal) {
                    this.getItems();
                }
            },
            'querySearch.status': function(newVal, oldVal) {
                this.getItems();
            }
        },
    });
</script>
