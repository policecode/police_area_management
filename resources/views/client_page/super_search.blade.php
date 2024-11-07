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
                        <h6>Thể loại</h6>
                        <div class="row">
                            <div v-for="item in optionCategories" class="col-4 col-md-3">
                                <div class="form-check">
                                    <input v-model="querySearch.cats" class="form-check-input" type="checkbox"
                                        :value="item.id" :id="item.id">
                                    <label class="form-check-label" :for="item.id">
                                        @{{ item.name }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button @click="searchItem" type="button" class="btn btn-success btn-sm mt-3">Tìm kiếm</button>
                    </div>
                    <div class="row mt-4 position-relative">
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
                                    {{-- <div class="card-text">
                                        <i class="fa-regular fa-clock"></i>
                                        <i>@{{ get_string_after_time($item['last_update']) }}</i>
                                    </div> --}}
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
                    @include('client_page.part_stories.table_categories', [])
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
                order_by: 'id',
                order_type: 'DESC'
            },
            apiUrl: FVN_LARAVEL_HOME + '/api/super-search',
            pointInTime: null,
            optionCategories: <?= json_encode(get_all_categories()) ?>
        };
        var appHomeStoryHot = new Vue({
            el: '#fvn_super_search',
            data: vue_super_search_story_app,
            mounted: function() {
                // this.updateQueryFromUrl();
                this.searchItem();
            },
            computed: {},
            methods: {
                updateQueryFromUrl() {
                    if (window.location.hash) {
                        let querySearch = queryToObject(window.location.hash.substring(1));
                        console.log(window.location.hash.substring(1), querySearch);
                        for (key in querySearch) {
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
                                paramSearch[i + '[]'] = value[index];
                                this.getItemUrl += '&' + i + '[]=' + value[index];
                            }
                        } else {
                            paramSearch[i] = value
                            this.getItemUrl += '&' + i + '=' + value;
                        }
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
