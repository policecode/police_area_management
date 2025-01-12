<div id="ads__modal_vue" v-if="show" class="overlay-board-custom">
    <div class="box-storyboard-custom">
        <div class="head p-4 flex items-center justify-end ">
            <a @click="show=false" href="https://www.profitablecpmrate.com/f33kppcw?key=089d23c6ebaf4f5f8a92a8625af38b37" target="_blank" rel="nofollow,noopener" class="btn-close-board"><i class="fa-solid fa-xmark"></i></a>
        </div>
        <div class="board-content board-content-result flex-1 p-4">
            <a  target="_blank" rel="nofollow,noopener" href="https://shorten.asia/vSpUENPY">
                <img src="https://down-vn.img.susercontent.com/file/vn-11134258-7ras8-m4rooj7v5fwv94@resize_w960_nl.webp" alt="">
            </a>
        </div>
    </div>
</div>

<script>
    var ads_modal_app = {
        show: true
    };
    var appAdsModal = new Vue({
        el: '#ads__modal_vue',
        data: ads_modal_app,
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