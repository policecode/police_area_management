@extends('layouts.frontend_v3')

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
    <section class="section-story__detail py-2">
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
                                {{ $story['title'] }}
                            </h1>
                            <p class="text-info text-[0.875rem]">
                                Tác giả: <a href="{{ route('client.author', ['author_slug' => $story['author_slug']]) }}"
                                    title="{{ $story['author_name'] }}"
                                    class="text-[#00000099]">{{ $story['author_name'] }}</a>
                            </p>
                            {{-- <p class="text-info text-[0.875rem]">
                                Contributor:
                                <a href="../trang-ca-nhan/2.html" title=""
                                    class="text-[#128c7e] hover:text-[#30c5b3]">Sưu Tầm</a>
                            </p> --}}
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
                            {{-- <ul class="tag my-2">
                                <li class="inline-block mb-2 mr-1">
                                    <a href="../tags/tac-dai-than.html" title="Tác Đại Thần"
                                        class="block text-[0.75rem] py-1 px-4 text-center rounded-2xl border border-solid border-[#28a745] hover:text-[#28a745]">
                                        Tác Đại Thần
                                    </a>
                                </li>
                            </ul> --}}
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
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-regular fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-regular fa-star-half-stroke"></i>
                                        <span style="width: 0%;">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </span>
                                    </span>
                                </p>
                            </div>
                            <div
                                class="rate-box border-silid mt-1 rounded-lg flex flex-wrap justify-between border  border-solid border-[#ddd] overflow-hidden">
                                <p class="num text-center relative flex-1 bg-white">
                                    <span class="text-[34px] font-bold text-[#12a62f] ">
                                        {{$story['star_average']}}
                                    </span>
                                    <span
                                        class="text-small text-[0.75rem] text-[#888] absolute top-4 right-4 z-[1]">/10</span>
                                </p>
                                <p class="bg-[#f4f4f4] text-center relative flex-1 text-[0.875rem] pt-1">
                                    <span class="block">Đánh giá</span>
                                    <span class="block">{{$story['star_count']}} lượt</span>
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
                            class="head font-bold p-3 bg-[f8f9fa] border-t-[1px] border-solid border-[#dee2e6] border-b-[2px] lg:text-[1.125rem]">Chương mới</p>
                        <ul class="list-chapter__item">
                            @foreach ($chapters as $item)
                                <li>
                                    <a href="{{ route('client.chaper', ['story_slug' => $story['slug'], 'chaper_slug' => $item['slug']]) }}"
                                        class="flex items-center justify-between py-2 px-3 hover:text-[#252525] hover:bg-[rgba(0,0,0,.09)] border-t-[1px] border-solid border-[#dee2e6]"
                                        title="{{$item['name']}}">
                                        <span class="title line-clamp-1 mr-3 flex-1">{{ucwords($item['name'])}}</span>
                                        <span class="time shrink-0 w-[20%] text-center">{{get_string_after_time($item['after_minutes'])}}</span>
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
                                data-electronic="tab-info-3" data-target="tab-info"
                                onclick="STORY.showChapterList(true)">Danh sách chương</button>
                        </li>
                        <li>
                            <button class="py-1 px-4 border-r-[1px] border-solid border-[#4e4d4d] scroll-to-target"
                                data-target=".box-comment-wapper">Bình luận</button>
                        </li>
                    </ul>
                    <div class="wrapper_tabcontent bg-white shadow-[2px_2px_6px_rgba(0,0,0,.13)] mb-6">
                        <div class="tabcontent p-4 active" data-target="tab-info" id="tab-info-1">
                            <div class="s-content">
                                {!!$story['description']!!}
                            </div>
                        </div>
                        <div class="tabcontent p-4" data-target="tab-info" id="tab-info-2">
                            <div class="max-h-[390px] md:max-h-[495px] overflow-auto">
                                <div id="list-rating-story" data-action="../load-story-rating71fc.html?story=352">
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
                                    <input type="checkbox" id="sort_new_chapter" onchange="STORY.showChapterList(false)">
                                    <span class="font-bold ml-2 shrink-0">Mới nhất</span>
                                </label>
                            </div>
                            <div id="list-chapter-result"></div>
                        </div>
                    </div>
                    <div class="box-comment-wapper p-3 rounded bg-[#fff] mb-6 shadow-[2px_2px_6px_rgba(0,0,0,.13)]">
                        <p class="text-[1.125rem] md:text-[1.25rem] mb-4 font-bold text[rgba(0,0,0,0.8)]">Bình luận (0)
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
                        </div>
                    </div>
                    <div class="swiper-container slide-story__related mb-3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="card-story max-w-[300px]">
                                    <a href="the-gioi-hoan-my.html" title="Thế Giới Hoàn Mỹ"
                                        class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/the-gioi-hoan-my.jpg"
                                                srcset="../uploads/cover/thumbs/350x0/the-gioi-hoan-my.jpg">
                                            <img loading="lazy" src="../uploads/cover/thumbs/350x0/the-gioi-hoan-my.jpg"
                                                data-src="uploads/cover/thumbs/350x0/the-gioi-hoan-my.jpg"
                                                alt="Thế Giới Hoàn Mỹ" class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <h3>
                                        <a href="the-gioi-hoan-my.html" title="Thế Giới Hoàn Mỹ"
                                            class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                            Thế Giới Hoàn Mỹ
                                        </a>
                                    </h3>
                                    <a href="../tac-gia/than-dong.html" title="Thần Đông"
                                        class="cate lg:text-[0.875rem]">
                                        Thần Đông
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card-story max-w-[300px]">
                                    <a href="ta-khong-phai-la-dai-su-bat-quy.html" title="Ta Không Phải Là Đại Sư Bắt Quỷ"
                                        class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/ta-khong-phai-dai-su-bat-quy.jpg"
                                                srcset="../uploads/cover/thumbs/350x0/ta-khong-phai-dai-su-bat-quy.jpg">
                                            <img loading="lazy"
                                                src="../uploads/cover/thumbs/350x0/ta-khong-phai-dai-su-bat-quy.jpg"
                                                data-src="uploads/cover/thumbs/350x0/ta-khong-phai-dai-su-bat-quy.jpg"
                                                alt="Ta Không Phải Là Đại Sư Bắt Quỷ" class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <h3>
                                        <a href="ta-khong-phai-la-dai-su-bat-quy.html"
                                            title="Ta Không Phải Là Đại Sư Bắt Quỷ"
                                            class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                            Ta Không Phải Là Đại Sư Bắt Quỷ
                                        </a>
                                    </h3>
                                    <a href="../tac-gia/duy-khach.html" title="Duy Khách"
                                        class="cate lg:text-[0.875rem]">
                                        Duy Khách
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card-story max-w-[300px]">
                                    <a href="phien-toi.html" title="Phiến Tội"
                                        class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/phien-toi.jpg"
                                                srcset="../uploads/cover/thumbs/350x0/phien-toi.jpg">
                                            <img loading="lazy" src="../uploads/cover/thumbs/350x0/phien-toi.jpg"
                                                data-src="uploads/cover/thumbs/350x0/phien-toi.jpg" alt="Phiến Tội"
                                                class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <h3>
                                        <a href="phien-toi.html" title="Phiến Tội"
                                            class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                            Phiến Tội
                                        </a>
                                    </h3>
                                    <a href="../tac-gia/tam-thien-luong-giac.html"
                                        title="Tam Thiên Lưỡng Giác (Ba Ngày Ngủ Hai)" class="cate lg:text-[0.875rem]">
                                        Tam Thiên Lưỡng Giác (Ba Ngày Ngủ Hai)
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card-story max-w-[300px]">
                                    <a href="tranh-ba-thien-ha.html" title="Tranh Bá Thiên Hạ"
                                        class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/tranh-ba-thien-ha.jpg"
                                                srcset="../uploads/cover/thumbs/350x0/tranh-ba-thien-ha.jpg">
                                            <img loading="lazy" src="../uploads/cover/thumbs/350x0/tranh-ba-thien-ha.jpg"
                                                data-src="uploads/cover/thumbs/350x0/tranh-ba-thien-ha.jpg"
                                                alt="Tranh Bá Thiên Hạ" class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <h3>
                                        <a href="tranh-ba-thien-ha.html" title="Tranh Bá Thiên Hạ"
                                            class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                            Tranh Bá Thiên Hạ
                                        </a>
                                    </h3>
                                    <a href="../tac-gia/tri-bach.html" title="Trí Bạch" class="cate lg:text-[0.875rem]">
                                        Trí Bạch
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card-story max-w-[300px]">
                                    <a href="pham-nhan-tien-gioi-thien.html"
                                        title="Phàm Nhân Tiên Giới Thiên (Phàm Nhân Tu Tiên II)"
                                        class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/pham-nhan-tien-gioi-thien.png"
                                                srcset="../uploads/cover/thumbs/350x0/pham-nhan-tien-gioi-thien.png">
                                            <img loading="lazy"
                                                src="../uploads/cover/thumbs/350x0/pham-nhan-tien-gioi-thien.png"
                                                data-src="uploads/cover/thumbs/350x0/pham-nhan-tien-gioi-thien.png"
                                                alt="Phàm Nhân Tiên Giới Thiên" class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <h3>
                                        <a href="pham-nhan-tien-gioi-thien.html"
                                            title="Phàm Nhân Tiên Giới Thiên (Phàm Nhân Tu Tiên II)"
                                            class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                            Phàm Nhân Tiên Giới Thiên (Phàm Nhân Tu Tiên II)
                                        </a>
                                    </h3>
                                    <a href="../tac-gia/vong-ngu.html" title="Vong Ngữ" class="cate lg:text-[0.875rem]">
                                        Vong Ngữ
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card-story max-w-[300px]">
                                    <a href="thien-tong.html" title="Thiên Tống"
                                        class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/thien-tong.jpg"
                                                srcset="../uploads/cover/thumbs/350x0/thien-tong.jpg">
                                            <img loading="lazy" src="../uploads/cover/thumbs/350x0/thien-tong.jpg"
                                                data-src="uploads/cover/thumbs/350x0/thien-tong.jpg" alt="Thiên Tống"
                                                class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <h3>
                                        <a href="thien-tong.html" title="Thiên Tống"
                                            class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                            Thiên Tống
                                        </a>
                                    </h3>
                                    <a href="../tac-gia/ha-ta.html" title="Hà Tả" class="cate lg:text-[0.875rem]">
                                        Hà Tả
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card-story max-w-[300px]">
                                    <a href="gia-thien.html" title="Già Thiên"
                                        class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/gia-thien.png"
                                                srcset="../uploads/cover/thumbs/350x0/gia-thien.png">
                                            <img loading="lazy" src="../uploads/cover/thumbs/350x0/gia-thien.png"
                                                data-src="uploads/cover/thumbs/350x0/gia-thien.png" alt="Già Thiên"
                                                class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <h3>
                                        <a href="gia-thien.html" title="Già Thiên"
                                            class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                            Già Thiên
                                        </a>
                                    </h3>
                                    <a href="../tac-gia/than-dong.html" title="Thần Đông"
                                        class="cate lg:text-[0.875rem]">
                                        Thần Đông
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card-story max-w-[300px]">
                                    <a href="hi-hoa-du-tung.html" title="Hi Du Hoa Tùng"
                                        class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/hi-du-hoa-tung.png"
                                                srcset="../uploads/cover/thumbs/350x0/hi-du-hoa-tung.png">
                                            <img loading="lazy" src="../uploads/cover/thumbs/350x0/hi-du-hoa-tung.png"
                                                data-src="uploads/cover/thumbs/350x0/hi-du-hoa-tung.png"
                                                alt="Hi Hoa Du Tùng" class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <h3>
                                        <a href="hi-hoa-du-tung.html" title="Hi Du Hoa Tùng"
                                            class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                            Hi Du Hoa Tùng
                                        </a>
                                    </h3>
                                    <a href="../tac-gia/xich-tuyet.html" title="Xích Tuyết"
                                        class="cate lg:text-[0.875rem]">
                                        Xích Tuyết
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card-story max-w-[300px]">
                                    <a href="sung-mi.html" title="Sủng Mị"
                                        class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/users/story/thumbs/350x0/7c5489f0d160f9f2556648faa665e558.jpg"
                                                srcset="../uploads/users/story/thumbs/350x0/7c5489f0d160f9f2556648faa665e558.jpg">
                                            <img loading="lazy"
                                                src="../uploads/users/story/thumbs/350x0/7c5489f0d160f9f2556648faa665e558.jpg"
                                                data-src="uploads/users/story/thumbs/350x0/7c5489f0d160f9f2556648faa665e558.jpg"
                                                alt="7c5489f0d160f9f2556648faa665e558.jpg" class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <h3>
                                        <a href="sung-mi.html" title="Sủng Mị"
                                            class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                            Sủng Mị
                                        </a>
                                    </h3>
                                    <a href="../tac-gia/ngu-thien-khong.html" title="Ngư Thiên Không"
                                        class="cate lg:text-[0.875rem]">
                                        Ngư Thiên Không
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="card-story max-w-[300px]">
                                    <a href="phong-luu-phap-su.html" title="Phong Lưu Pháp Sư"
                                        class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/users/story/thumbs/350x0/1000-f-559396852-2ptoueghn56g2bvyb82udx3zkfz19fuz.jpg"
                                                srcset="../uploads/users/story/thumbs/350x0/1000-f-559396852-2ptoueghn56g2bvyb82udx3zkfz19fuz.jpg">
                                            <img loading="lazy"
                                                src="../uploads/users/story/thumbs/350x0/1000-f-559396852-2ptoueghn56g2bvyb82udx3zkfz19fuz.jpg"
                                                data-src="uploads/users/story/thumbs/350x0/1000-f-559396852-2ptoueghn56g2bvyb82udx3zkfz19fuz.jpg"
                                                alt="1000-f-559396852-2ptoueghn56g2bvyb82udx3zkfz19fuz.jpg"
                                                class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <h3>
                                        <a href="phong-luu-phap-su.html" title="Phong Lưu Pháp Sư"
                                            class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                            Phong Lưu Pháp Sư
                                        </a>
                                    </h3>
                                    <a href="../tac-gia/thien-duong-bat-tich-mich.html" title="Thiên Đường Bất Tịch Mịch"
                                        class="cate lg:text-[0.875rem]">
                                        Thiên Đường Bất Tịch Mịch
                                    </a>
                                </div>
                            </div>
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
                    <div class="sidebar-story">
                        <div
                            class="box-story__sidebar bg-[#f8f9fa] shadow-[0_0_1px_rgba(0,0,0,.13)] mb-6 last:mb-0 rounded-md overflow-hidden border border-solid border-[rgba(0,0,0,.125)]">
                            <div
                                class="head flex items-center justify-between p-3 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                                <p class="text-[0.938rem] font-bold">Truyện cùng tác giả</p>
                            </div>
                            <ul class="list-story__item">
                                <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                    <div class="flex items-center justify-between">
                                        <a href="vu-tru-chuc-nghiep-tuyen-thu.html"
                                            class="w-[75%] line-clamp-1 text-[0.875rem]"
                                            title="Vũ Trụ Chức Nghiệp Tuyển Thủ (Tuyển Thủ Chuyên Nghiệp Hoàn Vũ)">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Vũ Trụ Chức
                                            Nghiệp Tuyển Thủ (Tuyển Thủ Chuyên Nghiệp Hoàn Vũ)
                                        </a>
                                        <a href="../tac-gia/nga-cat-tay-hong-thi.html"
                                            title="Ngã Cật Tây Hồng Thị (Cà Chua)"
                                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">Ngã Cật
                                            Tây Hồng Thị (Cà Chua)</a>
                                    </div>
                                    <p class="text-[12px] text-[#999999] mt-[2px]">views: 16.112</p>
                                </li>
                                <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                    <div class="flex items-center justify-between">
                                        <a href="cuu-dinh-ki.html" class="w-[75%] line-clamp-1 text-[0.875rem]"
                                            title="Cửu Đỉnh Kí">
                                            <span class="prefix" style="color: #ffbb00">[Free]</span> Cửu Đỉnh Kí
                                        </a>
                                        <a href="../tac-gia/nga-cat-tay-hong-thi.html"
                                            title="Ngã Cật Tây Hồng Thị (Cà Chua)"
                                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">Ngã Cật
                                            Tây Hồng Thị (Cà Chua)</a>
                                    </div>
                                    <p class="text-[12px] text-[#999999] mt-[2px]">views: 15.608</p>
                                </li>
                            </ul>
                        </div>
              
               
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <div class="fixed top-0 right-0 left-0 z-50 flex h-full w-full items-center justify-center overflow-hidden overflow-y-auto overflow-x-hidden bg-[#00000099] duration-500 md:inset-0 invisible pointer-events-none opacity-0"
        modal-rs="modal_donate">
        <div class="popup-form md:max-w-[500px] bg-white relative mx-auto max-h-screen w-full max-w-[90%] overflow-y-auto rounded-md md:h-auto"
            modal-rs-content="">
            <span
                class="close-modal bg-[#128c7e] rounded p-1 flex w-6 h-6 items-center justify-center cursor-pointer absolute top-4 right-4 z-[1]"
                modal-rs-close>
                <img src="{{ asset('assets/images/close-modal.png') }}" alt="">
            </span>
            <p class="font-bold text-[#000] text-[1.3rem] p-4 border-b-[1px] border-solid border-[#ebebeb]">Ủng hộ
                contributor</p>
            <form action="https://banlong.us/send-donate-story" method="POST" class="form p-4 formValidation"
                accept-charset="utf8" absolute data-success="NOTIFICATION.toastrMessageReload">
                <input type="hidden" name="_token" value="f6n6nXmbaeGSTOsTpgAo7wkhO38kABB3FFG2GsG7"> <input
                    type="hidden" name="story" value="352">
                <p class="text font-bold mb-2">Số Linh Thạch</p>
                <input type="number" name="amount" value="200"
                    class="form-control border border-solid border-[#ebebeb] bg-white rounded-md"
                    rules="required||number||min:200||max:500000">
                <p class="sub text-[#128c7e] text-[0.75rem] italic mb-4 mt-1">Mức ủng hộ tối thiểu 200LT và là bội số
                    của 10LT</p>
                <p class="text font-bold mb-2">Lời nhắn (nếu có)</p>
                <textarea
                    class="form-control border border-solid border-[#ebebeb] bg-white rounded-md h-16 resize-none mb-4 w-full px-3 py-2"
                    name="content"></textarea>
                <button type="submit" class="btn btn-green !rounded">Gửi ủng hộ</button>
            </form>
        </div>
    </div> --}}
    {{-- <div class="fixed top-0 right-0 left-0 z-50 flex h-full w-full items-center justify-center overflow-hidden overflow-y-auto overflow-x-hidden bg-[#00000099] duration-500 md:inset-0 invisible pointer-events-none opacity-0"
        modal-rs="modal_propose">
        <div class="popup-form md:max-w-[500px] bg-white relative mx-auto max-h-screen w-full max-w-[90%] overflow-y-auto rounded-md md:h-auto"
            modal-rs-content="">
            <span
                class="close-modal bg-[#128c7e] rounded p-1 flex w-6 h-6 items-center justify-center cursor-pointer absolute top-4 right-4 z-[1]"
                modal-rs-close>
                <img src="{{ asset('assets/images/close-modal.png') }}" alt="">
            </span>
            <p class="font-bold text-[#000] text-[1.3rem] p-4 border-b-[1px] border-solid border-[#ebebeb]">Đề Cử</p>
            <form action="https://banlong.us/send-nomination-story" method="POST" class="form p-4 formValidation"
                accept-charset="utf8" absolute data-success="NOTIFICATION.toastrMessageReload">
                <input type="hidden" name="_token" value="f6n6nXmbaeGSTOsTpgAo7wkhO38kABB3FFG2GsG7"> <input
                    type="hidden" name="story" value="352">
                <p class="text font-bold mb-2">Số lượng Linh Phiếu đề cử</p>
                <input type="number" name="amount" value="1"
                    class="form-control border border-solid border-[#ebebeb] bg-white rounded-md"
                    rules="required||number||min:1">
                <div class="s-content text-[#128c7e] my-4">
                    <p>- Bạn sẽ nhận được số Linh Thạch khuyến mãi (LTKM) tương ứng với số Linh Phiếu đề cử.</p>
                    <p>- Đề cử sẽ giúp truyện lên Top Linh Phiếu.</p>
                    <p>- Dùng 200 Linh Thạch để mua chương sẽ nhận được 1 Linh Phiếu (Không tính Linh Thạch KM, không
                        tính Ủng hộ).</p>
                    <p>- Một số sự kiện, minigame, tri ân,... sẽ được tặng Linh Phiếu.</p>
                </div>
                <button type="submit" class="btn btn-green !rounded">Đề cử</button>
            </form>
        </div>
    </div> --}}
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
                <p class="lg:text-[0.875rem] font-bold mb-2">
                    Bình luận <span class="text-[#dc3545]">(*)</span> :
                </p>
                <textarea
                    class="form-control border border-solid border-[#ebebeb] bg-white rounded-md h-16 resize-none mb-2 w-full px-3 py-2"
                    rules="required||minLength:30" name="content"></textarea>
                <p class="text-note text-[#607d8b] mb-4">Nội dung đánh giá ít nhất 30 ký tự!</p>
                <div class="flex items-center justify-between">
                    <button type="submit" class="btn btn-green !rounded">Đánh giá</button>
                    <p class="count-rating text-[#128c7e] lg:text-[0.875rem]">Đánh giá: 0 lượt</p>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('frontend/js/story.js') }}"></script>
@endsection
