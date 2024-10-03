@extends('layouts.client')

@section('content')
    <main>

        <input type="hidden" id="story_slug" value="nang-khong-muon-lam-hoang-hau">
        <div class="container">
            <div class="row align-items-start">
                <div class="col-12 col-md-7 col-lg-8">
                    <div class="head-title-global d-flex justify-content-between mb-4">
                        <div class="col-12 col-md-12 col-lg-4 head-title-global__left d-flex">
                            <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                                <span class="d-block text-decoration-none text-dark fs-4 title-head-name"
                                    title="Thông tin truyện">Thông
                                    tin truyện</span>
                            </h2>
                        </div>
                    </div>

                    <div class="story-detail">
                        <div class="story-detail__top d-flex align-items-start">
                            <div class="row align-items-start">
                                <div class="col-12 col-md-12 col-lg-3 story-detail__top--image">
                                    <div class="book-3d">
                                        <img src="{{$story['thumbnail']}}"
                                            alt="{{$story['title']}}" class="img-fluid w-100" width="200"
                                            height="300" loading="lazy">
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-9">
                                    <h3 class="text-center story-name text-capitalize">{{$story['title']}}</h3>
                                    <div class="rate-story mb-2">
                                        <div class="rate-story__holder" data-score="7.0">
                                            <img alt="1" src="{{asset('/assets/images/star-on.png')}}">
                                            <img alt="2" src="{{asset('/assets/images/star-on.png')}}">
                                            <img alt="3" src="{{asset('/assets/images/star-on.png')}}">
                                            <img alt="4" src="{{asset('/assets/images/star-on.png')}}">
                                            <img alt="5" src="{{asset('/assets/images/star-on.png')}}">
                                            <img alt="6" src="{{asset('/assets/images/star-on.png')}}">
                                            <img alt="7" src="{{asset('/assets/images/star-half.png')}}">
                                            <img alt="8" src="{{asset('/assets/images/star-off.png')}}">
                                            <img alt="9" src="{{asset('/assets/images/star-off.png')}}">
                                            <img alt="10" src="{{asset('/assets/images/star-off.png')}}">
                                        </div>
                                        <em class="rate-story__text"></em>
                                        <div class="rate-story__value" itemprop="aggregateRating" itemscope=""
                                            itemtype="https://schema.org/AggregateRating">
                                            <em>Đánh giá:
                                                <strong>
                                                    <span itemprop="ratingValue">{{$story['star_average']}}</span>
                                                </strong>
                                                /
                                                <span class="" itemprop="bestRating">10</span>
                                                từ
                                                <strong>
                                                    <span itemprop="ratingCount">{{$story['star_count']}}</span>
                                                    lượt
                                                </strong>
                                            </em>
                                        </div>
                                    </div>

                                    <div class="story-detail__top--desc px-3" style="max-height: 285px;">
                                        {!! nl2br($story['description'])!!}
                                    </div>

                                    <div class="info-more">
                                        <div class="info-more--more active" id="info_more">
                                            <span class="me-1 text-dark">Xem thêm</span>
                                            <i class="fa-solid fa-sort-down"></i>
                                        </div>

                                        <div class="info-more--collapse text-decoration-none">
                                            <span class="me-1 text-dark">Thu gọn</span>
                                            <i class="fa-solid fa-caret-up"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="story-detail__bottom mb-3">
                            <div class="row">
                                <div class="col-12 col-md-12 col-lg-3 story-detail__bottom--info">
                                    <p class="mb-1">
                                        <strong>Tác giả:</strong>
                                        <a href="{{route('client.author', ['author_slug' => $story['author_slug']])}}" class="text-decoration-none text-dark hover-title">{{$story['author_name']}}</a>
                                    </p>
                                    <div class="d-flex align-items-center mb-1 flex-wrap">
                                        <strong class="me-1">Thể loại:</strong>
                                        <div class="d-flex align-items-center flex-warp">
                                            @foreach ($story['categories'] as $item)
                                                <a href="{{ route('client.tag', ['tag_slug' => $item['slug']]) }}"
                                                    class="text-decoration-none text-dark hover-title  me-1 "
                                                    style="width: max-content;">{{$item['name']}} ,
                                                </a>
                                                
                                            @endforeach
                                        </div>
                                    </div>

                                    <p class="mb-1">
                                        <strong>Trạng thái:</strong>
                                        <span class="{{$story['status'] == 1 ? 'text-info':'text-success'}}">{{$story['status_name']}}</span>
                                    </p>
                                </div>

                            </div>
                        </div>

                        <div class="story-detail__list-chapter">
                            <div class="head-title-global d-flex justify-content-between mb-4">
                                <div class="col-6 col-md-12 col-lg-4 head-title-global__left d-flex">
                                    <h2 class="me-2 mb-0 border-bottom border-secondary pb-1">
                                        <span href="#"
                                            class="d-block text-decoration-none text-dark fs-4 title-head-name"
                                            title="Truyện hot">Danh sách chương</span>
                                    </h2>
                                </div>
                            </div>

                            <div class="story-detail__list-chapter--list">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-lg-6 story-detail__list-chapter--list__item">
                                        <ul>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 1: Nàng
                                                    không tin Yến Đình lại lừa nàng chuyện lớn đến vậy!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 2: Ngũ
                                                    hoàng tử bùi thừa tư trở về!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 3: Oan gia
                                                    ngõ hẹp!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 4: Đây
                                                    chính là thành trường an!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 5: Dám
                                                    quấy nhiễu xa giá của điện hạ!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 6: Ngài
                                                    thương yêu nàng, bao bọc nàng ấy trong nhung lụa, không phải tốt hay
                                                    sao?</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 7: Hoá ra
                                                    ác nhân còn không biết xấu hổ đi cáo trạng trước!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 8: Phu
                                                    quân ngươi đâu? sao hắn không đến cứu ngươi?</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 9: Ngươi
                                                    vừa nói vân cô nương kia tên là gì?</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 10: "sao
                                                    bây giờ chàng mới đến tìm ta?”</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 11: Hoá ra
                                                    chỉ có nàng là tự cho mình đúng!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 12: Hắn
                                                    cúi người hôn lên môi nàng!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 13: Ai
                                                    càng lún sâu vào tình ái thì người ấy không thể làm được gì!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 14: Giống
                                                    như nàng đang gấp gáp đòi danh phận!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 15:
                                                    Ngoan!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 16: Nghiêm
                                                    khắc với nàng là muốn nàng được tốt hơn!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 17: Năm đó
                                                    ta và nàng kết tóc làm phu thê, dù thế nào cũng không thay đổi!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 18: Phó
                                                    dư!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 19: Có
                                                    người không muốn để nàng yên ổn!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 20: Có
                                                    phải uy hiếp hay không, quận chúa có thể thử!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 21: Các
                                                    nàng không canh chừng nàng cẩn thận, đương nhiên sẽ bị phạt!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 22: Bùi
                                                    thừa tư, rốt cuộc chàng xem ta là gì?</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 23: Giam
                                                    cầm và phong hậu!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 24: Ta sẽ
                                                    không xem chàng quan trọng hơn bản thân mình nữa!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 25: Ba lời
                                                    hứa!</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-6 story-detail__list-chapter--list__item">
                                        <ul>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 26: Mỹ
                                                    nhân!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 27: Tài nữ
                                                    uyên bác!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 28: Yến
                                                    lang!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 29: Điều
                                                    trị thân thể để dễ dàng mang thai!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 30: Vậy
                                                    thì chàng hãy thu lại hậu vị này đi!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 31: Giống
                                                    như c**ng bức nàng!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 32: Ta
                                                    biết trước giờ chàng vẫn thiên vị ngu gia!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 33: A
                                                    kiều, nàng thật biết cách chọc cho ta tức giận!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 34: Dỗ hắn
                                                    vui vẻ, để đạt được mục đích!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 35: Phó dư
                                                    cũng đã đến tuổi nghị thân!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 36: Mang
                                                    theo ý tứ “lấy sắc hầu người”!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 37: Có
                                                    người muốn giết ta!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 38: Tấu sớ
                                                    yêu cầu lấp đầy hậu cung!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 39: Đừng ở
                                                    trong cung nữa!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 40: Nàng
                                                    ta có thai!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 41: Thuốc
                                                    hoa hồng để ph* thai!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 42: Chọn
                                                    cách quyết liệt nhất để cắt đứt với hắn!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 43: Ta
                                                    ghét phải nhìn thấy ngươi!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 44: Ngươi
                                                    sẽ đi lên vết xe đổ của tiên đế!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 45: Giữa
                                                    ta và hắn, đã chú định là không có kết quả!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 46: Giống
                                                    như dính phải thứ gì đó dơ bẩn!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 47: Trần
                                                    gia có một vị hoàng hậu đã qua đời!</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 48: Thánh
                                                    thượng không tuân theo quy củ nữa sao?</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 49: Mê
                                                    hương</a>
                                            </li>
                                            <li>
                                                <a href="chapter.html"
                                                    class="text-decoration-none text-dark hover-title">Chương 50: “thánh
                                                    thượng không cần đại cục nữa sao?”</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pagination" style="justify-content: center;">
                            <ul>
                                <li class="pagination__item  page-current">
                                    <a class="page-link story-ajax-paginate"
                                        data-url="https://suustore.com/truyen/nang-khong-muon-lam-hoang-hau?page=1"
                                        style="cursor: pointer;">1</a>
                                </li>
                                <li class="pagination__item ">
                                    <a class="page-link story-ajax-paginate"
                                        data-url="https://suustore.com/truyen/nang-khong-muon-lam-hoang-hau?page=2"
                                        style="cursor: pointer;">2</a>
                                </li>

                                <div class="dropup-center dropup choose-paginate me-1">
                                    <button class="btn btn-success dropdown-toggle" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Chọn trang
                                    </button>
                                    <div class="dropdown-menu">
                                        <input type="number" class="form-control input-paginate me-1" value="">
                                        <button class="btn btn-success btn-go-paginate">
                                            Đi
                                        </button>
                                    </div>
                                </div>

                                <li class="pagination__arrow pagination__item">
                                    <a data-url="https://suustore.com/truyen/nang-khong-muon-lam-hoang-hau?page=2"
                                        style="cursor: pointer;"
                                        class="text-decoration-none w-100 h-100 d-flex justify-content-center align-items-center story-ajax-paginate">
                                        &gt;&gt;
                                    </a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-5 col-lg-4 sticky-md-top">

                    <div class="row top-ratings">
                        <div class="col-12 top-ratings__tab mb-2">
                            <div class="list-group d-flex flex-row" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="top-day-list"
                                    data-bs-toggle="list"
                                    href="https://suustore.com/truyen/nang-khong-muon-lam-hoang-hau#top-day"
                                    role="tab" aria-controls="top-day" aria-selected="true">Ngày</a>
                                <a class="list-group-item list-group-item-action" id="top-month-list"
                                    data-bs-toggle="list"
                                    href="https://suustore.com/truyen/nang-khong-muon-lam-hoang-hau#top-month"
                                    role="tab" aria-controls="top-month" aria-selected="false"
                                    tabindex="-1">Tháng</a>
                                <a class="list-group-item list-group-item-action" id="top-all-time-list"
                                    data-bs-toggle="list"
                                    href="https://suustore.com/truyen/nang-khong-muon-lam-hoang-hau#top-all-time"
                                    role="tab" aria-controls="top-all-time" aria-selected="false" tabindex="-1">All
                                    time</a>
                            </div>
                        </div>
                        <div class="col-12 top-ratings__content">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="top-day" role="tabpanel"
                                    aria-labelledby="top-day-list">
                                    <ul>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-danger rounded-circle">
                                                    <span class="text-light">1</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/linh-vu-thien-ha"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Linh
                                                        Vũ Thiên Hạ</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/di-gioi"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Dị
                                                            Giới
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Huyền
                                                            Huyễn
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/xuyen-khong"
                                                            class="text-decoration-none text-dark hover-title ">Xuyên
                                                            Không
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-success rounded-circle">
                                                    <span class="text-light">2</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/than-dao-dan-ton"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Thần
                                                        Đạo Đan Tôn</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-info rounded-circle">
                                                    <span class="text-light">3</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/me-vo-khong-loi-ve"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Mê
                                                        Vợ Không Lối Về</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/ngon-tinh"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Ngôn
                                                            Tình
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/nguoc"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Ngược
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/sung"
                                                            class="text-decoration-none text-dark hover-title ">Sủng
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">4</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/dau-pha-thuong-khung"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Đấu
                                                        Phá Thương Khung</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/di-gioi"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Dị
                                                            Giới
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">5</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/the-gioi-hoan-my"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Thế
                                                        Giới Hoàn Mỹ</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/kiem-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Kiếm
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">6</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/co-vo-ngot-ngao-co-chut-bat-luong-vo-moi-bat-luong-co-chut-ngot"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Cô
                                                        Vợ Ngọt Ngào Có Chút Bất Lương (Vợ Mới Bất Lương Có Chút
                                                        Ngọt)</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/ngon-tinh"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Ngôn
                                                            Tình
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/trong-sinh"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Trọng
                                                            Sinh
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/sung"
                                                            class="text-decoration-none text-dark hover-title ">Sủng
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">7</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/pham-nhan-tu-tien"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Phàm
                                                        Nhân Tu Tiên</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/kiem-hiep"
                                                            class="text-decoration-none text-dark hover-title ">Kiếm
                                                            Hiệp
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">8</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/nhat-niem-vinh-hang"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Nhất
                                                        Niệm Vĩnh Hằng</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">9</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/de-ba"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Đế
                                                        Bá</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">10</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/re-quy-troi-cho"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Rể
                                                        Quý Trời Cho</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/ngon-tinh"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Ngôn
                                                            Tình
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/do-thi"
                                                            class="text-decoration-none text-dark hover-title ">Đô Thị
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane fade" id="top-month" role="tabpanel"
                                    aria-labelledby="top-month-list">
                                    <ul>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-danger rounded-circle">
                                                    <span class="text-light">1</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/linh-vu-thien-ha"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Linh
                                                        Vũ Thiên Hạ</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/di-gioi"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Dị
                                                            Giới
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Huyền
                                                            Huyễn
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/xuyen-khong"
                                                            class="text-decoration-none text-dark hover-title ">Xuyên
                                                            Không
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-success rounded-circle">
                                                    <span class="text-light">2</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/than-dao-dan-ton"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Thần
                                                        Đạo Đan Tôn</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-info rounded-circle">
                                                    <span class="text-light">3</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/me-vo-khong-loi-ve"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Mê
                                                        Vợ Không Lối Về</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/ngon-tinh"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Ngôn
                                                            Tình
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/nguoc"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Ngược
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/sung"
                                                            class="text-decoration-none text-dark hover-title ">Sủng
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">4</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/dau-pha-thuong-khung"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Đấu
                                                        Phá Thương Khung</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/di-gioi"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Dị
                                                            Giới
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">5</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/the-gioi-hoan-my"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Thế
                                                        Giới Hoàn Mỹ</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/kiem-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Kiếm
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">6</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/co-vo-ngot-ngao-co-chut-bat-luong-vo-moi-bat-luong-co-chut-ngot"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Cô
                                                        Vợ Ngọt Ngào Có Chút Bất Lương (Vợ Mới Bất Lương Có Chút
                                                        Ngọt)</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/ngon-tinh"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Ngôn
                                                            Tình
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/trong-sinh"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Trọng
                                                            Sinh
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/sung"
                                                            class="text-decoration-none text-dark hover-title ">Sủng
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">7</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/pham-nhan-tu-tien"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Phàm
                                                        Nhân Tu Tiên</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/kiem-hiep"
                                                            class="text-decoration-none text-dark hover-title ">Kiếm
                                                            Hiệp
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">8</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/nhat-niem-vinh-hang"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Nhất
                                                        Niệm Vĩnh Hằng</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">9</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/de-ba"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Đế
                                                        Bá</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">10</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/re-quy-troi-cho"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Rể
                                                        Quý Trời Cho</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/ngon-tinh"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Ngôn
                                                            Tình
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/do-thi"
                                                            class="text-decoration-none text-dark hover-title ">Đô Thị
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="tab-pane fade" id="top-all-time" role="tabpanel"
                                    aria-labelledby="top-all-time-list">
                                    <ul>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-danger rounded-circle">
                                                    <span class="text-light">1</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/linh-vu-thien-ha"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Linh
                                                        Vũ Thiên Hạ</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/di-gioi"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Dị
                                                            Giới
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Huyền
                                                            Huyễn
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/xuyen-khong"
                                                            class="text-decoration-none text-dark hover-title ">Xuyên
                                                            Không
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-success rounded-circle">
                                                    <span class="text-light">2</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/than-dao-dan-ton"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Thần
                                                        Đạo Đan Tôn</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-info rounded-circle">
                                                    <span class="text-light">3</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/dau-pha-thuong-khung"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Đấu
                                                        Phá Thương Khung</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/di-gioi"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Dị
                                                            Giới
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">4</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/co-vo-ngot-ngao-co-chut-bat-luong-vo-moi-bat-luong-co-chut-ngot"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Cô
                                                        Vợ Ngọt Ngào Có Chút Bất Lương (Vợ Mới Bất Lương Có Chút
                                                        Ngọt)</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/ngon-tinh"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Ngôn
                                                            Tình
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/trong-sinh"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Trọng
                                                            Sinh
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/sung"
                                                            class="text-decoration-none text-dark hover-title ">Sủng
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">5</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/pham-nhan-tu-tien"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Phàm
                                                        Nhân Tu Tiên</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/kiem-hiep"
                                                            class="text-decoration-none text-dark hover-title ">Kiếm
                                                            Hiệp
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">6</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/nhat-niem-vinh-hang"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Nhất
                                                        Niệm Vĩnh Hằng</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">7</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/de-ba"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Đế
                                                        Bá</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">8</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/vu-dong-can-khon"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Vũ
                                                        Động Càn Khôn</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="rating-item d-flex align-items-center">
                                                <div class="rating-item__number bg-light border rounded-circle">
                                                    <span class="text-dark">9</span>
                                                </div>
                                                <div class="rating-item__story">
                                                    <a href="https://suustore.com/truyen/doc-ton-tam-gioi"
                                                        class="text-decoration-none hover-title rating-item__story--name text-one-row">Độc
                                                        Tôn Tam Giới</a>
                                                    <div class="d-flex flex-wrap rating-item__story--categories">
                                                        <a href="https://suustore.com/the-loai/tien-hiep"
                                                            class="text-decoration-none text-dark hover-title  me-1 ">Tiên
                                                            Hiệp
                                                            ,
                                                        </a>
                                                        <a href="https://suustore.com/the-loai/huyen-huyen"
                                                            class="text-decoration-none text-dark hover-title ">Huyền
                                                            Huyễn
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @include('parts.client.table_categories', [])
                </div>
            </div>



        </div>
    </main>
@endsection

@section('scripts')
    <script src="{{asset('frontend/js/story.js')}}"></script>
@endsection
