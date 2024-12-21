<section id="vue_app_top_rating_stories" class="py-1 ranking">
    <div class="container">
        <div class="flex flex-wrap -mx-2">
            <div class="basis-full xl:basis-1/3 px-2 mb-4">
                <div
                    class="box-ranking bg-white rounded overflow-hidden border border-solid border-[rgba(0,0,0,.125)] h-full flex flex-col shadow-[0_0_1px_rgba(0,0,0,.13)]">
                    <div class="head relative p-4 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                        <h2 class="font-bold text-[1.125rem] text-center">Xem Nhiều Trong Tháng</h2>
                        {{-- <a href="truyen-yeu-thich.html" title="Tất cả"
                            class="readmore text-[#128c7e] text-[0.875rem] absolute top-1/2 right-4 -translate-y-1/2">Tất
                            cả <i class="ml-2 fa-solid fa-right-long"></i></a> --}}
                    </div>
                    <ul class="list-story">
                        <li v-if="month_items[0]" class="rank-1 flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                            <span
                                class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">1</span>
                            <div class="content flex-1 mr-2">
                                <h3>
                                    <a :href="month_items[0].url" :title="month_items[0].title" class="title font-bold text-[#444] text-[0.875rem] line-clamp-1">@{{month_items[0].title}}</a>
                                </h3>
                                <p class="text-[0.75rem] text-[#007bff]">@{{month_items[0].view}} Lượt xem</p>
                                <a :href="month_items[0].author_url" :title="month_items[0].author_name"
                                    class="block text-[0.75rem] text-[#6c757d] w-fit">@{{month_items[0].author_name}}</a>
                            </div>
                            <a :href="month_items[0].url" :title="month_items[0].title"
                                class="book-cover block w-[52px] h-[87px] shrink-0 img-h-full mr-2">
                                <picture>
                                    <source media="(min-width:0px)" :srcset="month_items[0].thumbnail">
                                    <img loading="lazy" :src="month_items[0].thumbnail" :alt="month_items[0].title" class="img-fluid">
                                </picture>
                            </a>
                        </li>
                        <li v-for="(item, index) in month_items" v-if="index > 0" class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                            <span class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">@{{index + 1}}</span>
                            <a :href="item.url" :title="item.title" class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">
                                @{{item.title}}
                            </a>
                            <span class="text-[11px]">@{{item.view}}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="basis-full xl:basis-1/3 px-2 mb-4">
                <div
                    class="box-ranking bg-white rounded overflow-hidden border border-solid border-[rgba(0,0,0,.125)] h-full flex flex-col shadow-[0_0_1px_rgba(0,0,0,.13)]">
                    <div class="head relative p-4 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                        <h2 class="font-bold text-[1.125rem] text-center">Xem Nhiều Trong Tuần</h2>
                        {{-- <a href="truyen-hot.html" title="Tất cả"
                            class="readmore text-[#128c7e] text-[0.875rem] absolute top-1/2 right-4 -translate-y-1/2">Tất
                            cả <i class="ml-2 fa-solid fa-right-long"></i></a> --}}
                    </div>
                    <ul class="list-story">
                        <li v-if="week_items[0]" class="rank-1 flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                            <span
                                class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">1</span>
                            <div class="content flex-1 mr-2">
                                <h3>
                                    <a :href="week_items[0].url" :title="week_items[0].title" class="title font-bold text-[#444] text-[0.875rem] line-clamp-1">@{{day_items[0].title}}</a>
                                </h3>
                                <p class="text-[0.75rem] text-[#007bff]">@{{week_items[0].view}} Lượt xem</p>
                                <a :href="week_items[0].author_url" :title="week_items[0].author_name"
                                    class="block text-[0.75rem] text-[#6c757d] w-fit">@{{week_items[0].author_name}}</a>
                            </div>
                            <a :href="week_items[0].url" :title="week_items[0].title"
                                class="book-cover block w-[52px] h-[87px] shrink-0 img-h-full mr-2">
                                <picture>
                                    <source media="(min-width:0px)" :srcset="week_items[0].thumbnail">
                                    <img loading="lazy" :src="week_items[0].thumbnail" :alt="week_items[0].title" class="img-fluid">
                                </picture>
                            </a>
                        </li>
                        <li v-for="(item, index) in week_items" v-if="index > 0" class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                            <span class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">@{{index + 1}}</span>
                            <a :href="item.url" :title="item.title" class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">
                                @{{item.title}}
                            </a>
                            <span class="text-[11px]">@{{item.view}}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="basis-full xl:basis-1/3 px-2 mb-4">
                <div
                    class="box-ranking bg-white rounded overflow-hidden border border-solid border-[rgba(0,0,0,.125)] h-full flex flex-col shadow-[0_0_1px_rgba(0,0,0,.13)]">
                    <div class="head relative p-4 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                        <h2 class="font-bold text-[1.125rem] text-center">Xem Nhiều Trong Ngày</h2>
                        {{-- <a href="truyen-thinh-hanh-trong-tuan.html" title="Tất cả"
                            class="readmore text-[#128c7e] text-[0.875rem] absolute top-1/2 right-4 -translate-y-1/2">Tất
                            cả <i class="ml-2 fa-solid fa-right-long"></i></a> --}}
                    </div>
                    <ul class="list-story">
                        <li v-if="day_items[0]" class="rank-1 flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                            <span
                                class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">1</span>
                            <div class="content flex-1 mr-2">
                                <h3>
                                    <a :href="day_items[0].url" :title="day_items[0].title" class="title font-bold text-[#444] text-[0.875rem] line-clamp-1">@{{day_items[0].title}}</a>
                                </h3>
                                <p class="text-[0.75rem] text-[#007bff]">@{{day_items[0].view}} Lượt xem</p>
                                <a :href="day_items[0].author_url" :title="day_items[0].author_name"
                                    class="block text-[0.75rem] text-[#6c757d] w-fit">@{{day_items[0].author_name}}</a>
                            </div>
                            <a :href="day_items[0].url" :title="day_items[0].title"
                                class="book-cover block w-[52px] h-[87px] shrink-0 img-h-full mr-2">
                                <picture>
                                    <source media="(min-width:0px)" :srcset="day_items[0].thumbnail">
                                    <img loading="lazy" :src="day_items[0].thumbnail" :alt="day_items[0].title" class="img-fluid">
                                </picture>
                            </a>
                        </li>
                        <li v-for="(item, index) in day_items" v-if="index > 0" class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                            <span class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">@{{index + 1}}</span>
                            <a :href="item.url" :title="item.title" class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">
                                @{{item.title}}
                            </a>
                            <span class="text-[11px]">@{{item.view}}</span>
                        </li>
             
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var vue_top_rating_stories_app = {
        loading: false,
        items: [],
        day_items: [],
        week_items: [],
        month_items: [],
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
                // this.getItems();
                // this.getPaging();
                this.getItemDay();
                this.getItemWeek();
                this.getItemMonth();
            },
            async getItemDay() {
                const jsonData = await new RouteApi().get(`${this.apiUrl}/top-rating?page=1&per_page=10&view=day&order_by=view&order_type=DESC`);
                if (jsonData.result) {
                    this.day_items = jsonData.data;
                } else {
                    this.day_items = [];
                }
            },
            async getItemWeek() {
                const jsonData = await new RouteApi().get(`${this.apiUrl}/top-rating?page=1&per_page=10&view=week&order_by=view&order_type=DESC`);
                if (jsonData.result) {
                    this.week_items = jsonData.data;
                } else {
                    this.week_items = [];
                }
            },
            async getItemMonth() {
                const jsonData = await new RouteApi().get(`${this.apiUrl}/top-rating?page=1&per_page=10&view=month&order_by=view&order_type=DESC`);
                if (jsonData.result) {
                    this.month_items = jsonData.data;
                } else {
                    this.month_items = [];
                }
            },

            async getItems() {
                this.loading = true;
                this.buildQueryItem();
                const jsonData = await new RouteApi().get(this.getItemUrl);
                // console.log(jsonData);
                this.loading = false;
                if (jsonData.result) {
                    this.items = jsonData.data;
                } else {
                    this.items = [];
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
            // nextPage(page) {
            //     this.querySearch.page = page;
            //     this.getItems();
            // },
        },
        watch: {
            // "querySearch.view"() {
            //     this.searchItem();
            // }
        },
    });
</script>