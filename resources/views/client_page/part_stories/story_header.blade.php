<div id="app_information_story_header" class="box p-2 rounded-lg border border-solid border-[#ddd] bg-[#ffffff] mb-4">
    <div class="flex flex-wrap ">
        <div class="basis-full w-full xl-w-75 xl:basis-3/4 px-2 flex flex-wrap mb-3 xl:mb-0">
            <div
                class="image-story w-full sm:w-[22%] shrink-0 img_full rounded-lg overflow-hidden mr-4 mb-2 sm:mb-0 relative">
                <picture>
                    <img loading="lazy" src="{{ $story['thumbnail'] }}" alt=" {{ $story['title'] }}" class="img-fluid">
                </picture>
                @if ($story['status'] == 1)
                    <span class="novel-stripe big">
                        <span class="story-status">FULL</span>
                    </span>
                @endif
            </div>
            <div class="info-story flex-1">
                <h1 class="name-story font-bold 2xl:text-[1.75rem] lg:text-[1.5rem] text-[1.25rem] mb-2">
                    @if ($story['is_convert'])
                        <span class="prefix text-[#128c7e]">[Convert]</span>
                    @else
                        <span class="prefix text-[#128c7e]" style="color: #0000ff;">[Dịch]</span>
                    @endif
                    {{ ucwords($story['title']) }}
                </h1>
                <p class="text-info text-[0.875rem]">
                    Tác giả: <a href="{{ route('client.author', ['author_slug' => $story['author_slug']]) }}"
                        title="{{ $story['author_name'] }}" class="text-[#00000099]">{{ $story['author_name'] }}</a>
                </p>

                <p class="text-info text-[0.875rem]">
                    Tình trạng:
                    @if ($story['status'] == 1)
                        <span style="color: #28a745">Đã hoàn thành</span>
                    @else
                        <span style="color: #4497f8">Còn tiếp</span>
                    @endif
                </p>
                <ul class="tag my-2">
                    @foreach ($story['categories'] as $cat)
                        <li class="inline-block mb-2 mr-1">
                            <a href="{{ route('client.tag', ['tag_slug' => $cat['slug']]) }}"
                                title="{{ $cat['name'] }}"
                                class="block text-[0.75rem] py-1 px-4 text-center rounded-2xl border border-solid border-[#4497f8] hover:text-[#4497f8]">{{ $cat['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="story-info lg:text-[0.875rem] mb-2">
                    {{-- <span class="text-[#dc3545] mr-2">1.538.521 chữ</span> --}}
                    <span class="text-[#28a745] mr-2">{{ $story['total_chapter'] }} chương</span>
                    <span class="text-[#007bff]">{{ $story['view_count'] }} Đọc</span>
                </div>
                {{-- <p class="text-[#28a745] mb-2">
                                <span class="font-bold">0</span>
                                Đề cử Linh Phiếu
                            </p> --}}
                <div class="list-button-action flex items-center flex-wrap">
                    <a href="{{ $first_chapter ? route('client.chaper', ['story_slug' => $story['slug'], 'chaper_position' => $first_chapter['position']]) : '' }}"
                        title="Đọc từ đầu"
                        class="btn btn-green hover:text-white font-bold mr-2 last:mr-0 sm:min-w-[130px] mb-2">
                        <i class="fa-solid fa-book-open-reader mr-2"></i>Đọc từ đầu
                    </a>
                    <a @click="saveFavoriteStory" href="javascript:void(0)"class="btn btn-green hover:text-white font-bold mr-2 last:mr-0 sm:min-w-[130px] mb-2 btn-favorite-story not-login ">
                        <i class="fa-solid fa-book mr-2"></i>
                        <span v-if="itemDetail.is_favorite" class="save-story-text">Bỏ lưu</span>
                        <span v-else class="save-story-text">Lưu công pháp</span>
                    </a>
                    <a href="javascript:void(0)" title="D.S Chương"
                        class="btn btn-green hover:text-white font-bold mr-2 last:mr-0 sm:min-w-[130px] mb-2 scroll-to-target"
                        data-target=".tab-story__detail" onclick="$('#but-show-list-chapter').click()">
                        <i class="fa-solid fa-list mr-2"></i>D.S chương
                    </a>
                </div>
                <div class="interaction-btns flex flex-wrap">
                    {{-- <a href="javascript:void(0)" title="Ủng hộ"
                                    class="btn-item sm:min-w-[130px] flex-1 sm:flex-none text-[#128c7e] hover:text-[#128c7e] flex flex-col justify-center items-center text-[0.875rem] rounded py-1 px-2 hover:shadow-[0_0.5em_0.5em_-0.3em_rgba(14,109,98,1)]"
                                    modal-rs-target="modal_donate">
                                    <i class="fa-solid fa-hand-holding-heart mb-2"></i>
                                    <span class="text">Ủng hộ</span>
                                </a> --}}
                    <a @click="showFormStar" href="javascript:void(0)" title="Ủng hộ"
                        class="btn-item sm:min-w-[130px] flex-1 sm:flex-none text-[#128c7e] hover:text-[#128c7e] flex flex-col justify-center items-center text-[0.875rem] rounded py-1 px-2 hover:shadow-[0_0.5em_0.5em_-0.3em_rgba(14,109,98,1)]" :class="{ 'text-[#ffd700]': itemDetail.is_ratings > 0 }">
                        <i class="fa-solid fa-star mb-2"></i>
                        <span v-if="itemDetail.is_ratings > 0" class="text">Đã đánh giá</span>
                        <span v-else class="text">Đánh giá</span>
                    </a>

                    <div class="fb-share-button"
                        data-href="{{ route('client.story', ['story_slug' => $story['slug']]) }}"
                        data-layout="box_count" data-size="large"><a target="_blank"
                            href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse"
                            class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
                    {{-- <a href="javascript:void(0)" title="Đề cử"
                                    class="btn-item sm:min-w-[130px] flex-1 sm:flex-none text-[#128c7e] hover:text-[#128c7e] flex flex-col justify-center items-center text-[0.875rem] rounded py-1 px-2 hover:shadow-[0_0.5em_0.5em_-0.3em_rgba(14,109,98,1)] "
                                    modal-rs-target="modal_propose">
                                    <img src="{{ asset('assets//uploads/demo/5start-100x67.png?v=' . FVN_VERSION_LARAVEL) }}"
                                        alt="Linh Phiếu" class="mb-2 inline-block object-contain w-8">
                                    <span class="text">Đề cử</span>
                                </a> --}}
                </div>
            </div>
        </div>
        <div class="basis-full xl:basis-1/4">
            <div class="rate-story mb-2">
                <div class="rating-item w-full">
                    <p class="rating w-full text-center mb-1">
                        <span class="rating-box !text-[1.125rem] !mx-auto">
                            @for ($i = 1; $i <= 10; $i++)
                                @if ($i <= $story['star_average'])
                                    <i class="fa-solid fa-star"></i>
                                @elseif ($story['star_average'] > 0 && $i % $story['star_average'] > 0 && $i % $story['star_average'] < 1)
                                    <i class="fa-regular fa-star-half-stroke"></i>
                                @else
                                    <i class="fa-regular fa-star"></i>
                                @endif
                            @endfor

                        </span>
                    </p>
                </div>
                <div
                    class="rate-box border-silid mt-1 rounded-lg flex flex-wrap justify-between border  border-solid border-[#ddd] overflow-hidden">
                    <p class="num text-center relative flex-1 bg-white">
                        <span class="text-[34px] font-bold text-[#12a62f] ">
                            {{ $story['star_average'] }}
                        </span>
                        <span class="text-small text-[0.75rem] text-[#888] absolute top-4 right-4 z-[1]">/10</span>
                    </p>
                    <p class="bg-[#f4f4f4] text-center relative flex-1 text-[0.875rem] pt-1">
                        <span class="block">Đánh giá</span>
                        <span class="block">{{ $story['star_count'] }} lượt</span>
                    </p>
                </div>
            </div>
            {{-- <p class="text border-b-[1px] border-solid border-[#ccc]">Đề cử gần nhất</p>
                        <ul class="user-recommendation__list">
                        </ul> --}}
        </div>
    </div>

    
    <div @click="closeFormStar"
        class="close_form_star fixed top-0 right-0 left-0 z-50 flex h-full w-full items-center justify-center overflow-hidden overflow-y-auto overflow-x-hidden bg-[#00000099] duration-500 md:inset-0"
        :class="{ 'invisible pointer-events-none opacity-0': !showStar }">
        <div
            class="popup-form md:max-w-[500px] bg-white relative mx-auto max-h-screen w-full max-w-[90%] overflow-y-auto rounded-md md:h-auto">
            <span @click="showStar = false"
                class="close-modal bg-[#128c7e] rounded p-1 flex w-6 h-6 items-center justify-center cursor-pointer absolute top-4 right-4 z-[1]">
                <img src="{{ asset('assets/images/close-modal.png') }}" alt="close">
            </span>
            <p class="font-medium text-[#000] text-[1.3rem] p-4 border-b-[1px] border-solid border-[#ebebeb]">Bạn đọc
                đánh giá!</p>
            <form action="" method="post" class="form p-4 formValidation" accept-charset="utf8">

                <p class="text font-bold text-[#128c7e] mb-4">Bạn đánh giá nội dung truyện này thế nào ?</p>
                <p class="lg:text-[0.875rem] font-bold mb-3">
                    Đánh giá <span class="text-[#dc3545]">(*)</span> : <span
                        class="font-medium">@{{ msgStar }}</span>
                </p>
                <div @mouseleave="leaveStar" class="box-select-rating mb-4">
                    <div class="rating-item w-full">
                        <p class="rating w-full text-center mb-1">
                            <span class="rating-box !text-[1.5rem] !mx-auto">
                                <i v-for="(item, index) in renderStar" @mouseover="hoverStar(index + 1)"
                                    @click="chooseStar(index + 1)" :class="item"
                                    class="cursor-pointer mr-1"></i>
                            </span>

                        </p>
                    </div>
                </div>

                <p class="lg:text-[0.875rem] font-bold mb-2">
                        Bình luận <span class="text-[#dc3545]">(*)</span> : @{{ itemStar.content.length }}/500
                    </p>
                    <textarea v-model="itemStar.content"
                        class="form-control border border-solid border-[#ebebeb] bg-white rounded-md h-16 resize-none mb-2 w-full px-3 py-2"
                        ></textarea>
                    <p v-if="errors.content" class="text-note text-[#d31f1f] mb-4">Nội dung đánh giá ít nhất 30 ký tự và không nhiều hơn 500 ký tự!</p>
                <div class="flex items-center justify-between">
                    <button type="button" @click="voteStar()" class="btn btn-green !rounded">Đánh giá</button>
                    <p class="count-rating text-[#128c7e] lg:text-[0.875rem]">Đánh giá: @{{ itemDetail.star_count }} lượt</p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var vue_story_header_app = {
        showStar: false,
        user: {{ Illuminate\Support\Js::from($user) }},
        itemDetail: {{ Illuminate\Support\Js::from($story) }},
        itemStar: {
            story_id: {{$story['id']}},
            point_star: 0,
            content: ''
        },
        errors: {},
        tmpStars: 0,
        images: {
            starOn: "fa-solid fa-star",
            starHalf: "fa-regular fa-star-half-stroke",
            starOff: "fa-regular fa-star"
        },
        apiUrl: FVN_LARAVEL_HOME + '/story',
        apiMemberUrl: FVN_LARAVEL_HOME + '/api/member',
    };
    var appHeaderStory = new Vue({
        el: '#app_information_story_header',
        data: vue_story_header_app,
        mounted: function() {
            // console.log(this.itemDetail);
            
        },
        computed: {
            renderStar() {
                let render = [];
                for (let i = 1; i <= 10; i++) {
                    if (i <= this.tmpStars) {
                        render.push(this.images.starOn);
                    } else if ((i % this.itemStar.point_star > 0) && (i % this.itemStar.point_star < 1)) {
                        render.push(this.images.starHalf);
                    } else {
                        render.push(this.images.starOff);
                    }
                }
                return render;
            },
            msgStar() {
                if (this.tmpStars == 1) {
                    return 'Không có gì để nói...';
                }
                if (this.tmpStars == 2) {
                    return 'WTF';
                }
                if (this.tmpStars == 3) {
                    return 'Cái gì thế này ?!';
                }
                if (this.tmpStars == 4) {
                    return 'Haizz';
                }
                if (this.tmpStars == 5) {
                    return 'Tạm';
                }
                if (this.tmpStars == 6) {
                    return 'Cũng được';
                }
                if (this.tmpStars == 7) {
                    return 'Khá đấy';
                }
                if (this.tmpStars == 8) {
                    return 'Được';
                }
                if (this.tmpStars == 9) {
                    return 'Hay';
                }
                if (this.tmpStars == 10) {
                    return 'Tuyệt đỉnh!!';
                }
            }
        },
        methods: {
            isAuthLogin() {
                if (!this.user) {
                    jAlertCLient("Bạn cần đăng nhập tài khoản để sử dụng chức năng này", 'danger');
                    return true;
                }
             },
             showFormStar() {
                if (this.isAuthLogin()) {
                    return;
                }
                this.showStar = true
             },
            closeFormStar(e) {
                if (e.target.classList.contains('close_form_star')) {
                    this.showStar = false;
                }

            },
            hoverStar(star) {
                this.tmpStars = star;
            },
            leaveStar() {
                if (this.tmpStars != this.itemStar.point_star) {
                    this.tmpStars = this.itemStar.point_star;
                }
            },
            chooseStar(star) {
                this.itemStar.point_star = star;
            },
            async voteStar() {
                let jsonData = await new RouteApi().post(`${this.apiUrl}/star-rating`, this.itemStar);
                if (jsonData.status) {
                    this.errors = {};
                    jAlertCLient(jsonData.message, 'success');
                    this.itemDetail.is_ratings = 1;
                    this.showStar = false;
                } else {
                    if (jsonData.errors) {
                        this.errors = jsonData.errors;
                    }
                    jAlertCLient(jsonData.message, 'danger');
                }
                // document.querySelector('div[modal-rs="modal-rating"]').classList.add("invisible", "pointer-events-none", "opacity-0");
            },
            async saveFavoriteStory() {
                let jsonData = await new RouteApi().post(`${this.apiMemberUrl}/save-favorite-story`, {
                    story_id: this.itemDetail.id
                }); 
                if (jsonData.status) {
                    jAlertCLient(jsonData.message, 'success');
                    this.itemDetail.is_favorite = jsonData.is_favorite;
                } else {
                    jAlertCLient(jsonData.message, 'danger');
                }
            }
        },
        watch: {

        },
    });
</script>
