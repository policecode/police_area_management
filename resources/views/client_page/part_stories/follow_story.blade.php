<div id="follow__stories_vue" v-if="items.length > 0" class="section-list-category bg-light p-2 rounded card-custom">
    <div class="head-title-global mb-2">
        <div class="col-12 col-md-12 head-title-global__left">
            <h2 class="mb-0 border-bottom border-secondary pb-1">
                <span href="#" class="d-block text-decoration-none text-dark fs-4" title="Truyện đang đọc">Truyện
                    đang đọc</span>
            </h2>
        </div>
    </div>
    <table class="table">
        <tbody>
            <tr v-for="(item, index) in items">
                <td width="55%">
                    <a :href="item.link" :title="item.title" class="text-one-row hover-title text-decoration-none hover_primary text-dark">
                        @{{ item.title }}
                    </a>
                </td>
                <td width="35%">
                    <a :href="item.link_chapter" :title="item.chapter_name" class="text-one-row hover-title text-decoration-none hover_primary text-dark">
                        Chương @{{ item.position }}
                    </a>
                </td>
                <th scope="row">
                    <button @click="clearStory(index)" type="button" class="btn btn-light btn-sm">X</button>
                </th>
            </tr>

        </tbody>
    </table>
    {{-- <div class="row">
        <!-- Horizontal under breakpoint -->
        <ul class="list-category">
            <li v-for="item in items" class="">
                <a :href="item.link"
                    class="text-decoration-none hover_primary text-dark">@{{ item.title }}</a>
            </li>
        </ul>
    </div> --}}
</div>

<script>
    var follow_stories_app = {
        items: [],
        itemDetail: {},
    };
    var appFollowStories = new Vue({
        el: '#follow__stories_vue',
        data: follow_stories_app,
        mounted: function() {
            this.getItems();
        },
        computed: {

        },
        methods: {
            getItems() {
                this.items = LocalStorageHelper.getObject('fvn_story_history', []);
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
