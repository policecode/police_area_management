<section id="vue_app_top_rating_stories" class="py-1 ranking">
    <div class="container">
        <div class="flex flex-wrap -mx-2">
            <div class="basis-full xl:basis-1/3 px-2 mb-4">
                <div class="flex">
                    <a @click="querySearch.view = 'day'" href="javascript:void(0)"
                        class="block not-login main-item-storyboard text-center p-2 border border-solid border-[#128c7e] bg-white text-[#128c7e] mr-2"
                        :class="{ 'choose': querySearch.view == 'day' }">Day</a>
                    <a @click="querySearch.view = 'week'" href="javascript:void(0)"
                        class="block not-login main-item-storyboard text-center p-2 border border-solid border-[#128c7e] bg-white text-[#128c7e] mr-2"
                        :class="{ 'choose': querySearch.view == 'week' }">Week</a>
                    <a @click="querySearch.view = 'month'" href="javascript:void(0)"
                        class="block not-login main-item-storyboard text-center p-2 border border-solid border-[#128c7e] bg-white text-[#128c7e]"
                        :class="{ 'choose': querySearch.view == 'month' }">Month</a>
                </div>
                <div
                    class="box-ranking bg-white rounded overflow-hidden border border-solid border-[rgba(0,0,0,.125)] flex flex-col shadow-[0_0_1px_rgba(0,0,0,.13)]">
                    <div class="head relative p-4 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">

                        <h2 v-if="querySearch.view == 'day'" class="font-bold text-[1.125rem] text-center">Xem Nhiều
                            Trong Ngày</h2>
                        <h2 v-if="querySearch.view == 'week'" class="font-bold text-[1.125rem] text-center">Xem Nhiều
                            Trong Tuần</h2>
                        <h2 v-if="querySearch.view == 'month'" class="font-bold text-[1.125rem] text-center">Xem Nhiều
                            Trong Tháng</h2>
                        <a :href="view_url" title="Tất cả"
                            class="readmore text-[#128c7e] text-[0.875rem] absolute top-1/2 right-4 -translate-y-1/2">Tất
                            cả <i class="ml-2 fa-solid fa-right-long"></i></a>
                    </div>
                    <ul class="list-story">
                        <li v-if="items[0]" class="rank-1 flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                            <span
                                class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">1</span>
                            <div class="content flex-1 mr-2">
                                <h3>
                                    <a :href="items[0].url" :title="items[0].title"
                                        class="title font-bold text-[#444] text-[0.875rem] line-clamp-1">@{{ items[0].title }}</a>
                                </h3>
                                <p class="text-[0.75rem] text-[#007bff]">@{{ items[0].view }} Lượt xem</p>
                                <a :href="items[0].author_url" :title="items[0].author_name"
                                    class="block text-[0.75rem] text-[#6c757d] w-fit">@{{ items[0].author_name }}</a>
                            </div>
                            <a :href="items[0].url" :title="items[0].title"
                                class="book-cover block w-[52px] h-[87px] shrink-0 img-h-full mr-2">
                                <picture>
                                    <source media="(min-width:0px)" :srcset="items[0].thumbnail">
                                    <img loading="lazy" :src="items[0].thumbnail" :alt="items[0].title"
                                        class="img-fluid">
                                </picture>
                            </a>
                        </li>
                        <li v-for="(item, index) in items" v-if="index > 0"
                            class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                            <span
                                class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">@{{ index + 1 }}</span>
                            <a :href="item.url" :title="item.title"
                                class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">
                                @{{ item.title }}
                            </a>
                            <span class="text-[11px]">@{{ item.view }}</span>

                        </li>
                    </ul>
                </div>
            </div>
            {{-- Start --}}
            <div class="basis-full xl:basis-1/3 px-2 mb-4">
                <div
                    class="box-ranking bg-white rounded overflow-hidden border border-solid border-[rgba(0,0,0,.125)] h-full flex flex-col shadow-[0_0_1px_rgba(0,0,0,.13)]">
                    <div class="head relative p-4 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                        <h2 class="font-bold text-[1.125rem] text-center">Top cao thủ</h2>
                        {{-- <a href="https://blhvip.vn/truyen-hot" title="Tất cả"
                            class="readmore text-[#128c7e] text-[0.875rem] absolute top-1/2 right-4 -translate-y-1/2">Tất
                            cả <i class="ml-2 fa-solid fa-right-long"></i></a> --}}
                    </div>
                    <ul class="list-story">
                        <li v-if="memberTopItems[0]" class="rank-1 flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                            <span
                                class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">1</span>
                            <div class="content flex-1 mr-2">
                                <h3>
                                    <a :href="memberTopItems[0].profile_url" :title="memberTopItems[0].name"
                                        class="title font-bold text-[#444] text-[0.875rem] line-clamp-1">@{{memberTopItems[0].name}}</a>
                                </h3>
                                <p class="text-[0.75rem] text-[#007bff]">Tu vi: @{{memberTopItems[0].level_info.name}}</p>
                             
                            </div>
                            <a :href="memberTopItems[0].profile_url" :title="memberTopItems[0].name"
                                class="book-cover block w-[52px] h-[87px] shrink-0 img-h-full mr-2">
                                <picture>
                                    <img loading="lazy"
                                        :src="memberTopItems[0].avatar_url"
                                        :alt="memberTopItems[0].name" class="img-fluid">
                                </picture>
                            </a>
                        </li>
                        <li v-for="(item, index) in memberTopItems" v-if="index > 0" class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                            <span
                                class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">@{{ index + 1 }}</span>
                            <a :href="item.profile_url" :title="item.name"
                                class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">@{{item.name}}</a>
                            <span class="text-[11px]">@{{item.level_info.name}}</span>
                        </li>
           
                    </ul>
                </div>
            </div>
            {{-- End --}}

            {{-- Start --}}
            <div class="basis-full xl:basis-1/3 px-2 mb-4">
                <div
                    class="box-ranking bg-white rounded overflow-hidden border border-solid border-[rgba(0,0,0,.125)] h-full flex flex-col shadow-[0_0_1px_rgba(0,0,0,.13)]">
                    <div class="head relative p-4 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                        <h2 class="font-bold text-[1.125rem] text-center">Khổ tu (Ngày @{{layNgayHomNay()}})</h2>
                        {{-- <a href="https://blhvip.vn/truyen-hot" title="Tất cả"
                            class="readmore text-[#128c7e] text-[0.875rem] absolute top-1/2 right-4 -translate-y-1/2">Tất
                            cả <i class="ml-2 fa-solid fa-right-long"></i></a> --}}
                    </div>
                    <ul class="list-story">
                        <li v-if="memberTopDayItems[0]" class="rank-1 flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                            <span
                                class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">1</span>
                            <div class="content flex-1 mr-2">
                                <h3>
                                    <a :href="memberTopDayItems[0].profile_url" :title="memberTopDayItems[0].name"
                                        class="title font-bold text-[#444] text-[0.875rem] line-clamp-1">@{{memberTopDayItems[0].name}}</a>
                                </h3>
                                <p class="text-[0.75rem] text-[#007bff]">Kinh nghiệm: @{{memberTopDayItems[0].exp_day}}</p>
                             
                            </div>
                            <a :href="memberTopDayItems[0].profile_url" :title="memberTopDayItems[0].name"
                                class="book-cover block w-[52px] h-[87px] shrink-0 img-h-full mr-2">
                                <picture>
                                    <img loading="lazy"
                                        :src="memberTopDayItems[0].avatar_url"
                                        :alt="memberTopDayItems[0].name" class="img-fluid">
                                </picture>
                            </a>
                        </li>
                        <li v-for="(item, index) in memberTopDayItems" v-if="index > 0" class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                            <span
                                class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">@{{ index + 1 }}</span>
                            <a :href="item.profile_url" :title="item.name"
                                class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">@{{item.name}}</a>
                            <span class="text-[11px]">@{{item.exp_day}}</span>
                        </li>
           
                    </ul>
                </div>
            </div>
            {{-- End --}}

        </div>
    </div>
