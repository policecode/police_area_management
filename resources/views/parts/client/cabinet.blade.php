<div id="story__cabinet_vue">
    <div class="box-storyboard" :class="{'active': active}">
        <div class="head p-4 flex items-center justify-content-between">
            <p class="title font-bold text-[1.25rem]">
                Tủ truyện
            </p>
            <span @click="active=false" class="btn-close-board"><i class="fa-solid fa-xmark"></i></span>
        </div>
        <div class="px-4 mb-4 ">
            <ul
                class="tab-categories-title tab-categories-title-admin border border-solid bg-[#128c7e] border-[#128c7e] text-[13px] flex justify-between items-center rounded-xl overflow-hidden text-white storyboard-box">
                <li>
                    <a href="javascript:void(0)" title="Truyện đã đọc" data-type="1" {{-- data-action="https://banlong.us/load-item-storyboard" --}}
                        class="block not-login main-item-storyboard text-center p-2 border-r-[1px] border-solid border-[#128c7e] bg-white text-[#128c7e]">Truyện đang đọc</a>
                </li>
                {{-- <li>
                    <a href="javascript:void(0)" title="Truyện đang mua" data-type="2"
                        data-action="https://banlong.us/load-item-storyboard"
                        class="block not-login text-center p-2 border-r-[1px] border-solid border-[#128c7e] bg-white text-[#128c7e]">Truyện
                        đang mua</a>
                </li>
                <li>
                    <a href="javascript:void(0)" title="Truyện đã lưu" data-type="3"
                        data-action="https://banlong.us/load-item-storyboard"
                        class="block not-login text-center p-2 border-r-[1px] border-solid border-[#128c7e] bg-white text-[#128c7e]">Truyện
                        đã lưu</a>
                </li> --}}
            </ul>
        </div>
        <div class="board-content board-content-result flex-1 p-4">
            <div v-for="(item, index) in items" class="card-readed p-4 relative">
                <a @click="clearStory(index)" href="javascript:void(0)" title="Xóa" class="delete-item delete-item-storyboard-lc"><i
                        class="fa-solid fa-xmark"></i></a>
                <div class="flex items-center justify-between mb-3">
                    <a :href="item.link" title="Cổ Chân Nhân" class="name line-camp-1 2xl:text-[1.25rem] mr-4">
                        <span v-if="item.is_convert" class="text-[#128c7e]">[Convert]</span>
                        <span v-else style="color:#0000ff;">[Dịch]</span>
                        @{{item.title}}
                    </a>
                    <a :href="item.link_author" class="author text-[#999] text-[0.875rem] shrink-0 line-camp-1">@{{item.author_name}}</a>
                </div>
                <a :href="item.link_chapter" class="cate-items text-[#999] text-[0.875rem]">
                    @{{item.chapter_name}}
                </a>
            </div>
        </div>
    </div>
    <div @click="active=false" class="overlay-board" :class="{'show': active}"></div>
</div>

<script>
    var story_cabinet_app = {
        active: false,
        items: [],
        itemDetail: {},
    };
    var appStoryCabinet = new Vue({
        el: '#story__cabinet_vue',
        data: story_cabinet_app,
        mounted: function() {
            this.getItems();
        },
        computed: {

        },
        methods: {
            getItems() {
                this.items = LocalStorageHelper.getObject('fvn_story_history', []);
                // console.log(this.items);
            },
            clearStory(index) {
                this.items.splice(index, 1);
                LocalStorageHelper.setObject('fvn_story_history',this.items);
            }

        },
        watch: {

        },
    });
</script>
