<div id="client_stories_update_app" class="px-2 basis-full xl:basis-1/4">

    <div v-if="is_chapter" class="sidebar-story mb-3">
        <div class="box-story__sidebar bg-[#f8f9fa] shadow-[0_0_1px_rgba(0,0,0,.13)] mb-6 last:mb-0 rounded-md overflow-hidden border border-solid border-[rgba(0,0,0,.125)]">
            <div
                class="head flex items-center justify-between p-3 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                <p class="text-[0.938rem] font-bold mr-2">Chương mới cập nhật</p>
                <a href="{{route('client.new-update')}}" title="Danh sách đầy đủ" class="view-more text-[1.3] text-[#128c7e]">
                    <i class="fa-solid fa-right-long"></i>
                </a>
            </div>
            <ul class="list-story__item">
                <li v-for="(item, index) in chapter_items"
                    class="text-[0.875rem] py-3 px-4 border-b-[1px] border-solid border-[#f4f4f4] flex items-center justify-between">
                    <div class="w-[75%]">
                        <a :href="item.url" class=" line-clamp-1 text-[0.875rem]"
                            :title="item.title">
                            <span v-if="item.is_convert" class="prefix text-[#128c7e]">[Dịch]</span> 
                            <span v-else class="prefix" style="color: #0000ff">[Dịch]</span> 
                            @{{capitalizeFirstLetter(item.title)}}
                        </a>
                        <a :href="item.chapter_url"
                            class=" line-clamp-1 text-[0.75rem] text-[#999] mt-[2px]"
                            :title="item.chaper_name">@{{capitalizeFirstLetter(item.chaper_name)}}</a>
                    </div>
                    <a :href="item.author_url" :title="item.author_name"
                        class="author text-[0.625rem] w-[21%] line-clamp-1">@{{capitalizeFirstLetter(item.author_name)}}</a>
                </li>
    
            </ul>
        </div>
    </div>

    <div v-if="is_story" class="sidebar-story">
        <div
            class="box-story__sidebar bg-[#f8f9fa] shadow-[0_0_1px_rgba(0,0,0,.13)] mb-6 last:mb-0 rounded-md overflow-hidden border border-solid border-[rgba(0,0,0,.125)]">
            <div
                class="head flex items-center justify-between p-3 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                <p class="text-[0.938rem] font-bold mr-2">Truyện mới nhất</p>
                <a href="{{route('client.new-update')}}" title="Danh sách đầy đủ" class="view-more text-[1.3] text-[#128c7e]">
                    <i class="fa-solid fa-right-long"></i>
                </a>
            </div>
            <ul class="list-story__item">
                <li v-for="(item, index) in story_items"
                    class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                    <div class="flex items-center justify-between">
                        <a :href="item.url"
                            class="w-[75%] line-clamp-1 text-[0.875rem]" :title="item.title">
                            <span v-if="item.is_convert" class="prefix text-[#128c7e]">[Dịch]</span> 
                            <span v-else class="prefix" style="color: #0000ff">[Dịch]</span> 
                            @{{capitalizeFirstLetter(item.title)}}
                        </a>
                        <a :href="item.author_url" :title="item.author_name"
                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]"> @{{capitalizeFirstLetter(item.author_name)}}</a>
                    </div>
                </li>
        
            </ul>
        </div>
    </div>

</div>

<script>
    var vue_stories_app = {
        chapter_items: [],
        story_items: [],
        querySearch: {
            total: 0,
            page: 1,
            per_page: 10,
            keyword: '',
            order_by: 'id',
            order_type: 'DESC'
        },
        is_chapter: {{ Illuminate\Support\Js::from($is_chapter)}},
        is_story: {{ Illuminate\Support\Js::from($is_story)}},
        apiUrl: FVN_LARAVEL_HOME + '/api',
    };
    var appClientSideBar = new Vue({
        el: '#client_stories_update_app',
        data: vue_stories_app,
        mounted: function() {
            this.getStoryItems();
            this.getChpaterItems();
        },
        computed: {
            
        },
        methods: {
            async getStoryItems() {
                if (!this.is_story) {
                  return  
                }
                this.story_items = [];
                let api = this.apiUrl + '/search/keyword?is_paginate=0&page=1&per_page=12&order_by=created_at&order_type=DESC'
                const jsonData = await new RouteApi().get(api)
                if (jsonData.result) {
                    this.story_items = jsonData.data;
                } else {
                    this.story_items = [];
                }
            },
            async getChpaterItems() {
                if (!this.is_chapter) {
                  return  
                }
                this.chapter_items = [];
                let api = this.apiUrl + '/search/keyword?is_paginate=0&page=1&per_page=12&order_by=last_chapers&order_type=DESC'
                const jsonData = await new RouteApi().get(api)
                if (jsonData.result) {
                    this.chapter_items = jsonData.data;
                } else {
                    this.chapter_items = [];
                }
                
            },
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
        
        },
    });
</script>
