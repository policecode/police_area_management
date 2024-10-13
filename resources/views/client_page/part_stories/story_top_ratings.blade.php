<div id="vue_app_top_rating_stories" class="row top-ratings">
    <div class="col-12 top-ratings__tab mb-2">
        <div class="list-group d-flex flex-row">
            <a @click="querySearch.view = 'month'" class="list-group-item list-group-item-action cursor-pointer"
                :class="{ 'active': querySearch.view == 'month' }">Tháng</a>
            <a @click="querySearch.view = 'week'" class="list-group-item list-group-item-action cursor-pointer"
                :class="{ 'active': querySearch.view == 'week' }">Tuần</a>
            <a @click="querySearch.view = 'day'" class="list-group-item list-group-item-action cursor-pointer"
                :class="{ 'active': querySearch.view == 'day' }">Ngày</a>
        </div>
    </div>
    <div class="col-12 top-ratings__content position-relative">
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="top-day" role="tabpanel" aria-labelledby="top-day-list">
                <ul>
                    <li v-for="(item, index) in items">
                        <div class="rating-item d-flex align-items-center">
                            <div v-if="index == 0" class="rating-item__number bg-danger rounded-circle">
                                <span class="text-light">@{{ index + 1 }}</span>
                            </div>
                            <div v-else-if="index == 1" class="rating-item__number bg-success rounded-circle">
                                <span class="text-light">@{{ index + 1 }}</span>
                            </div>
                            <div v-else-if="index == 2" class="rating-item__number bg-info rounded-circle">
                                <span class="text-light">@{{ index + 1 }}</span>
                            </div>
                            <div v-else class="rating-item__number bg-light border rounded-circle">
                                <span class="text-dark">@{{ index + 1 }}</span>
                            </div>
                            <div class="rating-item__story">
                                <a :href="item.url"
                                    class="hover_primary text-decoration-none hover-title rating-item__story--name text-one-row">@{{ item.title }}</a>
                                <div class="d-flex flex-wrap rating-item__story--categories">
                                    <template v-for="(cat, i) in item.categories">
                                        <a v-if="i+1 == item.categories.length" :href="cat.url"
                                            class="hover_primary text-decoration-none text-dark hover-title  me-1 ">@{{ cat.name }}
                                        </a>
                                        <a v-else :href="cat.url"
                                            class="hover_primary text-decoration-none text-dark hover-title  me-1 ">@{{ cat.name }},
                                        </a>
                                    </template>
                                </div>
                                <div class="rating-item__story">
                                    <i class="fa-regular fa-eye"></i>
                                    <span>@{{item.view}}</span>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>


        </div>
        <div v-if="loading"
            class="position-absolute top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center"
            style="z-index: 9999; background-color: rgb(0 0 0 / 50%);">
            <div class="spinner-border text-info" role="status" style="width: 3rem; height: 3rem;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
</div>
<script>
    var vue_top_rating_stories_app = {
        loading: false,
        items: [],
        querySearch: {
            total: 0,
            page: 1,
            per_page: 10,
            view: 'month',
            order_by: 'view',
            order_type: 'DESC'
        },
        itemDetail: {},
        apiUrl: FVN_LARAVEL_HOME + '/story',
        pointInTime: null,
    };
    var appTopRatingStories = new Vue({
        el: '#vue_app_top_rating_stories',
        data: vue_top_rating_stories_app,
        mounted: function() {
            this.searchItem();
        },
        computed: {

        },
        methods: {
            searchItem() {
                this.getItems();
                this.getPaging();
            },
            async getItems() {
                this.loading = true;
                this.buildQueryItem();
                const jsonData = await new RouteApi().get(this.getItemUrl);
                console.log(jsonData);

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
            buildQueryItem(task, changeUrl) {
                if (changeUrl == undefined) {
                    changeUrl = true;
                }
                if (task == 'export') {
                    this.getItemUrl = this.apiUrl + '.export';
                } else if (task) {
                    this.getItemUrl = this.apiUrl + '/top-rating?is_paginate=1';
                } else {
                    this.getItemUrl = this.apiUrl + '/top-rating?is_paginate=';
                }
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
            nextPage(page) {
                this.querySearch.page = page;
                this.getItems();
            },
        },
        watch: {
            "querySearch.view"() {
                this.searchItem();
            }
        },
    });
</script>
