<div id="fvn_home_story_hot" class="section-stories-hot mb-3">
    <div class="container">
        <div class="row">
            <div class="head-title-global d-flex justify-content-between mb-2">
                <div class="col-6 col-md-4 col-lg-4 head-title-global__left d-flex align-items-center">
                    <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                        <a href="#" class="d-block text-decoration-none text-dark fs-4 story-name"
                            title="Truyện Hot">Truyện Hot</a>
                    </h2>
                    <i class="fa-solid fa-fire-flame-curved"></i>
                </div>

                <div class="col-4 col-md-3 col-lg-2">
                    <select v-model="querySearch.cat_id" class="form-select select-stories-hot" aria-label="Truyen hot" :disabled="loading">
                        <option value="">Tất cả</option>
                        <option v-for="item in optionCategories" :value="item.id">@{{item.name}}</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div v-if="!querySearch.cat_id" class="section-stories-hot__list">
                    @foreach ($hot_stories as $key => $item )
                        <div class="story-item">
                            <a href="{{ route('client.story', ['story_slug' =>  $item['slug']]) }}" class="d-block text-decoration-none">
                                <div class="story-item__image">
                                    <img src="{{ $item['thumbnail'] }}" alt="{{ $item['title'] }}" class="img-fluid"
                                        width="150" height="230" loading="lazy">
                                </div>
                                <h3 class="story-item__name text-one-row story-name">{{ $item['title'] }}</h3>

                                <div class="list-badge">
                                    @if ($item['status'] == 1)
                                        <span class="story-item__badge badge text-bg-success">Full</span>
                                    @endif

                                    @if ($item['star_average'] > 7)
                                        <span class="story-item__badge story-item__badge-hot badge text-bg-danger">Hot</span>
                                    @endif

                                    @if ($item['after_day'] < 30)
                                    <span class="story-item__badge story-item__badge-new badge text-bg-info text-light">New</span>
                                    @endif

                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div v-if="querySearch.cat_id && !loading" class="section-stories-hot__list">
                        <div v-for="item in items" class="story-item">
                            <a :href="item.url" class="d-block text-decoration-none">
                                <div class="story-item__image">
                                    <img :src="item.thumbnail" :alt="item.title" class="img-fluid"
                                        width="150" height="230" loading="lazy">
                                </div>
                                <h3 class="story-item__name text-one-row story-name">@{{item.title}}</h3>

                                <div class="list-badge">
                                    <span v-if="item.status == 1" class="story-item__badge badge text-bg-success">Full</span>
                                    <span class="story-item__badge story-item__badge-hot badge text-bg-danger">Hot</span>
                                    <span v-if="item.after_day < 30" class="story-item__badge story-item__badge-new badge text-bg-info text-light">New</span>
                                </div>
                            </a>
                        </div>
                </div>

                <div v-if="querySearch.cat_id && loading" class="section-stories-hot__list wrapper-skeleton">
                    <div v-for="item in (new Array(15))" class="skeleton" style="max-width: 150px; width: 100%; height: 230px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var vue_homet_story_hot_app = {
    loading: false,
    items: [],
    querySearch: {
        total: 0,
        page: 1,
        per_page: 15,
        cat_id: '',
        order_by: 'star_count',
        order_type: 'DESC'
    },
    apiUrl: FVN_LARAVEL_HOME + '/api',
    pointInTime: null,
    optionCategories: <?= json_encode(get_all_categories());?>
};
var appHomeStoryHot = new Vue({
    el: '#fvn_home_story_hot',
    data: vue_homet_story_hot_app,
    mounted: function () {
        
    },
    computed: {
    },
    methods: {
        async getItems() {
            this.items = [];
            this.loading = true;
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
        titleAuthor(name) {
            return `Tác giả: ${name}`
        }
    },
    watch: {
        'querySearch.cat_id' (newVal) {
            this.getItems();
        }
    },
});
</script>