<script src="{{ asset('assets/js/vue-input.js') }}"></script>
<div id="app_information_story_chapers" class="col-12 col-md-7 col-lg-8">
    <div class="head-title-global d-flex justify-content-between mb-4">
        <div class="col-12 col-md-12 col-lg-4 head-title-global__left d-flex">
            <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                <span class="d-block text-decoration-none text-dark fs-4 title-head-name" title="Thông tin truyện">Thông
                    tin truyện</span>
            </h2>
        </div>
    </div>

    <div class="story-detail">
        <div class="story-detail__top d-flex align-items-start">
            <div class="row align-items-start">
                <div class="col-12 mb-2 d-block d-lg-none">
                    <h3 class="text-center story-name text-capitalize">{{ $story['title'] }}</h3>
                    <div class="rate-story mb-2">
                        <div @mouseleave="leaveStar" class="rate-story__holder">
                            <img v-for="(item, index) in renderStar" @mouseover="hoverStar(index + 1)"
                                @click="voteStar(index + 1)" :src="item" class="cursor-pointer" />
                        </div>
                        <em class="rate-story__text"></em>
                        <div class="rate-story__value">
                            <em>Đánh giá:
                                <strong>
                                    <span itemprop="ratingValue">{{ $story['star_average'] }}</span>
                                </strong>
                                /
                                <span class="" itemprop="bestRating">10</span>
                                từ
                                <strong>
                                    <span itemprop="ratingCount">{{ $story['star_count'] }}</span>
                                    lượt
                                </strong>
                            </em>
                            <br>
                            <em>
                                Lượt xem: <strong><span>{{ $story['view_count'] }}</span></strong>
                                <i class="fa-regular fa-eye"></i>
                            </em>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-4 story-detail__top--image">
                    <div class="book-3d">
                        <img src="{{ $story['thumbnail'] }}" alt="{{ $story['title'] }}" class="img-fluid w-100"
                            width="200" height="300" loading="lazy">
                    </div>
                    <div class="mt-3">
                        <p class="mb-1">
                            <strong>Tác giả:</strong>
                            <a href="{{ route('client.author', ['author_slug' => $story['author_slug']]) }}"
                                class="text-decoration-none text-dark hover-title hover_primary">{{ $story['author_name'] }}</a>
                        </p>
                        <div class="d-flex align-items-center mb-1 flex-wrap">
                            <strong class="me-1">Thể loại:</strong>
                            @foreach ($story['categories'] as $item)
                                <a href="{{ route('client.tag', ['tag_slug' => $item['slug']]) }}"
                                    class="text-decoration-none text-dark hover-title me-1 hover_primary"
                                    style="width: max-content;">{{ $item['name'] }} ,
                                </a>
                            @endforeach
                        </div>

                        <p class="mb-1">
                            <strong>Trạng thái:</strong>
                            <span
                                class="{{ $story['status'] == 1 ? 'text-info' : 'text-success' }}">{{ $story['status_name'] }}</span>
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8 d-none d-lg-block">
                    <h3 class="text-center story-name text-capitalize">{{ $story['title'] }}</h3>
                    <div class="rate-story mb-2">
                        <div @mouseleave="leaveStar" class="rate-story__holder">
                            <img v-for="(item, index) in renderStar" @mouseover="hoverStar(index + 1)"
                                @click="voteStar(index + 1)" :src="item" class="cursor-pointer" />
                        </div>
                        <em class="rate-story__text"></em>
                        <div class="rate-story__value">
                            <em>Đánh giá:
                                <strong>
                                    <span itemprop="ratingValue">{{ $story['star_average'] }}</span>
                                </strong>
                                /
                                <span class="" itemprop="bestRating">10</span>
                                từ
                                <strong>
                                    <span itemprop="ratingCount">{{ $story['star_count'] }}</span>
                                    lượt
                                </strong>
                            </em>
                            <br>
                            <em>
                                Lượt xem: <strong><span>{{ $story['view_count'] }}</span></strong>
                                <i class="fa-regular fa-eye"></i>
                            </em>
                        </div>
                    </div>

                    <div class="px-3" style="text-align: justify">
                        {!! $story['description'] !!}
                    </div>
                </div>
                <div class="col-12 d-block d-lg-none">
                    <div class="px-3" style="text-align: justify">
                        {!! $story['description'] !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="story-detail__list-chapter mt-4">
            <div class="head-title-global d-flex justify-content-between mb-4">
                <div class="col-6 col-md-12 col-lg-6 head-title-global__left d-flex">
                    <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                        <span href="#" class="d-block text-decoration-none text-dark fs-4 title-head-name"
                            title="Truyện hot">Danh sách chương</span>
                    </h2>
                </div>
            </div>

            <div class="story-detail__list-chapter--list">
                <div class="row">
                    <div class="col-12 col-sm-6 col-lg-6 story-detail__list-chapter--list__item">
                        <ul>
                            <li v-for="item in items_v1">
                                <a :href="item.url" class="text-decoration-none text-dark hover-title">
                                    @{{ item.name }} 
                                    <i>(view: @{{item.view}})</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-6 story-detail__list-chapter--list__item">
                        <ul>
                            <li v-for="item in items_v2">
                                <a :href="item.url" class="text-decoration-none text-dark hover-title">
                                    @{{ item.name }} 
                                    <i>(view: @{{item.view}})</i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <fvn-paging-client :page="querySearch.page" :per_page="querySearch.per_page" :total="querySearch.total"
            @change-page="(page) => nextPage(page)" :show_page="5"></fvn-paging-client>
    </div>
    <div v-if="loading"
        class="position-fixed top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center"
        style="z-index: 9999; background-color: rgb(0 0 0 / 50%);">
        <div class="spinner-border text-success" role="status" style="width: 5rem; height: 5rem;">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</div>

<script>
    var vue_story_information_app = {
        loading: false,
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
        stars: 7.6,
        images: {
            starOn: "{{ asset('/assets/images/star-on.png') }}",
            starHalf: "{{ asset('/assets/images/star-half.png') }}",
            starOff: "{{ asset('/assets/images/star-off.png') }}"
        },
        apiUrl: FVN_LARAVEL_HOME + '/story',
        pointInTime: null,
    };
    var appInformatrionStory = new Vue({
        el: '#app_information_story_chapers',
        data: vue_story_information_app,
        mounted: function() {
            this.stars = this.itemDetail.star_average;
            this.searchItem();
        },
        computed: {
            renderStar() {
                let render = [];
                for (let i = 1; i <= 10; i++) {
                    if (i <= this.stars) {
                        render.push(this.images.starOn);
                    } else if ((i % this.stars > 0) && (i % this.stars < 1)) {
                        render.push(this.images.starHalf);
                    } else {
                        render.push(this.images.starOff);
                    }
                }
                return render;
            },
            items_v1() {
                return this.items.slice(0, 25);
            },
            items_v2() {
                return this.items.slice(25);
            }
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
            hoverStar(star) {
                this.stars = star;
            },
            leaveStar() {
                this.stars = this.itemDetail.star_average;
            },
            async voteStar(star) {
                this.loading = true;
                let jsonData = await new RouteApi().post(`${this.apiUrl}/star-rating`, {
                    story_id: this.itemDetail.id,
                    point_star: star
                });
                this.loading = false;
                if (jsonData.status) {
                    jnotice(jsonData.message);
                } else {
                    jAlert(jsonData.message);
                }
            }
        },
        watch: {
            'querySearch.cat_id'(newVal) {
                this.getItems();
            }
        },
    });
</script>
