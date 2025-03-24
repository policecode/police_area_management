<?php
use App\Enums\CategoryType;

?>
@extends('layouts.frontend_v2')
@section('head')
    <meta name="robots" content="none" />
    <meta name="googlebot" content="none">
@endsection
@section('content')
    <script src="{{ asset('assets_global/js/vue-input.js') }}"></script>
    @include('client_page.part_tags.part_navbar_page')
    
    <div id="fvn_super_search" class="container">
        <div v-if="showFillter" class="module-content bg-[#fefefe] border border-solid border-[#d8d8d8] rounded">
            <div class="flex items-center justify-between head-all p-3 pb-0">
                <h2 class="title font-bold 2xl:text-[1.5rem] text-[1.25rem] text-[#6c5ce7]">{{ CategoryType::CAT['value'] }}
                </h2>
            </div>
            <div class="flex flex-wrap -mx-1 p-2">
                <div v-for="item in CAT" class="sm:basis-1/3 md:basis-1/4 basis-1/2 px-1 mb-2">
                    <div class="flex items-center">
                        <input v-model="querySearch.cats" class="w-auto mr-2" type="checkbox" :value="item.id"
                            :id="item.id">
                        <label class="block" :for="item.id">@{{ item.name }}</label>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="showFillter" class="module-content bg-[#fefefe] border border-solid border-[#d8d8d8] rounded">
            <div class="flex items-center justify-between head-all p-3 pb-0">
                <h2 class="title font-bold 2xl:text-[1.5rem] text-[1.25rem] text-[#6c5ce7]">
                    {{ CategoryType::WORD['value'] }}
                </h2>
            </div>
            <div class="flex flex-wrap -mx-1 p-2">
                <div v-for="item in WORD" class="sm:basis-1/3 md:basis-1/4 basis-1/2 px-1 mb-2">
                    <div class="flex items-center">
                        <input v-model="querySearch.cats" class="w-auto mr-2" type="checkbox" :value="item.id"
                            :id="item.id">
                        <label class="block" :for="item.id">@{{ item.name }}</label>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="showFillter" class="module-content bg-[#fefefe] border border-solid border-[#d8d8d8] rounded">
            <div class="flex items-center justify-between head-all p-3 pb-0">
                <h2 class="title font-bold 2xl:text-[1.5rem] text-[1.25rem] text-[#6c5ce7]">
                    {{ CategoryType::CHARATER['value'] }}
                </h2>
            </div>
            <div class="flex flex-wrap -mx-1 p-2">
                <div v-for="item in CHARATER" class="sm:basis-1/3 md:basis-1/4 basis-1/2 px-1 mb-2">
                    <div class="flex items-center">
                        <input v-model="querySearch.cats" class="w-auto mr-2" type="checkbox" :value="item.id"
                            :id="item.id">
                        <label class="block" :for="item.id">@{{ item.name }}</label>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="showFillter" class="module-content bg-[#fefefe] border border-solid border-[#d8d8d8] rounded">
            <div class="flex items-center justify-between head-all p-3 pb-0">
                <h2 class="title font-bold 2xl:text-[1.5rem] text-[1.25rem] text-[#6c5ce7]">
                    {{ CategoryType::SECT['value'] }}
                </h2>
            </div>
            <div class="flex flex-wrap -mx-1 p-2">
                <div v-for="item in SECT" class="sm:basis-1/3 md:basis-1/4 basis-1/2 px-1 mb-2">
                    <div class="flex items-center">
                        <input v-model="querySearch.cats" class="w-auto mr-2" type="checkbox" :value="item.id"
                            :id="item.id">
                        <label class="block" :for="item.id">@{{ item.name }}</label>
                    </div>
                </div>
            </div>
        </div>

        <div v-if="showFillter" class="module-content bg-[#fefefe] border border-solid border-[#d8d8d8] rounded">
            <div class="flex items-center justify-between head-all p-3 pb-0">
                <h2 class="title font-bold 2xl:text-[1.5rem] text-[1.25rem] text-[#6c5ce7]">Từ khóa
                </h2>
            </div>
            <div class="flex flex-wrap -mx-1 p-2">
                <div class="basis-1/2 px-1 mb-2">
                    <div class="flex items-center">
                        <label class="block mr-2" for="input_keyword">Keyword</label>
                        <input v-model="querySearch.keyword" type="text"
                            class="w-auto py-[0.375rem] px-[0.75rem] border border-solid border-[#128c7e]"
                            id="input_keyword">
                    </div>
                </div>
                <div class="basis-1/2 px-1 mb-2">
                    <div class="flex items-center">
                        <label class="block mr-2">Sắp xếp theo</label>
                        <select v-model="querySearch.order_by"
                            class="w-auto py-[0.375rem] px-[0.75rem] border border-solid border-[#128c7e]">
                            <option v-for="item in optionOrder" :value="item.key">@{{ item.display }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="module-content bg-[#fefefe] border border-solid border-[#d8d8d8] rounded">
            <div class="flex flex-wrap -mx-1 p-2">
                <div class="sm:basis-1/3 md:basis-1/4 basis-1/2 px-1 mb-2">
                    <button v-if="showFillter" @click="searchItem" type="button"
                        class="text-center p-2 border border-solid border-[#128c7e] bg-white text-[#128c7e] hover:bg-[#17a2b8] hover:text-white">Tìm
                        kiếm</button>
                </div>

                <div class="sm:basis-1/3 md:basis-1/4 basis-1/2 px-1 mb-2">
                    <button v-if="showFillter" @click="showFillter=false"
                        class="text-center p-2 border border-solid border-[#d31f1f] bg-white text-[#d31f1f] hover:bg-[#d31f1f] hover:text-white">
                        <span class="me-1">Thu Gọn</span>
                        <i class="fa-solid fa-caret-up"></i>
                    </button>
                    <button v-if="!showFillter" @click="showFillter=true"
                        class="text-center p-2 border border-solid border-[#1061b3] bg-white text-[#1061b3] hover:bg-[#1061b3] hover:text-white">
                        <span class="me-1">Hiện Bộ Lọc</span>
                        <i class="fa-solid fa-caret-down"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="module-content bg-[#fefefe] border border-solid border-[#d8d8d8] rounded">
            <div class="flex items-center justify-between head-all p-3 pb-0">
                <h2 class="title font-bold 2xl:text-[1.5rem] text-[1.25rem] text-[#6c5ce7]">Kết Quả Tìm Kiếm: @{{items.length}}
                </h2>
            </div>
            <div class="flex flex-wrap -mx-1 p-2">
                <div v-for="item in items" class="px-1 basis-full mb-2">
                    <div
                        class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                        <a :href="item.url"
                            class="img shrink-0 w-[90px] h-[130px] img-h-full rounded-lg overflow-hidden mr-2 relative">
                            <picture>
                                <source media="(min-width:0px)" :srcset="item.thumbnail">
                                <img loading="lazy" :src="item.thumbnail" :alt="item.title"
                                    class="img-fluid">
                            </picture>
                            <span v-if="item.status == 1" class="novel-stripe">
                                <span class="story-status">FULL</span>
                            </span>
                        </a>
                        <div class="flex-1 content">
                            <h3>
                                <a :href="item.url"
                                    :title="item.title"
                                    class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">@{{ capitalizeFirstLetter(item.title) }}</a>
                            </h3>
                            <div class="flex items-center justify-between">
                                <a :href="item.author_url"
                                    :title="item.author_name"
                                    class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">@{{ capitalizeFirstLetter(item.author_name) }}</a>
                                <span v-if="item.is_convert" title="Convert"
                                    class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded text-[#128c7e] border-[#128c7e]">Convert</span>
                                <span v-else title="Dịch" class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded" style="color: #0000ff;border-color:#0000ff">Dịch</span>
                            </div>
                            <div class="story-info lg:text-[0.875rem]">
                                <span
                                    class="text-[#28a745] mr-1 whitespace-nowrap">@{{ item.total_chapter }}
                                    Chương</span>
                                <span class="text-[#007bff] mr-1 whitespace-nowrap">@{{ item.view_count }}
                                    Đọc</span>
                                <span class="text-[#dc3545] mr-1 whitespace-nowrap">@{{getStringAfterTime(item.last_update)}}</span>
                            </div>
                            <div class="tag flex flex-wrap mt-2">
                                    <a v-for="cat in item.categories" :href="cat.url"
                                        :title="cat.name"
                                        class="tag-item bllock py-1 px-4 text-[0.75rem] text-center mr-2 mb-2 text-ellipsis rounded-xl border border-solid border-[#008000] hover:bg-[#008000] hover:text-white">@{{ cat.name }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-1 basis-full ">
                    <fvn-paging-client :page="querySearch.page" :per_page="querySearch.per_page" :total="querySearch.total" @change-page="(page) => nextPage(page)" :show_page="5"></fvn-paging-client>
                </div>
            </div>
        </div>
        <div v-if="loading"
            class="fixed top-0 left-0 right-0 bottom-0 flex justify-center items-center"
            style="z-index: 9999; background-color: rgb(0 0 0 / 50%);">
            <img src="{{asset('assets/images/loading-load-icon-transparent.png')}}" class="loader" width="80px" height="80px" alt="loading" srcset="">
        </div>
    </div>

    <script>
        var vue_super_search_story_app = {
            loading: false,
            items: [],
            showFillter: true,
            querySearch: {
                total: 0,
                page: 1,
                per_page: 25,
                cats: [],
                order_by: 'title',
                order_type: 'DESC',
                keyword: ''
            },
            apiUrl: FVN_LARAVEL_HOME + '/api/super-search',
            pointInTime: null,
            CAT: <?= json_encode(get_all_categories(CategoryType::CAT['key'])) ?>,
            WORD: <?= json_encode(get_all_categories(CategoryType::WORD['key'])) ?>,
            CHARATER: <?= json_encode(get_all_categories(CategoryType::CHARATER['key'])) ?>,
            SECT: <?= json_encode(get_all_categories(CategoryType::SECT['key'])) ?>,

            optionOrder: [{
                    key: 'title',
                    display: 'Tên truyện'
                },
                {
                    key: 'star_average',
                    display: 'Đánh giá'
                },
                {
                    key: 'view_count',
                    display: 'lượt xem'
                },
                {
                    key: 'last_chapers',
                    display: 'Thời cập nhật gần nhất'
                }

            ]
        };
        var appHomeStoryHot = new Vue({
            el: '#fvn_super_search',
            data: vue_super_search_story_app,
            mounted: function() {},
            computed: {},
            methods: {
                updateQueryFromUrl() {
                    if (window.location.hash) {
                        let querySearch = queryToObject(window.location.hash.substring(1));
                        // console.log(window.location.hash.substring(1), querySearch);

                        for (key in querySearch) {
                            if (key == 'cats') {
                                if (querySearch[key]) {
                                    querySearch[key] = querySearch[key].split(',');
                                } else {
                                    querySearch[key] = [];
                                }
                            }
                            this.querySearch[key] = querySearch[key];
                        }
                    }
                },
                buildQueryItem(task, changeUrl) {
                    if (changeUrl == undefined) {
                        changeUrl = true;
                    }
                    if (task == 'export') {
                        this.getItemUrl = this.apiUrl + '.export';
                    } else if (task) {
                        this.getItemUrl = this.apiUrl + '?is_paginate=1';
                    } else {
                        this.getItemUrl = this.apiUrl + '?is_paginate=';
                    }
                    let paramSearch = {};
                    for (const i in this.querySearch) {
                        let value = this.querySearch[i];
                        if (i == 'book_date_min' || i == 'book_date_max') {
                            value = format_date(value);
                        }
                        if (Array.isArray(value)) {
                            for (let index = 0; index < value.length; index++) {
                                this.getItemUrl += '&' + i + '[]=' + value[index];
                            }
                        } else {
                            this.getItemUrl += '&' + i + '=' + value;
                        }
                        paramSearch[i] = value
                    }

                    paramSearch['order_by'] = this.querySearch.order_by
                    paramSearch['order_type'] = this.querySearch.order_type
                    paramSearch['per_page'] = this.querySearch.per_page;
                    paramSearch['page'] = this.querySearch.page;
                    if (changeUrl) {
                        // console.log(objectToQuery(paramSearch));
                        parent.location.hash = objectToQuery(paramSearch);
                    }
                },
                nextPage(page) {
                    this.querySearch.page = page;
                    this.getItems();
                },
                searchItem() {
                    this.getItems();
                    this.getPaging();
                },
                async getItems() {
                    this.loading = true;
                    this.buildQueryItem();
                    const jsonData = await new RouteApi().get(this.getItemUrl)
                    this.loading = false;
                    if (jsonData.result) {
                        this.items = jsonData.data;
                    } else {
                        this.items = [];
                        // jAlert(jsonData.message);
                    }
                },
                async getPaging() {
                    this.buildQueryItem(true);
                    let jsonData = await new RouteApi().get(this.getItemUrl);
                    this.querySearch.total = jsonData.total;
                },
                capitalizeFirstLetter(string) {
                    const words = string.split(" ");
                    for (let i = 0; i < words.length; i++) {
                        words[i] = words[i][0].toUpperCase() + words[i].substr(1);
                    }
                    string = words.join(" ");
                    return string;
                },
                getStringAfterTime(after_minutes) {
                    if (after_minutes < 60) {
                        return after_minutes + ' phút trước';
                    } else if (after_minutes < 60 * 24) {
                        return Math.floor(after_minutes / 60) + ' giờ trước';
                    } else if (after_minutes < 60 * 24 * 30) {
                        return Math.floor(after_minutes / (60 * 24)) + ' ngày trước';
                    } else if (after_minutes < 60 * 24 * 30 * 365) {
                        return Math.floor(after_minutes / (60 * 24 * 30)) + ' tháng trước';
                    } else {
                        return Math.floor(after_minutes / (60 * 24 * 30 * 365)) + ' năm trước';
                    }
                }
            },
            watch: {

            },
        });
    </script>
@endsection

@section('scripts')
@endsection