</section>

<script>
    var vue_top_rating_stories_app = {
        loading: false,
        items: [],
        view_url: '#',
        querySearch: {
            total: 0,
            page: 1,
            per_page: 10,
            view: 'day',
            order_by: 'view',
            order_type: 'DESC'
        },
        itemDetail: {},
        memberTopItems: [],
        memberTopDayItems: [],
        apiUrl: FVN_LARAVEL_HOME + '/story',
        apiMemberUrl: FVN_LARAVEL_HOME + '/api/member',
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
                this.getItemMemberTop();
                this.getItemMemberTopDay();
            },

            async getItems() {
                this.items = [];
                this.loading = true;
                this.buildQueryItem();
                const jsonData = await new RouteApi().get(this.getItemUrl);
                // console.log(jsonData);
                this.loading = false;
                if (jsonData.result) {
                    this.items = jsonData.data;
                    this.view_url = jsonData.view_url;
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
            async getItemMemberTop() {
                this.memberTopItems = [];
                const jsonData = await new RouteApi().get(`${this.apiMemberUrl}/list-top-member?page=1&per_page=10&view=all&order_by=exp&order_type=DESC`);
                
                if (jsonData.result) {
                    this.memberTopItems = jsonData.data;
                } else {
                    this.memberTopItems = [];
                }
            },
            async getItemMemberTopDay() {
                this.memberTopDayItems = [];
                const jsonData = await new RouteApi().get(`${this.apiMemberUrl}/list-top-member?page=1&per_page=10&view=day&order_by=exp_day&order_type=DESC`);
                
                if (jsonData.result) {
                    this.memberTopDayItems = jsonData.data;
                } else {
                    this.memberTopDayItems = [];
                }
            },
            layNgayHomNay() {
                const hienTai = new Date();
                const dinhDangVN = hienTai.toLocaleDateString('vi-VN');
                return dinhDangVN;
            }
        },
        watch: {
            "querySearch.view"(newVal) {
                this.getItems();
            },
        },
    });
</script>
