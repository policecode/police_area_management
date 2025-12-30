<div id="app_list_chapter_story_chapers">
    <div class="box-chapter bg-white shadow-[2px_2px_6px_rgba(0,0,0,.13)] mb-6">
        <p
            class="head font-bold p-3 bg-[f8f9fa] border-t-[1px] border-solid border-[#dee2e6] border-b-[2px] lg:text-[1.125rem]">
            Chương mới</p>
        <ul class="list-chapter__item">
            @foreach ($chapters as $item)
                <li>
                    <a href="{{ route('client.chaper', ['story_slug' => $story['slug'], 'chaper_position' => $item['position']]) }}"
                        class="flex items-center justify-between py-2 px-3 hover:text-[#252525] hover:bg-[rgba(0,0,0,.09)] border-t-[1px] border-solid border-[#dee2e6]"
                        title="{{ $item['name'] }}">
                        <span class="title line-clamp-1 mr-3 flex-1">{{ ucwords($item['name']) }}</span>
                        <span
                            class="time shrink-0 w-[20%] text-center">{{ get_string_after_time($item['after_minutes']) }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <ul class="tab-story__detail py-2 flex bg-[#f8f9fa] shadow-[2px_2px_6px_rgba(0,0,0,.13)]">
        <li>
            <button @click="show_box = 'introduce'"
                class="tablinks py-1 px-4 border-r-[1px] border-solid border-[#4e4d4d]"
                :class="{ 'active': show_box == 'introduce' }">Giới thiệu</button>
        </li>
        {{-- <li>
                                <button class="tablinks py-1 px-4 border-r-[1px] border-solid border-[#4e4d4d]"
                                    data-electronic="tab-info-2" data-target="tab-info" onclick="STORY.initListRating()">Đánh
                                    giá</button>
                            </li> --}}
        <li>
            <button @click="show_box = 'chapters'" id="but-show-list-chapter"
                class="tablinks py-1 px-4 border-r-[1px] border-solid border-[#4e4d4d]"
                :class="{ 'active': show_box == 'chapters' }">Danh sách chương</button>
        </li>
        <li>
            <button @click="show_box = 'comments'"
                class="tablinks py-1 px-4 border-r-[1px] border-solid border-[#4e4d4d]"
                :class="{ 'active': show_box == 'comments' }">Bình luận</button>
        </li>
    </ul>
    <div class="wrapper_tabcontent bg-white shadow-[2px_2px_6px_rgba(0,0,0,.13)] mb-6">
        <div class="tabcontent p-4" :class="{ 'active': show_box == 'introduce' }">
            <div class="s-content">
                {!! $story['description'] !!}
            </div>
        </div>
        <div class="tabcontent p-4" :class="{ 'active': loading }">
            <div class="max-h-[390px] md:max-h-[495px] overflow-auto">
                <div id="list-rating-story">
                    <div class="in-loading text-center">
                        <div class="loader-dot">
                            <div class="loader-item"></div>
                            <div class="loader-item"></div>
                            <div class="loader-item"></div>
                            <div class="loader-item"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tabcontent p-4" :class="{ 'active': show_box == 'chapters' }">
            <div class="chapters-table__operations flex items-center justify-between flex-wrap mb-1">
                <label class="flex items-center shrink-0">
                    <input type="checkbox" v-model="showDesc" />
                    <span class="font-bold ml-2 shrink-0">Mới nhất</span>
                </label>
            </div>
            <div ref="listChapterResult">
                <table class="table-list__chapter w-full">
                    <thead>
                        <tr class="text-white bg-[#212529]">
                            <td class="font-bold p-3 text-center w-[10%]">STT</td>
                            <td class="font-bold p-3">Tựa chương</td>
                            <td class="font-bold p-3 text-center w-[25%]"><i class="fa-solid fa-clock"></i></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in items"
                            class="border-t-[1px] border-solid border-[#dee2e6] hover:bg-[rgba(0,0,0,.09)]">
                            <td class="py-2 px-3 text-center w-[10%]">@{{ index + 1 }}</td>
                            <td class="py-2 px-3">
                                <a :href="item.url" :title="item.name"
                                    class="text line-clamp-1 hover:text-[#252525]">
                                    @{{ item.name }}
                                </a>
                            </td>
                            <td class="py-2 px-3 text-center w-[25%]">@{{ getStringAfterTime(item.after_minutes) }}</td>
                        </tr>

                    </tbody>
                </table>

                <fvn-paging-client :page="querySearch.page" :per_page="querySearch.per_page" :total="querySearch.total"
                    @change-page="(page) => nextPage(page)" :show_page="5"></fvn-paging-client>
            </div>
        </div>
    </div>
</div>
<script>
    var vue_story_list_chapter_app = {
        loading: false,
        showDesc: false,
        show_box: 'introduce',
        user: {{ Illuminate\Support\Js::from($user) }},
        avatar_default: '{{ asset('assets/images/avatar_default.png') }}',
        items: [],
        querySearch: {
            total: 0,
            page: 1,
            per_page: 50,
            story_id: {{ $story['id'] }},
            order_by: 'position',
            order_type: 'ASC'
        },
        itemDetail: {{ Illuminate\Support\Js::from($story) }},
        apiUrl: FVN_LARAVEL_HOME + '/story',
        pointInTime: null,
    };
    var appListChapterStory = new Vue({
        el: '#app_list_chapter_story_chapers',
        data: vue_story_list_chapter_app,
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
                // this.items = [];
                this.buildQueryItem();
                const jsonData = await new RouteApi().get(this.getItemUrl);

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
                    this.getItemUrl = this.apiUrl + '/get-list-chapers?is_paginate=1';
                } else {
                    this.getItemUrl = this.apiUrl + '/get-list-chapers?is_paginate=';
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
            },
       
        },
        watch: {
            showDesc(newVal) {
                if (newVal) {
                    this.querySearch.order_type = 'DESC';
                } else {
                    this.querySearch.order_type = 'ASC';
                }
                this.searchItem();
            }
        },
    });
</script>
