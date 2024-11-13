<?php 
use App\Enums\CategoryType;

?>
@extends('layouts.client')

@section('content')
    <script src="{{ asset('assets/js/vue-input.js') }}"></script>
    <main>
        <div class="container">
            <div class="row align-items-start">
                <div id="fvn_super_search" class="col-12 col-md-8 col-lg-9 mb-3">
                    <div class="head-title-global d-flex justify-content-between mb-2">
                        <div class="col-12 col-md-12 col-lg-12 head-title-global__left d-flex">
                            <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                                <span class="d-block text-decoration-none text-dark fs-4 category-name"
                                    title="Tìm kiếm nâng cao">Tìm kiếm nâng cao</span>
                            </h2>
                        </div>
                    </div>
                    <div>
                        <div class="row">
                            <h6 class="fw-semibold">{{CategoryType::CAT['value']}}</h6>
                            <div v-for="item in CAT" class="col-4 col-md-3">
                                <div class="form-check">
                                    <input v-model="querySearch.cats" class="form-check-input" type="checkbox"
                                        :value="item.id" :id="item.id">
                                    <label class="form-check-label" :for="item.id">
                                        @{{ item.name }}
                                    </label>
                                </div>
                            </div>
                            <hr>
                        </div>

                        <div class="row">
                            <h6 class="fw-semibold">{{CategoryType::WORD['value']}}</h6>
                            <div v-for="item in WORD" class="col-4 col-md-3">
                                <div class="form-check">
                                    <input v-model="querySearch.cats" class="form-check-input" type="checkbox"
                                        :value="item.id" :id="item.id">
                                    <label class="form-check-label" :for="item.id">
                                        @{{ item.name }}
                                    </label>
                                </div>
                            </div>
                            <hr>
                        </div>

                        <div class="row">
                            <h6 class="fw-semibold">{{CategoryType::CHARATER['value']}}</h6>
                            <div v-for="item in CHARATER" class="col-4 col-md-3">
                                <div class="form-check">
                                    <input v-model="querySearch.cats" class="form-check-input" type="checkbox"
                                        :value="item.id" :id="item.id">
                                    <label class="form-check-label" :for="item.id">
                                        @{{ item.name }}
                                    </label>
                                </div>
                            </div>
                            <hr>
                        </div>

                        <div class="row">
                            <h6 class="fw-semibold">{{CategoryType::SECT['value']}}</h6>
                            <div v-for="item in SECT" class="col-4 col-md-3">
                                <div class="form-check">
                                    <input v-model="querySearch.cats" class="form-check-input" type="checkbox"
                                        :value="item.id" :id="item.id">
                                    <label class="form-check-label" :for="item.id">
                                        @{{ item.name }}
                                    </label>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="mt-3 row">
                            <div class="col-12 col-sm-6">
                                <label class="col-sm-2 col-form-label">Keyword</label>
                                <div>
                                    <input v-model="querySearch.keyword" type="text" class="form-control" id="inputPassword">
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label class="col-form-label">Sắp xếp theo</label>
                                <div>
                                    <select v-model="querySearch.order_by" class="form-select">
                                        <option v-for="item in optionOrder" :value="item.key">@{{item.display}}</option>
                                      </select>
                                </div>
                            </div>
                        </div>
                        <button @click="searchItem" type="button" class="btn btn-success btn-sm mt-3">Tìm kiếm</button>

                    </div>
                    <div class="row mt-4 position-relative">
                        <div class="col-12 mb-3">
                            @include('parts.ads.adsense_v1')
                        </div>
                        <div v-for="item in items" class="col-12 mb-3">
                            <div class="d-flex">
                                <a :href="item.url" class="">
                                    <div class="position-relative">
                                        <img :src="item.thumbnail" :alt="item.title"
                                            class="img-fluid border border-primary rounded" width="150" height="230"
                                            loading="lazy">
                                        <div class="position-absolute top-0 start-0 m-1">
                                            <span v-if="item.status == 1"
                                                class="story-item__badge badge text-bg-success">Full</span>
                                            <span v-if="item.star_average > 7"
                                                class="story-item__badge story-item__badge-hot badge text-bg-danger">Hot</span>
                                            <span v-if="item.after_day < 30"
                                                class="story-item__badge story-item__badge-new badge text-bg-info text-light">New</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="content ms-2">
                                    <a :href="item.url"
                                        class="fs-4 text-dark text-capitalize fw-semibold text-decoration-none">
                                        <i class="fa-solid fa-book-open"></i>
                                        @{{ item.title }}
                                    </a>
                                    <div class="card-text">
                                        <i class="fa-solid fa-pencil"></i>
                                        @{{ item.author_name }}
                                    </div>
                                    <div class="card-text">
                                        <i class="fa-solid fa-list-ol"></i>
                                        @{{ item.total_chapers }} Chương
                                    </div>
                                    <div class="card-text">
                                        <i class="fa-solid fa-layer-group"></i>
                                        <span v-for="cat in item.categories">@{{ cat.name }}, </span>
                                    </div>
                                    <div class="card-text">
                                        <i class="fa-regular fa-star"></i>
                                        <span>@{{ item.star_average }}/10 </span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        </div>

                        <div v-if="items.length == 0" class="col-12 alert alert-dark" role="alert">
                            Không có truyện nào
                        </div>

                        <fvn-paging-client :page="querySearch.page" :per_page="querySearch.per_page"
                            :total="querySearch.total" @change-page="(page) => nextPage(page)"
                            :show_page="5"></fvn-paging-client>

                        <div v-if="loading"
                            class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center"
                            style="z-index: 9999; background-color: rgb(0 0 0 / 50%);">
                            <div class="spinner-border text-success" role="status" style="width: 5rem; height: 5rem;">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    @include('client_page.part_stories.story_top_ratings', [])
                </div>
            </div>
        </div>
    </main>



    <script>
        var vue_super_search_story_app = {
            loading: false,
            items: [],
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

            optionOrder: [
                {key:'title', display: 'Tên truyện'},
                {key:'star_average', display: 'Đánh giá'},
                {key:'view_count', display: 'lượt xem'},
                {key:'last_chapers', display: 'Thời cập nhật gần nhất'}

            ]
        };
        var appHomeStoryHot = new Vue({
            el: '#fvn_super_search',
            data: vue_super_search_story_app,
            mounted: function() {
            },
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
                }
            },
            watch: {

            },
        });
    </script>
@endsection

@section('scripts')
@endsection
