@extends('layouts.frontend_v2')

@section('head')
    <meta name="robots" content="all" />
    <meta name="googlebot" content="all">
    <script type="application/ld+json"> 
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "headline": "{{ $page_title }}",
            "image": [
                "{{ $story['thumbnail'] }}" 
             ],
            "datePublished":  "{{ $story['created_at'] }}" ,
            "dateModified":  "{{ $story['updated_at'] }}" ,
            "author": [{
                "@type": "Person",
                "name": "{{ $story['author_name'] }}",
                "url": "{{ route('client.author', ['author_slug' => $story['author_slug']]) }}"
              }]
          }
    </script>
@endsection
@section('content')
    <script src="{{ asset('assets_global/js/vue-input.js') }}"></script>
    <section id="app_information_story_chapers" class="section-story__detail py-2">
        <div class="container">
            <div class="box p-2 rounded-lg border border-solid border-[#ddd] bg-[#ffffff] mb-4">
                <div class="flex flex-wrap ">
                    <div class="basis-full w-full xl-w-75 xl:basis-3/4 px-2 flex flex-wrap mb-3 xl:mb-0">
                        <div
                            class="image-story w-full sm:w-[22%] shrink-0 img_full rounded-lg overflow-hidden mr-4 mb-2 sm:mb-0 relative">
                            <picture>
                                <img loading="lazy" src="{{ $story['thumbnail'] }}" alt=" {{ $story['title'] }}"
                                    class="img-fluid">
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
                                    title="{{ $story['author_name'] }}"
                                    class="text-[#00000099]">{{ $story['author_name'] }}</a>
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
                                <a href="cuu-dinh-ki/chuong-1.html" title="Đọc từ đầu"
                                    class="btn btn-green hover:text-white font-bold mr-2 last:mr-0 sm:min-w-[130px] mb-2">
                                    <i class="fa-solid fa-book-open-reader mr-2"></i>Đọc từ đầu
                                </a>
                                {{-- <a href="javascript:void(0)" data-action="https://banlong.us/do-favorite-story"
                                    data-item="352"
                                    class="btn btn-green hover:text-white font-bold mr-2 last:mr-0 sm:min-w-[130px] mb-2 btn-favorite-story not-login ">
                                    <i class="fa-solid fa-book mr-2"></i>
                                    <span class="save-story-text">Lưu truyện</span>
                                </a> --}}
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
                                <a href="javascript:void(0)" title="Ủng hộ"
                                    class="btn-item sm:min-w-[130px] flex-1 sm:flex-none text-[#128c7e] hover:text-[#128c7e] flex flex-col justify-center items-center text-[0.875rem] rounded py-1 px-2 hover:shadow-[0_0.5em_0.5em_-0.3em_rgba(14,109,98,1)]"
                                    modal-rs-target="modal-rating">
                                    <i class="fa-solid fa-star mb-2"></i>
                                    <span class="text">Đánh giá</span>
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
                                            @elseif ($i % $story['star_average'] > 0 && $i % $story['star_average'] < 1)
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
                                    <span
                                        class="text-small text-[0.75rem] text-[#888] absolute top-4 right-4 z-[1]">/10</span>
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
            </div>
            <div class="flex flex-wrap -mx-2 ">
                <div class="basis-full w-full xl-w-75 xl:basis-3/4 px-2 mb-3 xl:mb-0">
                    <div class="box-chapter bg-white shadow-[2px_2px_6px_rgba(0,0,0,.13)] mb-6">
                        <p
                            class="head font-bold p-3 bg-[f8f9fa] border-t-[1px] border-solid border-[#dee2e6] border-b-[2px] lg:text-[1.125rem]">
                            Chương mới</p>
                        <ul class="list-chapter__item">
                            @foreach ($chapters as $item)
                                <li>
                                    <a href="{{ route('client.chaper', ['story_slug' => $story['slug'], 'chaper_slug' => $item['slug']]) }}"
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
                            <button class="tablinks py-1 px-4 border-r-[1px] border-solid border-[#4e4d4d] active"
                                data-electronic="tab-info-1" data-target="tab-info">Giới thiệu</button>
                        </li>
                        {{-- <li>
                            <button class="tablinks py-1 px-4 border-r-[1px] border-solid border-[#4e4d4d]"
                                data-electronic="tab-info-2" data-target="tab-info" onclick="STORY.initListRating()">Đánh
                                giá</button>
                        </li> --}}
                        <li>
                            <button id="but-show-list-chapter"
                                class="tablinks py-1 px-4 border-r-[1px] border-solid border-[#4e4d4d]"
                                data-electronic="tab-info-3" data-target="tab-info">Danh sách chương</button>
                        </li>
                        <li>
                            <button class="py-1 px-4 border-r-[1px] border-solid border-[#4e4d4d] scroll-to-target"
                                data-target=".box-comment-wapper">Bình luận</button>
                        </li>
                    </ul>
                    <div class="wrapper_tabcontent bg-white shadow-[2px_2px_6px_rgba(0,0,0,.13)] mb-6">
                        <div class="tabcontent p-4 active" data-target="tab-info" id="tab-info-1">
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
                        <div class="tabcontent p-4" data-target="tab-info" id="tab-info-3">
                            <div class="chapters-table__operations flex items-center justify-between flex-wrap mb-1">
                                <label class="flex items-center shrink-0">
                                    <input type="checkbox" v-model="showDesc"/>
                                    <span class="font-bold ml-2 shrink-0">Mới nhất</span>
                                </label>
                            </div>
                            <div id="list-chapter-result">
                                <table class="table-list__chapter w-full">
                                    <thead>
                                        <tr class="text-white bg-[#212529]">
                                            <td class="font-bold p-3 text-center w-[10%]">STT</td>
                                            <td class="font-bold p-3">Tựa chương</td>
                                            <td class="font-bold p-3 text-center w-[25%]"><i
                                                    class="fa-solid fa-clock"></i></td>
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

                                <fvn-paging-client :page="querySearch.page" :per_page="querySearch.per_page" :total="querySearch.total" @change-page="(page) => nextPage(page)" :show_page="5"></fvn-paging-client>
                            </div>
                        </div>
                    </div>
                    <div id="comment__stories"
                        class="box-comment-wapper p-3 rounded bg-[#fff] mb-6 shadow-[2px_2px_6px_rgba(0,0,0,.13)]">
                        <div class="fb-comments"
                            data-href="{{ route('client.story', ['story_slug' => $story['slug']]) }}" data-width="100%"
                            data-colorscheme="dark" data-numposts="10" data-mobile="true"></div>
                        {{-- <p class="text-[1.125rem] md:text-[1.25rem] mb-4 font-bold text[rgba(0,0,0,0.8)]">Bình luận (0)
                        </p>
                        <div class="simple-comment-box hidden"
                            idx="RWwzV0xLUjRBcGh5czJ6ZkZtRUZKTmRKa3pkelM2VFhwVmVVMXFWWGhOVmxORWJIcGhZVUpDV2t0VFlVSnJNREZUYmxSYU5HWTVSVU5XWlhjPQ=="
                            identifier="U2Ywa3JWQklPc2puZ2FSTmdjdUwwUHhxc3c2VUtyWXpOU2RtTnRiR3hqZWtrMVRVRTlQVmw2UW5oTE5qZFdOMFowYms1b00wbExUWFJyVVhOcVRYUnJUR1pKUmc9PQ=="
                            referrer="truyen/cuu-dinh-ki">
                            <p class="mb-2">* Hãy <a href="../dang-nhap.html" class="text-[#128c7e] font-bold"
                                    title="">đăng nhập</a> để tham gia bình luận về truyện nhé.</p>
                            <div class="comment-fillter-box">
                                <span>Sắp xếp: </span>
                                <select class="comment-fillter-sort border border-[#aaa] rounded px-3 py-1">
                                    <option value="1">Mới nhất</option>
                                    <option value="2">Cũ nhất</option>
                                    <option value="3">Nhiều lượt like nhất</option>
                                </select>
                            </div>
                            <div class="list-comment" cmt-target="0"></div>
                        </div> --}}
                    </div>
                    <div class="swiper-container slide-story__related mb-3">
                        <div class="swiper-wrapper">
                            @foreach ($related_stories as $item)
                                <div class="swiper-slide">
                                    <div class="card-story max-w-[300px]">
                                        <a href="{{ route('client.story', ['story_slug' => $story['slug']]) }}" title="{{$item['title']}}"
                                            class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                            <picture>
                                                <source media="(min-width:0px)" srcset="{{$item['thumbnail']}}">
                                                <img loading="lazy" src="{{$item['thumbnail']}}" alt="{{$item['title']}}" class="img-fluid">
                                            </picture> 
                                            @if ($item['status'] == 1)
                                                <span class="novel-stripe">
                                                    <span class="story-status">FULL</span>
                                                </span>
                                            @endif
                                        </a>
                                        <h3>
                                            <a href="{{ route('client.story', ['story_slug' => $story['slug']]) }}" title="Thế Giới Hoàn Mỹ"
                                                class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                                {{ucwords($item['title'])}}
                                            </a>
                                        </h3>
                                        <a href="{{ route('client.author', ['author_slug' => $item['author_slug']]) }}" title="Thần Đông" class="cate lg:text-[0.875rem]">
                                            {{ucwords($item['author_name'])}}
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div
                            class="swiper-button swiper-prev related-prev flex items-center justify-center absolute top-[40%] left-0 -translate-y-1/2 z-[1] cursor-pointer w-10 h-10 rounded-full bg-[#f0f8ff] text-[#128c7e] text-[1.3rem]">
                            <i class="fa-solid fa-chevron-left"></i>
                        </div>
                        <div
                            class="swiper-button swiper-next related-next flex items-center justify-center absolute top-[40%] right-0 -translate-y-1/2 z-[1] cursor-pointer w-10 h-10 rounded-full bg-[#f0f8ff] text-[#128c7e] text-[1.3rem]">
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </div>
                </div>
                <div class="basis-full xl:basis-1/4 px-2">
                    @if (count($story_by_author))
                        <div class="sidebar-story">
                            <div
                                class="box-story__sidebar bg-[#f8f9fa] shadow-[0_0_1px_rgba(0,0,0,.13)] mb-6 last:mb-0 rounded-md overflow-hidden border border-solid border-[rgba(0,0,0,.125)]">
                                <div
                                    class="head flex items-center justify-between p-3 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                                    <p class="text-[0.938rem] font-bold">Truyện cùng tác giả</p>
                                </div>
                                <ul class="list-story__item">
                                    @foreach ($story_by_author as $item)
                                        <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                            <div class="flex items-center justify-between">
                                                <a href="{{ route('client.story', ['story_slug' => $item['slug']]) }}"
                                                    class="w-[75%] line-clamp-1 text-[0.875rem]" title="{{ $item['title'] }}">
                                                    @if ($item['is_convert'])
                                                        <span class="prefix text-[#128c7e]">[Convert]</span>
                                                    @else
                                                        <span class="prefix text-[#128c7e]" style="color: #0000ff;">[Dịch]</span>
                                                    @endif
                                                    {{ ucwords($item['title']) }}
                                                </a>
                                                <a href="{{ route('client.author', ['author_slug' => $item['author_slug']]) }}"
                                                    title="{{ $item['author_name'] }}" class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">
                                                    {{ ucwords($item['author_name']) }}
                                                </a>
                                            </div>
                                            <p class="text-[12px] text-[#999999] mt-[2px]">views: {{ $item['view_count'] }}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>


                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="fixed top-0 right-0 left-0 z-50 flex h-full w-full items-center justify-center overflow-hidden overflow-y-auto overflow-x-hidden bg-[#00000099] duration-500 md:inset-0 invisible pointer-events-none opacity-0"
            modal-rs="modal-rating">
            <div class="popup-form md:max-w-[500px] bg-white relative mx-auto max-h-screen w-full max-w-[90%] overflow-y-auto rounded-md md:h-auto"
                modal-rs-content="">
                <span
                    class="close-modal bg-[#128c7e] rounded p-1 flex w-6 h-6 items-center justify-center cursor-pointer absolute top-4 right-4 z-[1]"
                    modal-rs-close>
                    <img src="{{ asset('assets/images/close-modal.png') }}" alt="">
                </span>
                <p class="font-medium text-[#000] text-[1.3rem] p-4 border-b-[1px] border-solid border-[#ebebeb]">Bạn đọc
                    đánh giá!</p>
                <form action="https://banlong.us/rating" method="post" class="form p-4 formValidation"
                    accept-charset="utf8" absolute data-success="NOTIFICATION.toastrMessageReload">
                    <input type="hidden" name="_token" value="f6n6nXmbaeGSTOsTpgAo7wkhO38kABB3FFG2GsG7"> <input
                        type="hidden" name="type" value="story">
                    <input type="hidden" name="item" value="352">
                    <p class="text font-bold text-[#128c7e] mb-4">Bạn đánh giá nội dung truyện này thế nào ?</p>
                    <p class="lg:text-[0.875rem] font-bold mb-3">
                        Đánh giá <span class="text-[#dc3545]">(*)</span> :
                    </p>
                    <div class="box-select-rating mb-4">
                        <input type="radio" id="rating10" name="rating" value="10" />
                        <label for="rating10"></label>

                        <input type="radio" id="rating9" name="rating" value="9" />
                        <label class="half" for="rating9"></label>

                        <input type="radio" id="rating8" name="rating" value="8" />
                        <label for="rating8"></label>

                        <input type="radio" id="rating7" name="rating" value="7" />
                        <label class="half" for="rating7"></label>

                        <input type="radio" id="rating6" name="rating" value="6" />
                        <label for="rating6"></label>

                        <input type="radio" id="rating5" name="rating" value="5" />
                        <label class="half" for="rating5"></label>

                        <input type="radio" id="rating4" name="rating" value="4" />
                        <label for="rating4"></label>

                        <input type="radio" id="rating3" name="rating" value="3" />
                        <label class="half" for="rating3"></label>

                        <input type="radio" id="rating2" name="rating" value="2" />
                        <label for="rating2"></label>

                        <input type="radio" id="rating1" name="rating" value="1" />
                        <label class="half" for="rating1"></label>
                    </div>
                    {{-- <p class="lg:text-[0.875rem] font-bold mb-2">
                        Bình luận <span class="text-[#dc3545]">(*)</span> :
                    </p>
                    <textarea
                        class="form-control border border-solid border-[#ebebeb] bg-white rounded-md h-16 resize-none mb-2 w-full px-3 py-2"
                        rules="required||minLength:30" name="content"></textarea>
                    <p class="text-note text-[#607d8b] mb-4">Nội dung đánh giá ít nhất 30 ký tự!</p> --}}
                    <div class="flex items-center justify-between">
                        <button type="submit" class="btn btn-green !rounded">Đánh giá</button>
                        <p class="count-rating text-[#128c7e] lg:text-[0.875rem]">Đánh giá: 0 lượt</p>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <script>
        var vue_story_information_app = {
            loading: false,
            showDesc: false,
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
                this.searchItem();
            },
            computed: {
                // renderStar() {
                //     let render = [];
                //     for (let i = 1; i <= 10; i++) {
                //         if (i <= this.stars) {
                //             render.push(this.images.starOn);
                //         } else if ((i % this.stars > 0) && (i % this.stars < 1)) {
                //             render.push(this.images.starHalf);
                //         } else {
                //             render.push(this.images.starOff);
                //         }
                //     }
                //     return render;
                // },

            },
            methods: {
                searchItem() {
                    this.getItems();
                    this.getPaging();
                },
                async getItems() {
                    this.loading = true;
                    this.items = [];
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
                }
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
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/swiper-bundle.minb2fd.js?v=' . FVN_VERSION_LARAVEL) }}" type="text/javascript" defer>
    </script>
    <script src="{{ asset('assets/js/slider42bb.js?v=' . FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
    <script src="{{ asset('assets/js/tabsb2fd.js?v=' . FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
    <script src="{{ asset('assets/frontend/js/confirm.minb2fd.js?v=' . FVN_VERSION_LARAVEL) }}" type="text/javascript"
        defer></script>
    <script src="{{ asset('assets/frontend/js/infinite-loadb2fd.js?v=' . FVN_VERSION_LARAVEL) }}" type="text/javascript"
        defer></script>
    {{-- <script src="{{ asset('assets/frontend/js/story4287.js?v='.FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script> --}}
@endsection
