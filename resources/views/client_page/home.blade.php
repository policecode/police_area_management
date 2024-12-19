@extends('layouts.frontend')
@section('head')
    <meta name="robots" content="all" />
    <meta name="googlebot" content="all">
    <script type="application/ld+json"> 
        {
            "@context": "https://schema.org",
            "@type": "NewsArticle",
            "headline": "{{ $page_title }}",
            "image": [
             ],
            "author": [{
                "@type": "Person",
                "name": "Truyện Full Việt",
                "url": "{{ route('index') }}"
              }]
          }
    </script>
@endsection
@section('content')
 
    <div class="fixed top-0 modal-story-genre right-0 left-0 z-50 flex h-full w-full items-center justify-center overflow-hidden overflow-y-auto overflow-x-hidden bg-white duration-500 md:inset-0 invisible pointer-events-none opacity-0"
        modal-rs="modal_cate">
        <span class="btn-close-genre close-modal items-center justify-center cursor-pointer absolute top-2 right-2 z-[1]"
            modal-rs-close>
            <i class="fa-solid fa-xmark"></i>
        </span>
        <div class="w-full h-full overflow-auto">
            <ul class="flex flex-wrap">
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/am-thuc.html" title="Ẩm Thực" class="block p-2">Ẩm Thực</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/can-dai.html" title="Cận Đại" class="block p-2">Cận Đại</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/canh-ky.html" title="Cạnh Kỹ" class="block p-2">Cạnh Kỹ</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/da-su.html" title="Dã Sử" class="block p-2">Dã Sử</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/di-gioi.html" title="Dị Giới" class="block p-2">Dị Giới</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/di-nang.html" title="Dị Năng" class="block p-2">Dị Năng</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/dao-mo.html" title="Đạo Mộ" class="block p-2">Đạo Mộ</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/do-thi.html" title="Đô Thị" class="block p-2">Đô Thị</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/dong-nhan.html" title="Đồng Nhân" class="block p-2">Đồng Nhân</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/hai-huoc.html" title="Hài Hước" class="block p-2">Hài Hước</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/hao-mon.html" title="Hào Môn" class="block p-2">Hào Môn</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/he-thong.html" title="Hệ Thống" class="block p-2">Hệ Thống</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/hien-dai.html" title="Hiện Đại" class="block p-2">Hiện Đại</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/trinh-tham.html" title="Trinh Thám" class="block p-2">Trinh Thám</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/co-dai.html" title="Cổ Đại" class="block p-2">Cổ Đại</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/dien-van.html" title="Điền Văn" class="block p-2">Điền Văn</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/hau-cung-harem.html" title="Hậu Cung - Harem" class="block p-2">Hậu Cung -
                        Harem</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/hac-am-luu.html" title="Hắc Ám Lưu" class="block p-2">Hắc Ám Lưu</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/hong-hoang.html" title="Hồng Hoang" class="block p-2">Hồng Hoang</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/huyen-ao.html" title="Huyền Ảo" class="block p-2">Huyền Ảo</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/huyen-huyen.html" title="Huyền Huyễn" class="block p-2">Huyền Huyễn</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/huyen-su.html" title="Huyền Sử" class="block p-2">Huyền Sử</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/khoa-huyen.html" title="Khoa Huyễn" class="block p-2">Khoa Huyễn</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/kiem-hiep.html" title="Kiếm Hiệp" class="block p-2">Kiếm Hiệp</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/kinh-di.html" title="Kinh Dị" class="block p-2">Kinh Dị</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/kinh-te.html" title="Kinh Tế" class="block p-2">Kinh Tế</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/ky-huyen.html" title="Kỳ Huyễn" class="block p-2">Kỳ Huyễn</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/lich-su.html" title="Lịch Sử" class="block p-2">Lịch Sử</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/linh-di.html" title="Linh Dị" class="block p-2">Linh Dị</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/ma-phap.html" title="Ma Pháp" class="block p-2">Ma Pháp</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/mat-the.html" title="Mạt Thế" class="block p-2">Mạt Thế</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/ngon-tinh.html" title="Ngôn Tình" class="block p-2">Ngôn Tình</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/nhe-nhang.html" title="Nhẹ Nhàng" class="block p-2">Nhẹ Nhàng</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/nu-hiep.html" title="Nữ Hiệp" class="block p-2">Nữ Hiệp</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/phan-phai.html" title="Phản Phái" class="block p-2">Phản Phái</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/phong-thuy-tam-linh.html" title="Phong Thủy - Tâm Linh" class="block p-2">Phong
                        Thủy - Tâm Linh</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/quan-su.html" title="Quân Sự" class="block p-2">Quân Sự</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/quan-truong.html" title="Quan Trường" class="block p-2">Quan Trường</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/than-hao.html" title="Thần Hào" class="block p-2">Thần Hào</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/thuong-nghiep.html" title="Thương Nghiệp" class="block p-2">Thương Nghiệp</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/tien-hiep.html" title="Tiên Hiệp" class="block p-2">Tiên Hiệp</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/tinh-cam.html" title="Tình Cảm" class="block p-2">Tình Cảm</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/trieu-hoan-ngu-thu.html" title="Triệu Hoán - Ngự Thú" class="block p-2">Triệu
                        Hoán - Ngự Thú</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/trung-sinh.html" title="Trùng Sinh" class="block p-2">Trùng Sinh</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/tu-chan.html" title="Tu Chân" class="block p-2">Tu Chân</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/sang-van.html" title="Sảng Văn" class="block p-2">Sảng Văn</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/phieu-luu.html" title="Phiêu Lưu" class="block p-2">Phiêu Lưu</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/tu-tien-do-thi.html" title="Tu Tiên Đô Thị" class="block p-2">Tu Tiên Đô
                        Thị</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/vo-dich.html" title="Vô Địch" class="block p-2">Vô Địch</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/vo-han-luu.html" title="Vô Hạn Lưu" class="block p-2">Vô Hạn Lưu</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/vo-hiep.html" title="Võ Hiệp" class="block p-2">Võ Hiệp</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/vo-thuat.html" title="Võ Thuật" class="block p-2">Võ Thuật</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/vong-du.html" title="Võng Du" class="block p-2">Võng Du</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/xuyen-khong.html" title="Xuyên Không" class="block p-2">Xuyên Không</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/nu-phu.html" title="Nữ Chủ" class="block p-2">Nữ Chủ</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/truyen-sac.html" title="Truyện Sắc" class="block p-2">Truyện Sắc</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/y-thuat.html" title="Y Thuật" class="block p-2">Y Thuật</a>
                </li>
                <li class="basis-1/2 md:basis-1/4 lg:basis-1/6">
                    <a href="the-loai/vo-si.html" title="Vô Sỉ" class="block p-2">Vô Sỉ</a>
                </li>
            </ul>
        </div>
    </div>
    <section class="pt-3 pb-1 section-intro__index">
        <div class="container">
            <div class="flex flex-wrap -mx-1">
                <div class="hidden px-1 lg:block basis-1/4">
                    <div class="box h-full pt-4 px-4 pb-0 shadow-[1px_1px_9px_rgba(0,0,0,.44)]">
                        <div class="flex flex-wrap -mx-2 tab-shortcut">
                            <div
                                class="basis-1/3 item px-2 mb-1 py-1 hover:shadow-[0_2px_9px_rgba(0,0,0,44)] transition-all duration-300 rounded-2xl">
                                <a href="truyen-yeu-thich.html" title="Yêu thích"
                                    class="link block c-img pt-[188%] rounded-2xl overflow-hidden">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/demo/thumbs/350x0/top-yeuthich-end.png"
                                            srcset="uploads/demo/thumbs/350x0/top-yeuthich-end.png">
                                        <img loading="auto" src="uploads/demo/thumbs/350x0/top-yeuthich-end.png"
                                            data-src="uploads/demo/thumbs/350x0/top-yeuthich-end.png" alt="Yêu thích"
                                            class="img-fluid">
                                    </picture>
                                </a>
                            </div>
                            <div
                                class="basis-1/3 item px-2 mb-1 py-1 hover:shadow-[0_2px_9px_rgba(0,0,0,44)] transition-all duration-300 rounded-2xl">
                                <a href="top-linh-phieu-tuan.html" title="Top Linh Phiếu"
                                    class="link block c-img pt-[188%] rounded-2xl overflow-hidden">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/demo/thumbs/350x0/top-linhphieu-end.png"
                                            srcset="uploads/demo/thumbs/350x0/top-linhphieu-end.png">
                                        <img loading="auto" src="uploads/demo/thumbs/350x0/top-linhphieu-end.png"
                                            data-src="uploads/demo/thumbs/350x0/top-linhphieu-end.png"
                                            alt="Top Linh Phiếu" class="img-fluid">
                                    </picture>
                                </a>
                            </div>
                            <div
                                class="basis-1/3 item px-2 mb-1 py-1 hover:shadow-[0_2px_9px_rgba(0,0,0,44)] transition-all duration-300 rounded-2xl">
                                <a href="tags/doc-quyen.html" title="Độc quyền"
                                    class="link block c-img pt-[188%] rounded-2xl overflow-hidden">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/demo/thumbs/350x0/top-docquyen-end.png"
                                            srcset="uploads/demo/thumbs/350x0/top-docquyen-end.png">
                                        <img loading="auto" src="uploads/demo/thumbs/350x0/top-docquyen-end.png"
                                            data-src="uploads/demo/thumbs/350x0/top-docquyen-end.png" alt="Độc quyền"
                                            class="img-fluid">
                                    </picture>
                                </a>
                            </div>
                            <div
                                class="basis-1/3 item px-2 mb-1 py-1 hover:shadow-[0_2px_9px_rgba(0,0,0,44)] transition-all duration-300 rounded-2xl">
                                <a href="truyen-thinh-hanh-trong-tuan.html" title="Thịnh hành tuần"
                                    class="link block c-img pt-[188%] rounded-2xl overflow-hidden">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/demo/thumbs/350x0/top-thinhhanh-end.png"
                                            srcset="uploads/demo/thumbs/350x0/top-thinhhanh-end.png">
                                        <img loading="auto" src="uploads/demo/thumbs/350x0/top-thinhhanh-end.png"
                                            data-src="uploads/demo/thumbs/350x0/top-thinhhanh-end.png"
                                            alt="Thịnh hành tuần" class="img-fluid">
                                    </picture>
                                </a>
                            </div>
                            <div
                                class="basis-1/3 item px-2 mb-1 py-1 hover:shadow-[0_2px_9px_rgba(0,0,0,44)] transition-all duration-300 rounded-2xl">
                                <a href="truyen-hot.html" title="Truyện hot"
                                    class="link block c-img pt-[188%] rounded-2xl overflow-hidden">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/demo/thumbs/350x0/top-truyenhot-end.png"
                                            srcset="uploads/demo/thumbs/350x0/top-truyenhot-end.png">
                                        <img loading="auto" src="uploads/demo/thumbs/350x0/top-truyenhot-end.png"
                                            data-src="uploads/demo/thumbs/350x0/top-truyenhot-end.png" alt="Truyện hot"
                                            class="img-fluid">
                                    </picture>
                                </a>
                            </div>
                            <div
                                class="basis-1/3 item px-2 mb-1 py-1 hover:shadow-[0_2px_9px_rgba(0,0,0,44)] transition-all duration-300 rounded-2xl">
                                <a href="tags/tac-dai-than.html" title="Tác đại thần"
                                    class="link block c-img pt-[188%] rounded-2xl overflow-hidden">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/demo/thumbs/350x0/top-chatluong-end.png"
                                            srcset="uploads/demo/thumbs/350x0/top-chatluong-end.png">
                                        <img loading="auto" src="uploads/demo/thumbs/350x0/top-chatluong-end.png"
                                            data-src="uploads/demo/thumbs/350x0/top-chatluong-end.png" alt="Tác đại thần"
                                            class="img-fluid">
                                    </picture>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-1 basis-full w-full lg-w-50 lg:basis-2/4">
                    <div class="swiper-container slide-cate__main">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <a href="truyen/yeu-nu-xin-dung-buoc.html" title="06"
                                    class="link block c-img pt-[50%]">
                                    <picture>
                                        <img loading="auto" src="uploads/cover/yeu-nu-xin-dung-buoc-ngang.jpg"
                                            data-src="uploads/cover/yeu-nu-xin-dung-buoc-ngang.jpg" alt="06"
                                            class="img-fluid">
                                    </picture>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="truyen/hiep-dao-xuyen-duong-trieu.html" title="5"
                                    class="link block c-img pt-[50%]">
                                    <picture>
                                        <img loading="lazy" src="uploads/cover/hiep-dao-xuyen-duong-trieu-ngang.jpg"
                                            data-src="uploads/cover/hiep-dao-xuyen-duong-trieu-ngang.jpg" alt="5"
                                            class="img-fluid">
                                    </picture>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="truyen/the-tu-on-trong-diem.html" title="04"
                                    class="link block c-img pt-[50%]">
                                    <picture>
                                        <img loading="lazy" src="uploads/cover/thai-tu-on-trong-ngang-min.jpg"
                                            data-src="uploads/cover/thai-tu-on-trong-ngang-min.jpg" alt="04"
                                            class="img-fluid">
                                    </picture>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="truyen/y-kieu.html" title="03" class="link block c-img pt-[50%]">
                                    <picture>
                                        <img loading="lazy" src="uploads/cover/ytien-ngang.jpg"
                                            data-src="uploads/cover/ytien-ngang.jpg" alt="03" class="img-fluid">
                                    </picture>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="truyen/da-vo-cuong.html" title="02" class="link block c-img pt-[50%]">
                                    <picture>
                                        <img loading="lazy" src="uploads/cover/da-vo-cuong-ngang.jpg"
                                            data-src="uploads/cover/da-vo-cuong-ngang.jpg" alt="04"
                                            class="img-fluid">
                                    </picture>
                                </a>
                            </div>
                            <div class="swiper-slide">
                                <a href="truyen/huyen-giam-tien-toc.html" title="01"
                                    class="link block c-img pt-[50%]">
                                    <picture>
                                        <img loading="lazy" src="uploads/cover/huyen-giam-tien-toc-ngang.jpg"
                                            data-src="uploads/cover/huyen-giam-tien-toc-ngang.jpg" alt="01"
                                            class="img-fluid">
                                    </picture>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-container slide-cate__thumbs">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide h-auto">
                                <div
                                    class="item text-center cursor-pointer text-white lg:text-[0.875rem] bg-[rgba(0,0,0,.8)] p-2 h-full">
                                    06</div>
                            </div>
                            <div class="swiper-slide h-auto">
                                <div
                                    class="item text-center cursor-pointer text-white lg:text-[0.875rem] bg-[rgba(0,0,0,.8)] p-2 h-full">
                                    5</div>
                            </div>
                            <div class="swiper-slide h-auto">
                                <div
                                    class="item text-center cursor-pointer text-white lg:text-[0.875rem] bg-[rgba(0,0,0,.8)] p-2 h-full">
                                    04</div>
                            </div>
                            <div class="swiper-slide h-auto">
                                <div
                                    class="item text-center cursor-pointer text-white lg:text-[0.875rem] bg-[rgba(0,0,0,.8)] p-2 h-full">
                                    03</div>
                            </div>
                            <div class="swiper-slide h-auto">
                                <div
                                    class="item text-center cursor-pointer text-white lg:text-[0.875rem] bg-[rgba(0,0,0,.8)] p-2 h-full">
                                    02</div>
                            </div>
                            <div class="swiper-slide h-auto">
                                <div
                                    class="item text-center cursor-pointer text-white lg:text-[0.875rem] bg-[rgba(0,0,0,.8)] p-2 h-full">
                                    01</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-1 basis-full lg:basis-1/4">
                    <div
                        class="card-info h-full flex flex-col borer border-solid border-[#ebebeb] shadow-[0_1px_3px_rgba(0,0,0,.2)] rounded-[4px] bg-white overflow-hidden">
                        <p
                            class="head text-center py-2 px-5 text-[#128c7e] font-bold border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                            Thông tin - Tiện ích</p>
                        <div class="content bg-[#f8f9fa] p-4 flex-1">
                            <div class="mb-4 s-content content-card-info">
                                <ul>
                                    <li>
                                        <a href="page/thong-tin-moi.html" title="Thông báo - Hướng dẫn">Thông báo -
                                            Hướng dẫn</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="flex flex-row mb-4 -mx-1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-1 pro-cate mb-4">
        <div class="container">
            <div class="flex items-center justify-between mb-2 head-all bg-white py-3 px-5">
                <h2 class="title font-bold 2xl:text-[1.5rem] text-[1.25rem]">Biên tập viên lựa chọn</h2>
                <a href="bien-tap-vien-lua-chon.html" title="Tất cả" class="readmore text-[#128c7e] text-[0.875rem] ">
                    Tất cả <i class="ml-2 fa-solid fa-right-long"></i>
                </a>
            </div>
            <div class="swiper-container slide-cate">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/phu-luc-ta-ve-deu-bi-cam-dung.html" title="Phù Lục Ta Vẽ Đều Bị Cấm Dùng"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/phu-luc-ta-ve.jpg"
                                        srcset="uploads/cover/thumbs/350x0/phu-luc-ta-ve.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/phu-luc-ta-ve.jpg"
                                        data-src="uploads/cover/thumbs/350x0/phu-luc-ta-ve.jpg"
                                        alt="Phù Lục Ta Vẽ Đều Bị Cấm Dùng" class="img-fluid">
                                </picture> <span class="novel-stripe">
                                    <span class="story-status">FULL</span>
                                </span>
                            </a>
                            <h3>
                                <a href="truyen/phu-luc-ta-ve-deu-bi-cam-dung.html" title="Phù Lục Ta Vẽ Đều Bị Cấm Dùng"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Phù Lục Ta Vẽ Đều Bị Cấm Dùng
                                </a>
                            </h3>
                            <a href="tac-gia/an-tinh-phung-trang.html" title="An Tĩnh Phủng Tràng"
                                class="cate lg:text-[0.875rem]">
                                An Tĩnh Phủng Tràng
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/ai-bao-han-tu-tien.html" title="Ai Bảo Hắn Tu Tiên - 1304"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/ai-bao-han-tu-tien.jpg"
                                        srcset="uploads/cover/thumbs/350x0/ai-bao-han-tu-tien.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/ai-bao-han-tu-tien.jpg"
                                        data-src="uploads/cover/thumbs/350x0/ai-bao-han-tu-tien.jpg" alt=""
                                        class="img-fluid">
                                </picture>
                            </a>
                            <h3>
                                <a href="truyen/ai-bao-han-tu-tien.html" title="Ai Bảo Hắn Tu Tiên - 1304"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Ai Bảo Hắn Tu Tiên - 1304
                                </a>
                            </h3>
                            <a href="tac-gia/toi-bach-dich-o-nha.html" title="Tối Bạch Đích Ô Nha"
                                class="cate lg:text-[0.875rem]">
                                Tối Bạch Đích Ô Nha
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/dai-minh-khoi-lua.html" title="Đại Minh Khói Lửa"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/users/story/thumbs/350x0/dmyhhhh.jpg"
                                        srcset="uploads/users/story/thumbs/350x0/dmyhhhh.jpg">
                                    <img loading="lazy" src="uploads/users/story/thumbs/350x0/dmyhhhh.jpg"
                                        data-src="uploads/users/story/thumbs/350x0/dmyhhhh.jpg" alt="dmyhhhh.jpg"
                                        class="img-fluid">
                                </picture>
                            </a>
                            <h3>
                                <a href="truyen/dai-minh-khoi-lua.html" title="Đại Minh Khói Lửa"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Đại Minh Khói Lửa
                                </a>
                            </h3>
                            <a href="tac-gia/duong-quang-ha-ta-tu.html" title="Dương Quang Hạ Tả Tự"
                                class="cate lg:text-[0.875rem]">
                                Dương Quang Hạ Tả Tự
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/xuyen-thu-toi-ke-thua-tu-hop-vien-nau-an-sieu-ngon.html"
                                title="Xuyên Thư Tôi Kế Thừa Tứ Hợp Viện Nấu Ăn Siêu Ngon"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/xuyen-thu-toi-ke-thua.jpg"
                                        srcset="uploads/cover/thumbs/350x0/xuyen-thu-toi-ke-thua.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/xuyen-thu-toi-ke-thua.jpg"
                                        data-src="uploads/cover/thumbs/350x0/xuyen-thu-toi-ke-thua.jpg" alt=""
                                        class="img-fluid">
                                </picture> <span class="novel-stripe">
                                    <span class="story-status">FULL</span>
                                </span>
                            </a>
                            <h3>
                                <a href="truyen/xuyen-thu-toi-ke-thua-tu-hop-vien-nau-an-sieu-ngon.html"
                                    title="Xuyên Thư Tôi Kế Thừa Tứ Hợp Viện Nấu Ăn Siêu Ngon"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Xuyên Thư Tôi Kế Thừa Tứ Hợp Viện Nấu Ăn Siêu Ngon
                                </a>
                            </h3>
                            <a href="tac-gia/cong-tu-gia.html" title="Công Tử Gia" class="cate lg:text-[0.875rem]">
                                Công Tử Gia
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/vo-thanh-mon.html" title="Võ Thánh Môn"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/vo-thanh-mon.jpg"
                                        srcset="uploads/cover/thumbs/350x0/vo-thanh-mon.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/vo-thanh-mon.jpg"
                                        data-src="uploads/cover/thumbs/350x0/vo-thanh-mon.jpg" alt="Võ Thánh Môn"
                                        class="img-fluid">
                                </picture> <span class="novel-stripe">
                                    <span class="story-status">FULL</span>
                                </span>
                            </a>
                            <h3>
                                <a href="truyen/vo-thanh-mon.html" title="Võ Thánh Môn"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Võ Thánh Môn
                                </a>
                            </h3>
                            <a href="tac-gia/long-nhan.html" title="Long Nhân" class="cate lg:text-[0.875rem]">
                                Long Nhân
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/he-thong-trung-y.html" title="Hệ Thống Trung Y"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/he-thong-trung-y.jpg"
                                        srcset="uploads/cover/thumbs/350x0/he-thong-trung-y.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/he-thong-trung-y.jpg"
                                        data-src="uploads/cover/thumbs/350x0/he-thong-trung-y.jpg" alt="Hệ Thống Trung Y"
                                        class="img-fluid">
                                </picture> <span class="novel-stripe">
                                    <span class="story-status">FULL</span>
                                </span>
                            </a>
                            <h3>
                                <a href="truyen/he-thong-trung-y.html" title="Hệ Thống Trung Y"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Hệ Thống Trung Y
                                </a>
                            </h3>
                            <a href="tac-gia/uc-oc-ngu.html" title="Ức Ốc Ngư" class="cate lg:text-[0.875rem]">
                                Ức Ốc Ngư
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/dao-si-da-truong-kiem.html" title="Đạo Sĩ Dạ Trượng Kiếm"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/dao-si-da-truong-kiem.jpg"
                                        srcset="uploads/cover/thumbs/350x0/dao-si-da-truong-kiem.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/dao-si-da-truong-kiem.jpg"
                                        data-src="uploads/cover/thumbs/350x0/dao-si-da-truong-kiem.jpg" alt=""
                                        class="img-fluid">
                                </picture> <span class="novel-stripe">
                                    <span class="story-status">FULL</span>
                                </span>
                            </a>
                            <h3>
                                <a href="truyen/dao-si-da-truong-kiem.html" title="Đạo Sĩ Dạ Trượng Kiếm"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Đạo Sĩ Dạ Trượng Kiếm
                                </a>
                            </h3>
                            <a href="tac-gia/than-van-chi-tiem.html" title="Thân Vẫn Chỉ Tiêm"
                                class="cate lg:text-[0.875rem]">
                                Thân Vẫn Chỉ Tiêm
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/am-duong-tao-hoa-kinh.html" title="Âm Dương Tạo Hóa Kinh"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/am-duong-tao-hoa-kinh.jpg"
                                        srcset="uploads/cover/thumbs/350x0/am-duong-tao-hoa-kinh.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/am-duong-tao-hoa-kinh.jpg"
                                        data-src="uploads/cover/thumbs/350x0/am-duong-tao-hoa-kinh.jpg"
                                        alt="Âm Dương Tạo Hóa Kinh" class="img-fluid">
                                </picture> <span class="novel-stripe">
                                    <span class="story-status">FULL</span>
                                </span>
                            </a>
                            <h3>
                                <a href="truyen/am-duong-tao-hoa-kinh.html" title="Âm Dương Tạo Hóa Kinh"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Âm Dương Tạo Hóa Kinh
                                </a>
                            </h3>
                            <a href="tac-gia/tan-duong.html" title="Tàn Dương" class="cate lg:text-[0.875rem]">
                                Tàn Dương
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/the-tu-hung-manh-co-nuong-nay-ta-nhat-dinh-phai-cuop.html"
                                title="Thế Tử Hung Mãnh: Cô Nương Này, Ta Nhất Định Phải Cướp"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/users/story/thumbs/350x0/unnamed-1.jpg"
                                        srcset="uploads/users/story/thumbs/350x0/unnamed-1.jpg">
                                    <img loading="lazy" src="uploads/users/story/thumbs/350x0/unnamed-1.jpg"
                                        data-src="uploads/users/story/thumbs/350x0/unnamed-1.jpg" alt="unnamed-1.jpg"
                                        class="img-fluid">
                                </picture>
                            </a>
                            <h3>
                                <a href="truyen/the-tu-hung-manh-co-nuong-nay-ta-nhat-dinh-phai-cuop.html"
                                    title="Thế Tử Hung Mãnh: Cô Nương Này, Ta Nhất Định Phải Cướp"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Thế Tử Hung Mãnh: Cô Nương Này, Ta Nhất Định Phải Cướp
                                </a>
                            </h3>
                            <a href="tac-gia/nguyet-ha-qua-tu-tuu.html" title="Nguyệt Hạ Quả Tử Tửu"
                                class="cate lg:text-[0.875rem]">
                                Nguyệt Hạ Quả Tử Tửu
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/cai-nguyen-rua-nay-that-qua-tuyet-voi.html"
                                title="Cái Nguyền Rủa Này Thật Quá Tuyệt Vời - 1039"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/cai-nguyen-rua-nay.jpg"
                                        srcset="uploads/cover/thumbs/350x0/cai-nguyen-rua-nay.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/cai-nguyen-rua-nay.jpg"
                                        data-src="uploads/cover/thumbs/350x0/cai-nguyen-rua-nay.jpg"
                                        alt="Cái Nguyền Rủa Này Thật Quá Tuyệt Vời" class="img-fluid">
                                </picture>
                            </a>
                            <h3>
                                <a href="truyen/cai-nguyen-rua-nay-that-qua-tuyet-voi.html"
                                    title="Cái Nguyền Rủa Này Thật Quá Tuyệt Vời - 1039"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Cái Nguyền Rủa Này Thật Quá Tuyệt Vời - 1039
                                </a>
                            </h3>
                            <a href="tac-gia/hanh-gia-huu-tam.html" title="Hành Giả Hữu Tam"
                                class="cate lg:text-[0.875rem]">
                                Hành Giả Hữu Tam
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/dinh-cap-ngo-tinh-tu-co-so-quyen-phap-bat-dau.html"
                                title="Đỉnh Cấp Ngộ Tính: Từ Cơ Sở Quyền Pháp Bắt Đầu"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/bat-dau-ngo-tinh-tu-co-so.jpg"
                                        srcset="uploads/cover/thumbs/350x0/bat-dau-ngo-tinh-tu-co-so.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/bat-dau-ngo-tinh-tu-co-so.jpg"
                                        data-src="uploads/cover/thumbs/350x0/bat-dau-ngo-tinh-tu-co-so.jpg" alt=""
                                        class="img-fluid">
                                </picture> <span class="novel-stripe">
                                    <span class="story-status">FULL</span>
                                </span>
                            </a>
                            <h3>
                                <a href="truyen/dinh-cap-ngo-tinh-tu-co-so-quyen-phap-bat-dau.html"
                                    title="Đỉnh Cấp Ngộ Tính: Từ Cơ Sở Quyền Pháp Bắt Đầu"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Đỉnh Cấp Ngộ Tính: Từ Cơ Sở Quyền Pháp Bắt Đầu
                                </a>
                            </h3>
                            <a href="tac-gia/nguyet-trung-am.html" title="Nguyệt Trung Âm"
                                class="cate lg:text-[0.875rem]">
                                Nguyệt Trung Âm
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/nhan-toc-tran-thu-su.html" title="Nhân Tộc Trấn Thủ Sứ - 3673"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/nhan-toc-tran-thu-su.jpg"
                                        srcset="uploads/cover/thumbs/350x0/nhan-toc-tran-thu-su.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/nhan-toc-tran-thu-su.jpg"
                                        data-src="uploads/cover/thumbs/350x0/nhan-toc-tran-thu-su.jpg"
                                        alt="Nhân Tộc Trấn Thủ Sứ" class="img-fluid">
                                </picture>
                            </a>
                            <h3>
                                <a href="truyen/nhan-toc-tran-thu-su.html" title="Nhân Tộc Trấn Thủ Sứ - 3673"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Nhân Tộc Trấn Thủ Sứ - 3673
                                </a>
                            </h3>
                            <a href="tac-gia/bach-cau-dich-the.html" title="Bạch Câu Dịch Thệ"
                                class="cate lg:text-[0.875rem]">
                                Bạch Câu Dịch Thệ
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    class="swiper-button swiper-prev cate-prev flex items-center justify-center absolute top-[40%] left-0 -translate-y-1/2 z-[1] cursor-pointer w-10 h-10 rounded-full bg-[#f0f8ff] text-[#128c7e] text-[1.3rem]">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
                <div
                    class="swiper-button swiper-next cate-next flex items-center justify-center absolute top-[40%] right-0 -translate-y-1/2 z-[1] cursor-pointer w-10 h-10 rounded-full bg-[#f0f8ff] text-[#128c7e] text-[1.3rem]">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
        </div>
    </section>
    <section class="py-1 top-story">
        <div class="container">
            <div class="flex flex-wrap -mx-2">
                <div class="px-2 basis-full xl:basis-1/4 order-last xl:order-first">
                    <div class="sidebar-story mb-5">
                        <div
                            class="box-story__sidebar bg-[#f8f9fa] shadow-[0_0_1px_rgba(0,0,0,.13)] mb-6 last:mb-0 rounded-md overflow-hidden border border-solid border-[rgba(0,0,0,.125)]">
                            <div
                                class="head flex items-center justify-between p-3 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                                <p class="text-[0.938rem] font-bold mr-2">Truyện mới nhất</p>
                                <a href="truyen-moi-nhat.html" title="Danh sách đầy đủ"
                                    class="view-more text-[1.3] text-[#128c7e]">
                                    <i class="fa-solid fa-right-long"></i>
                                </a>
                            </div>
                            <ul class="list-story__item">
                                <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                    <div class="flex items-center justify-between">
                                        <a href="truyen/phu-luc-ta-ve-deu-bi-cam-dung.html"
                                            class="w-[75%] line-clamp-1 text-[0.875rem]"
                                            title="Phù Lục Ta Vẽ Đều Bị Cấm Dùng">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Phù Lục Ta Vẽ
                                            Đều Bị Cấm Dùng
                                        </a>
                                        <a href="tac-gia/an-tinh-phung-trang.html" title="An Tĩnh Phủng Tràng"
                                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">An Tĩnh
                                            Phủng Tràng</a>
                                    </div>
                                </li>
                                <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                    <div class="flex items-center justify-between">
                                        <a href="truyen/ai-bao-han-tu-tien.html"
                                            class="w-[75%] line-clamp-1 text-[0.875rem]"
                                            title="Ai Bảo Hắn Tu Tiên - 1304">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Ai Bảo Hắn Tu
                                            Tiên - 1304
                                        </a>
                                        <a href="tac-gia/toi-bach-dich-o-nha.html" title="Tối Bạch Đích Ô Nha"
                                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">Tối Bạch
                                            Đích Ô Nha</a>
                                    </div>
                                </li>
                                <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                    <div class="flex items-center justify-between">
                                        <a href="truyen/dai-minh-khoi-lua.html"
                                            class="w-[75%] line-clamp-1 text-[0.875rem]" title="Đại Minh Khói Lửa">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Đại Minh Khói
                                            Lửa
                                        </a>
                                        <a href="tac-gia/duong-quang-ha-ta-tu.html" title="Dương Quang Hạ Tả Tự"
                                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">Dương
                                            Quang Hạ Tả Tự</a>
                                    </div>
                                </li>
                                <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                    <div class="flex items-center justify-between">
                                        <a href="truyen/xuyen-thu-toi-ke-thua-tu-hop-vien-nau-an-sieu-ngon.html"
                                            class="w-[75%] line-clamp-1 text-[0.875rem]"
                                            title="Xuyên Thư Tôi Kế Thừa Tứ Hợp Viện Nấu Ăn Siêu Ngon">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Xuyên Thư Tôi Kế
                                            Thừa Tứ Hợp Viện Nấu Ăn Siêu Ngon
                                        </a>
                                        <a href="tac-gia/cong-tu-gia.html" title="Công Tử Gia"
                                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">Công Tử
                                            Gia</a>
                                    </div>
                                </li>
                                <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                    <div class="flex items-center justify-between">
                                        <a href="truyen/vo-thanh-mon.html" class="w-[75%] line-clamp-1 text-[0.875rem]"
                                            title="Võ Thánh Môn">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Võ Thánh Môn
                                        </a>
                                        <a href="tac-gia/long-nhan.html" title="Long Nhân"
                                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">Long
                                            Nhân</a>
                                    </div>
                                </li>
                                <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                    <div class="flex items-center justify-between">
                                        <a href="truyen/he-thong-trung-y.html"
                                            class="w-[75%] line-clamp-1 text-[0.875rem]" title="Hệ Thống Trung Y">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Hệ Thống Trung Y
                                        </a>
                                        <a href="tac-gia/uc-oc-ngu.html" title="Ức Ốc Ngư"
                                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">Ức Ốc
                                            Ngư</a>
                                    </div>
                                </li>
                                <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                    <div class="flex items-center justify-between">
                                        <a href="truyen/dao-si-da-truong-kiem.html"
                                            class="w-[75%] line-clamp-1 text-[0.875rem]" title="Đạo Sĩ Dạ Trượng Kiếm">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Đạo Sĩ Dạ Trượng
                                            Kiếm
                                        </a>
                                        <a href="tac-gia/than-van-chi-tiem.html" title="Thân Vẫn Chỉ Tiêm"
                                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">Thân Vẫn
                                            Chỉ Tiêm</a>
                                    </div>
                                </li>
                                <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                    <div class="flex items-center justify-between">
                                        <a href="truyen/am-duong-tao-hoa-kinh.html"
                                            class="w-[75%] line-clamp-1 text-[0.875rem]" title="Âm Dương Tạo Hóa Kinh">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Âm Dương Tạo Hóa
                                            Kinh
                                        </a>
                                        <a href="tac-gia/tan-duong.html" title="Tàn Dương"
                                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">Tàn
                                            Dương</a>
                                    </div>
                                </li>
                                <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                    <div class="flex items-center justify-between">
                                        <a href="truyen/the-tu-hung-manh-co-nuong-nay-ta-nhat-dinh-phai-cuop.html"
                                            class="w-[75%] line-clamp-1 text-[0.875rem]"
                                            title="Thế Tử Hung Mãnh: Cô Nương Này, Ta Nhất Định Phải Cướp">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Thế Tử Hung
                                            Mãnh: Cô Nương Này, Ta Nhất Định Phải Cướp
                                        </a>
                                        <a href="tac-gia/nguyet-ha-qua-tu-tuu.html" title="Nguyệt Hạ Quả Tử Tửu"
                                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">Nguyệt
                                            Hạ Quả Tử Tửu</a>
                                    </div>
                                </li>
                                <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                    <div class="flex items-center justify-between">
                                        <a href="truyen/cai-nguyen-rua-nay-that-qua-tuyet-voi.html"
                                            class="w-[75%] line-clamp-1 text-[0.875rem]"
                                            title="Cái Nguyền Rủa Này Thật Quá Tuyệt Vời - 1039">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Cái Nguyền Rủa
                                            Này Thật Quá Tuyệt Vời - 1039
                                        </a>
                                        <a href="tac-gia/hanh-gia-huu-tam.html" title="Hành Giả Hữu Tam"
                                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">Hành
                                            Giả Hữu Tam</a>
                                    </div>
                                </li>
                                <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                    <div class="flex items-center justify-between">
                                        <a href="truyen/dinh-cap-ngo-tinh-tu-co-so-quyen-phap-bat-dau.html"
                                            class="w-[75%] line-clamp-1 text-[0.875rem]"
                                            title="Đỉnh Cấp Ngộ Tính: Từ Cơ Sở Quyền Pháp Bắt Đầu">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Đỉnh Cấp Ngộ
                                            Tính: Từ Cơ Sở Quyền Pháp Bắt Đầu
                                        </a>
                                        <a href="tac-gia/nguyet-trung-am.html" title="Nguyệt Trung Âm"
                                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">Nguyệt
                                            Trung Âm</a>
                                    </div>
                                </li>
                                <li class="text-[0.875rem] py-[6px] px-4 border-b-[1px] border-solid border-[#f4f4f4]">
                                    <div class="flex items-center justify-between">
                                        <a href="truyen/nhan-toc-tran-thu-su.html"
                                            class="w-[75%] line-clamp-1 text-[0.875rem]"
                                            title="Nhân Tộc Trấn Thủ Sứ - 3673">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Nhân Tộc Trấn
                                            Thủ Sứ - 3673
                                        </a>
                                        <a href="tac-gia/bach-cau-dich-the.html" title="Bạch Câu Dịch Thệ"
                                            class="author text-[0.625rem] w-[21%] line-clamp-1 text-[#999999]">Bạch
                                            Câu Dịch Thệ</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-story mb-5">
                        <div
                            class="box-story__sidebar bg-[#f8f9fa] shadow-[0_0_1px_rgba(0,0,0,.13)] mb-6 last:mb-0 rounded-md overflow-hidden border border-solid border-[rgba(0,0,0,.125)]">
                            <div
                                class="head flex items-center justify-between p-3 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                                <p class="text-[0.938rem] font-bold mr-2">Chương mới cập nhật</p>
                                <a href="chuong-moi-cap-nhat.html" title="Danh sách đầy đủ"
                                    class="view-more text-[1.3] text-[#128c7e]">
                                    <i class="fa-solid fa-right-long"></i>
                                </a>
                            </div>
                            <ul class="list-story__item">
                                <li
                                    class="text-[0.875rem] py-3 px-4 border-b-[1px] border-solid border-[#f4f4f4] flex items-center justify-between">
                                    <div class="w-[75%]">
                                        <a href="truyen/tu-o-re-den-sung-than-nu-de.html"
                                            class=" line-clamp-1 text-[0.875rem]"
                                            title="Từ ở rể đến sủng thần nữ đế">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Từ ở rể
                                            đến sủng thần nữ đế
                                        </a>
                                        <a href="truyen/tu-o-re-den-sung-than-nu-de/chuong-675.html"
                                            class=" line-clamp-1 text-[0.75rem] text-[#999] mt-[2px]"
                                            title="Chương 679: Vẫn là Niềm Tin">Chương 679: Vẫn là Niềm Tin</a>
                                    </div>
                                    <a href="tac-gia/tuan-tu-thieu-nien.html" title="Tuấn Tú Thiếu Niên"
                                        class="author text-[0.625rem] w-[21%] line-clamp-1">Tuấn Tú Thiếu Niên</a>
                                </li>
                                <li
                                    class="text-[0.875rem] py-3 px-4 border-b-[1px] border-solid border-[#f4f4f4] flex items-center justify-between">
                                    <div class="w-[75%]">
                                        <a href="truyen/the-tu-hung-manh-co-nuong-nay-ta-nhat-dinh-phai-cuop.html"
                                            class=" line-clamp-1 text-[0.875rem]"
                                            title="Thế Tử Hung Mãnh: Cô Nương Này, Ta Nhất Định Phải Cướp">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Thế Tử Hung
                                            Mãnh: Cô Nương Này, Ta Nhất Định Phải Cướp
                                        </a>
                                        <a href="truyen/the-tu-hung-manh-co-nuong-nay-ta-nhat-dinh-phai-cuop/chuong-780.html"
                                            class=" line-clamp-1 text-[0.75rem] text-[#999] mt-[2px]"
                                            title="Chương 780: Lưu Ngang">Chương 780: Lưu Ngang</a>
                                    </div>
                                    <a href="tac-gia/nguyet-ha-qua-tu-tuu.html" title="Nguyệt Hạ Quả Tử Tửu"
                                        class="author text-[0.625rem] w-[21%] line-clamp-1">Nguyệt Hạ Quả Tử Tửu</a>
                                </li>
                                <li
                                    class="text-[0.875rem] py-3 px-4 border-b-[1px] border-solid border-[#f4f4f4] flex items-center justify-between">
                                    <div class="w-[75%]">
                                        <a href="truyen/dai-minh-khoi-lua.html" class=" line-clamp-1 text-[0.875rem]"
                                            title="Đại Minh Khói Lửa">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Đại Minh Khói
                                            Lửa
                                        </a>
                                        <a href="truyen/dai-minh-khoi-lua/chuong-150.html"
                                            class=" line-clamp-1 text-[0.75rem] text-[#999] mt-[2px]"
                                            title="Chương 150: Tấu Chương">Chương 150: Tấu Chương</a>
                                    </div>
                                    <a href="tac-gia/duong-quang-ha-ta-tu.html" title="Dương Quang Hạ Tả Tự"
                                        class="author text-[0.625rem] w-[21%] line-clamp-1">Dương Quang Hạ Tả Tự</a>
                                </li>
                                <li
                                    class="text-[0.875rem] py-3 px-4 border-b-[1px] border-solid border-[#f4f4f4] flex items-center justify-between">
                                    <div class="w-[75%]">
                                        <a href="truyen/the-tu-on-trong-diem.html" class=" line-clamp-1 text-[0.875rem]"
                                            title="Thế Tử Ổn Trọng Điểm">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Thế Tử Ổn
                                            Trọng Điểm
                                        </a>
                                        <a href="truyen/the-tu-on-trong-diem/chuong-380.html"
                                            class=" line-clamp-1 text-[0.75rem] text-[#999] mt-[2px]"
                                            title="Chương 380: Trừ Gian Túc Địch">Chương 380: Trừ Gian Túc Địch</a>
                                    </div>
                                    <a href="tac-gia/tac-mi-thu-nhan.html" title="Tặc Mi Thử Nhãn"
                                        class="author text-[0.625rem] w-[21%] line-clamp-1">Tặc Mi Thử Nhãn</a>
                                </li>
                                <li
                                    class="text-[0.875rem] py-3 px-4 border-b-[1px] border-solid border-[#f4f4f4] flex items-center justify-between">
                                    <div class="w-[75%]">
                                        <a href="truyen/tenseigan-trong-the-gioi-naruto.html"
                                            class=" line-clamp-1 text-[0.875rem]"
                                            title="Tenseigan Trong Thế Giới Naruto">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Tenseigan
                                            Trong Thế Giới Naruto
                                        </a>
                                        <a href="truyen/tenseigan-trong-the-gioi-naruto/chuong-930.html"
                                            class=" line-clamp-1 text-[0.75rem] text-[#999] mt-[2px]"
                                            title="Thăm dò">Thăm dò</a>
                                    </div>
                                    <a href="tac-gia/khong-tuong-chi-long.html" title="Không Tưởng Chi Long"
                                        class="author text-[0.625rem] w-[21%] line-clamp-1">Không Tưởng Chi Long</a>
                                </li>
                                <li
                                    class="text-[0.875rem] py-3 px-4 border-b-[1px] border-solid border-[#f4f4f4] flex items-center justify-between">
                                    <div class="w-[75%]">
                                        <a href="truyen/huyen-giam-tien-toc.html" class=" line-clamp-1 text-[0.875rem]"
                                            title="Huyền Giám Tiên Tộc">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Huyền Giám
                                            Tiên Tộc
                                        </a>
                                        <a href="truyen/huyen-giam-tien-toc/chuong-496.html"
                                            class=" line-clamp-1 text-[0.75rem] text-[#999] mt-[2px]"
                                            title="Chương 454 : Hai loại Linh bảo">Chương 454 : Hai loại Linh bảo</a>
                                    </div>
                                    <a href="tac-gia/quy-nguyet-nhan.html" title="Quý Nguyệt Nhân"
                                        class="author text-[0.625rem] w-[21%] line-clamp-1">Quý Nguyệt Nhân</a>
                                </li>
                                <li
                                    class="text-[0.875rem] py-3 px-4 border-b-[1px] border-solid border-[#f4f4f4] flex items-center justify-between">
                                    <div class="w-[75%]">
                                        <a href="truyen/phu-luc-ta-ve-deu-bi-cam-dung.html"
                                            class=" line-clamp-1 text-[0.875rem]" title="Phù Lục Ta Vẽ Đều Bị Cấm Dùng">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Phù Lục Ta Vẽ
                                            Đều Bị Cấm Dùng
                                        </a>
                                        <a href="truyen/phu-luc-ta-ve-deu-bi-cam-dung/chuong-603.html"
                                            class=" line-clamp-1 text-[0.75rem] text-[#999] mt-[2px]"
                                            title="Chương 603: Đại kết cục">Chương 603: Đại kết cục</a>
                                    </div>
                                    <a href="tac-gia/an-tinh-phung-trang.html" title="An Tĩnh Phủng Tràng"
                                        class="author text-[0.625rem] w-[21%] line-clamp-1">An Tĩnh Phủng Tràng</a>
                                </li>
                                <li
                                    class="text-[0.875rem] py-3 px-4 border-b-[1px] border-solid border-[#f4f4f4] flex items-center justify-between">
                                    <div class="w-[75%]">
                                        <a href="truyen/ai-bao-han-tu-tien.html" class=" line-clamp-1 text-[0.875rem]"
                                            title="Ai Bảo Hắn Tu Tiên - 1304">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Ai Bảo Hắn Tu
                                            Tiên - 1304
                                        </a>
                                        <a href="truyen/ai-bao-han-tu-tien/chuong-1304.html"
                                            class=" line-clamp-1 text-[0.75rem] text-[#999] mt-[2px]"
                                            title="Chương 1304: Tự thú (2).">Chương 1304: Tự thú (2).</a>
                                    </div>
                                    <a href="tac-gia/toi-bach-dich-o-nha.html" title="Tối Bạch Đích Ô Nha"
                                        class="author text-[0.625rem] w-[21%] line-clamp-1">Tối Bạch Đích Ô Nha</a>
                                </li>
                                <li
                                    class="text-[0.875rem] py-3 px-4 border-b-[1px] border-solid border-[#f4f4f4] flex items-center justify-between">
                                    <div class="w-[75%]">
                                        <a href="truyen/xuyen-thu-toi-ke-thua-tu-hop-vien-nau-an-sieu-ngon.html"
                                            class=" line-clamp-1 text-[0.875rem]"
                                            title="Xuyên Thư Tôi Kế Thừa Tứ Hợp Viện Nấu Ăn Siêu Ngon">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Xuyên Thư Tôi
                                            Kế Thừa Tứ Hợp Viện Nấu Ăn Siêu Ngon
                                        </a>
                                        <a href="truyen/xuyen-thu-toi-ke-thua-tu-hop-vien-nau-an-sieu-ngon/chuong-249.html"
                                            class=" line-clamp-1 text-[0.75rem] text-[#999] mt-[2px]"
                                            title="Chương 249: Phiên ngoại 2: Song song thời không 4">Chương 249:
                                            Phiên ngoại 2: Song song thời không 4</a>
                                    </div>
                                    <a href="tac-gia/cong-tu-gia.html" title="Công Tử Gia"
                                        class="author text-[0.625rem] w-[21%] line-clamp-1">Công Tử Gia</a>
                                </li>
                                <li
                                    class="text-[0.875rem] py-3 px-4 border-b-[1px] border-solid border-[#f4f4f4] flex items-center justify-between">
                                    <div class="w-[75%]">
                                        <a href="truyen/vo-thanh-mon.html" class=" line-clamp-1 text-[0.875rem]"
                                            title="Võ Thánh Môn">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Võ Thánh Môn
                                        </a>
                                        <a href="truyen/vo-thanh-mon/chuong-127.html"
                                            class=" line-clamp-1 text-[0.75rem] text-[#999] mt-[2px]"
                                            title="Q7-Chương 10.1: Quyền nghiêng Thần Châu.">Q7-Chương 10.1: Quyền
                                            nghiêng Thần Châu.</a>
                                    </div>
                                    <a href="tac-gia/long-nhan.html" title="Long Nhân"
                                        class="author text-[0.625rem] w-[21%] line-clamp-1">Long Nhân</a>
                                </li>
                                <li
                                    class="text-[0.875rem] py-3 px-4 border-b-[1px] border-solid border-[#f4f4f4] flex items-center justify-between">
                                    <div class="w-[75%]">
                                        <a href="truyen/he-thong-trung-y.html" class=" line-clamp-1 text-[0.875rem]"
                                            title="Hệ Thống Trung Y">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Hệ Thống Trung
                                            Y
                                        </a>
                                        <a href="truyen/he-thong-trung-y/chuong-394.html"
                                            class=" line-clamp-1 text-[0.75rem] text-[#999] mt-[2px]"
                                            title="Chương 394: Phiên Ngoại!.">Chương 394: Phiên Ngoại!.</a>
                                    </div>
                                    <a href="tac-gia/uc-oc-ngu.html" title="Ức Ốc Ngư"
                                        class="author text-[0.625rem] w-[21%] line-clamp-1">Ức Ốc Ngư</a>
                                </li>
                                <li
                                    class="text-[0.875rem] py-3 px-4 border-b-[1px] border-solid border-[#f4f4f4] flex items-center justify-between">
                                    <div class="w-[75%]">
                                        <a href="truyen/dao-si-da-truong-kiem.html"
                                            class=" line-clamp-1 text-[0.875rem]" title="Đạo Sĩ Dạ Trượng Kiếm">
                                            <span class="prefix" style="color: #0000ff">[Dịch]</span> Đạo Sĩ Dạ
                                            Trượng Kiếm
                                        </a>
                                        <a href="truyen/dao-si-da-truong-kiem/chuong-1136.html"
                                            class=" line-clamp-1 text-[0.75rem] text-[#999] mt-[2px]"
                                            title="Chương 1136: Thương Thiên đã chết (5) [Hết]">Chương 1136: Thương
                                            Thiên đã chết (5) [Hết]</a>
                                    </div>
                                    <a href="tac-gia/than-van-chi-tiem.html" title="Thân Vẫn Chỉ Tiêm"
                                        class="author text-[0.625rem] w-[21%] line-clamp-1">Thân Vẫn Chỉ Tiêm</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="px-2 basis-full xl:basis-3/4 mb-5">
                    <div class="flex items-center justify-between mb-2 head-all bg-white pr-3">
                        <h2 class="title py-3 px-5 font-bold 2xl:text-[1.5rem] text-[1.25rem]">Top Linh Phiếu (tuần)
                        </h2>
                        <a href="top-linh-phieu-tuan.html" title="Tất cả"
                            class="readmore text-[#128c7e] text-[0.875rem] ">Tất cả <i
                                class="ml-2 fa-solid fa-right-long"></i></a>
                    </div>
                    <div class="flex flex-wrap -mx-1">
                        <div class="px-1 basis-1/2 mb-2">
                            <div
                                class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                                <a href="truyen/gia-phu-han-cao-to.html" title="truyen/gia-phu-han-cao-to"
                                    class="img shrink-0 w-[90px] h-[130px] img-h-full rounded-lg overflow-hidden mr-2 relative">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/cover/thumbs/350x0/gia-phu-han-cao-to.jpg"
                                            srcset="uploads/cover/thumbs/350x0/gia-phu-han-cao-to.jpg">
                                        <img loading="lazy" src="uploads/cover/thumbs/350x0/gia-phu-han-cao-to.jpg"
                                            data-src="uploads/cover/thumbs/350x0/gia-phu-han-cao-to.jpg"
                                            alt="Lịch Sử Hệ Chi Lang" class="img-fluid">
                                    </picture> <span class="novel-stripe">
                                        <span class="story-status">FULL</span>
                                    </span>
                                </a>
                                <div class="flex-1 content">
                                    <h3>
                                        <a href="truyen/gia-phu-han-cao-to.html" title="Gia Phụ Hán Cao Tổ"
                                            class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Gia
                                            Phụ Hán Cao Tổ</a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <a href="tac-gia/lich-su-he-chi-lang.html" title="Lịch Sử Hệ Chi Lang"
                                            class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Lịch
                                            Sử Hệ Chi Lang</a>
                                        <a href="danh-muc/dich.html" title="Dịch"
                                            class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                            style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                    </div>
                                    <div class="story-info lg:text-[0.875rem]">
                                        <span class="text-[#dc3545] mr-1 whitespace-nowrap">1.832.393 Chữ</span>
                                        <span class="text-[#28a745] mr-1 whitespace-nowrap">1227 Chương</span>
                                        <span class="text-[#007bff] mr-1 whitespace-nowrap">13 Đề cử/tuần</span>
                                    </div>
                                    <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">


                                        Gia Phụ Hán Cao Tổ là một bộ truyện của tác giả Lịch Sử Hệ Chi Lang. Truyện kể
                                        về một đứa bé có được tri thức hiện đại, được chuyển về thời cổ đại. Câu chuyện
                                        xoay quanh nhân vật chính và cuộc phiêu lưu của anh ta trong...
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-1 basis-1/2 mb-2">
                            <div
                                class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                                <a href="truyen/van-toc-chi-kiep.html" title="truyen/van-toc-chi-kiep"
                                    class="img shrink-0 w-[90px] h-[130px] img-h-full rounded-lg overflow-hidden mr-2 relative">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/cover/thumbs/350x0/van-toc-chi-kiep.jpg"
                                            srcset="uploads/cover/thumbs/350x0/van-toc-chi-kiep.jpg">
                                        <img loading="lazy" src="uploads/cover/thumbs/350x0/van-toc-chi-kiep.jpg"
                                            data-src="uploads/cover/thumbs/350x0/van-toc-chi-kiep.jpg"
                                            alt="Vạn Tộc Chi Kiếp" class="img-fluid">
                                    </picture> <span class="novel-stripe">
                                        <span class="story-status">FULL</span>
                                    </span>
                                </a>
                                <div class="flex-1 content">
                                    <h3>
                                        <a href="truyen/van-toc-chi-kiep.html" title="Vạn Tộc Chi Kiếp"
                                            class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Vạn
                                            Tộc Chi Kiếp</a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <a href="tac-gia/lao-ung-cat-tieu-ke.html" title="Lão Ưng Cật Tiểu Kê"
                                            class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Lão
                                            Ưng Cật Tiểu Kê</a>
                                        <a href="danh-muc/dich.html" title="Dịch"
                                            class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                            style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                    </div>
                                    <div class="story-info lg:text-[0.875rem]">
                                        <span class="text-[#dc3545] mr-1 whitespace-nowrap">6.383.682 Chữ</span>
                                        <span class="text-[#28a745] mr-1 whitespace-nowrap">4016 Chương</span>
                                        <span class="text-[#007bff] mr-1 whitespace-nowrap">6 Đề cử/tuần</span>
                                    </div>
                                    <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                        Tác phẩm mới toanh của Lão Ưng Cật Tiểu Kê (tác giả của những hit đình đám như
                                        Toàn Cầu Cao Võ, Trọng Sinh Chi Tài Nguyên Cuồn Cuộn) đã chính thức ra mắt và
                                        hiện đang có mặt trong top đầu tất cả các bản xếp hạng của Qidian.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-1 basis-1/2 mb-2">
                            <div
                                class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                                <a href="truyen/co-chan-nhan.html" title="truyen/co-chan-nhan"
                                    class="img shrink-0 w-[90px] h-[130px] img-h-full rounded-lg overflow-hidden mr-2 relative">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/cover/thumbs/350x0/co-chan-nhan.png"
                                            srcset="uploads/cover/thumbs/350x0/co-chan-nhan.png">
                                        <img loading="lazy" src="uploads/cover/thumbs/350x0/co-chan-nhan.png"
                                            data-src="uploads/cover/thumbs/350x0/co-chan-nhan.png" alt="Cổ Chân Nhân"
                                            class="img-fluid">
                                    </picture> <span class="novel-stripe">
                                        <span class="story-status">FULL</span>
                                    </span>
                                </a>
                                <div class="flex-1 content">
                                    <h3>
                                        <a href="truyen/co-chan-nhan.html" title="Cổ Chân Nhân"
                                            class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Cổ
                                            Chân Nhân</a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <a href="tac-gia/co-chan-nhan.html" title="Cổ Chân Nhân"
                                            class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Cổ
                                            Chân Nhân</a>
                                        <a href="danh-muc/dich.html" title="Dịch"
                                            class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                            style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                    </div>
                                    <div class="story-info lg:text-[0.875rem]">
                                        <span class="text-[#dc3545] mr-1 whitespace-nowrap">5.462.989 Chữ</span>
                                        <span class="text-[#28a745] mr-1 whitespace-nowrap">3807 Chương</span>
                                    </div>
                                    <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                        &quot;Con người linh hồn vạn vật, cổ là tinh hoa trời đất
                                        Tam quan bất chính, ma đầu sống lại.
                                        Chuyện xưa về một người xuyên qua không ngừng sống lại.
                                        Một thế giới kì lạ của người nuôi cổ, dùng cổ, luyện cổ.
                                        Xuân Thu Thiền, Nguyệt Quang cổ,...
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-1 basis-1/2 mb-2">
                            <div
                                class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                                <a href="truyen/nga-duc-phong-thien.html" title="truyen/nga-duc-phong-thien"
                                    class="img shrink-0 w-[90px] h-[130px] img-h-full rounded-lg overflow-hidden mr-2 relative">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/cover/thumbs/350x0/nga-duc-phong-thien.jpg"
                                            srcset="uploads/cover/thumbs/350x0/nga-duc-phong-thien.jpg">
                                        <img loading="lazy" src="uploads/cover/thumbs/350x0/nga-duc-phong-thien.jpg"
                                            data-src="uploads/cover/thumbs/350x0/nga-duc-phong-thien.jpg" alt=""
                                            class="img-fluid">
                                    </picture> <span class="novel-stripe">
                                        <span class="story-status">FULL</span>
                                    </span>
                                </a>
                                <div class="flex-1 content">
                                    <h3>
                                        <a href="truyen/nga-duc-phong-thien.html" title="Ngã Dục Phong Thiên"
                                            class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Ngã
                                            Dục Phong Thiên</a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <a href="tac-gia/nhi-can-2.html" title="Nhĩ Căn"
                                            class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Nhĩ
                                            Căn</a>
                                        <a href="danh-muc/dich.html" title="Dịch"
                                            class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                            style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                    </div>
                                    <div class="story-info lg:text-[0.875rem]">
                                        <span class="text-[#dc3545] mr-1 whitespace-nowrap">3.751.615 Chữ</span>
                                        <span class="text-[#28a745] mr-1 whitespace-nowrap">1966 Chương</span>
                                    </div>
                                    <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                        Ngã Dục Phong Thiên là tác phẩm tiểu thuyết thuộc bộ thứ 3 của tác giả Nhĩ Căn
                                        thuộc thể loại tiên hiệp huyền hảo, viết liền mạch ngay sau bộ Tiên Nghịch và
                                        Cầu Ma Truyện kể về thư sinh ham tài Mạnh Hạo, hắn ba năm liền thi...
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-1 basis-1/2 mb-2">
                            <div
                                class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                                <a href="truyen/nhu-y-tieu-lang-quan.html" title="truyen/nhu-y-tieu-lang-quan"
                                    class="img shrink-0 w-[90px] h-[130px] img-h-full rounded-lg overflow-hidden mr-2 relative">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/cover/thumbs/350x0/nhuytieulangquan.jpg"
                                            srcset="uploads/cover/thumbs/350x0/nhuytieulangquan.jpg">
                                        <img loading="lazy" src="uploads/cover/thumbs/350x0/nhuytieulangquan.jpg"
                                            data-src="uploads/cover/thumbs/350x0/nhuytieulangquan.jpg"
                                            alt="Như Ý Tiểu Lang Quân" class="img-fluid">
                                    </picture> <span class="novel-stripe">
                                        <span class="story-status">FULL</span>
                                    </span>
                                </a>
                                <div class="flex-1 content">
                                    <h3>
                                        <a href="truyen/nhu-y-tieu-lang-quan.html" title="Như Ý Tiểu Lang Quân"
                                            class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Như
                                            Ý Tiểu Lang Quân</a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <a href="tac-gia/vinh-tieu-vinh.html" title="Vinh Tiểu Vinh"
                                            class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Vinh
                                            Tiểu Vinh</a>
                                        <a href="danh-muc/dich.html" title="Dịch"
                                            class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                            style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                    </div>
                                    <div class="story-info lg:text-[0.875rem]">
                                        <span class="text-[#dc3545] mr-1 whitespace-nowrap">1.862.897 Chữ</span>
                                        <span class="text-[#28a745] mr-1 whitespace-nowrap">989 Chương</span>
                                    </div>
                                    <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                        Hắn có hai bằng thạc sĩ ở thế kỷ 21, thế nhưng chỉ ngủ một giấc đã xuyên không.
                                        Không có nhẫn không gian, chẳng có hệ thống, ông lão râu bạc trắng cũng không
                                        có luôn, ngay cả ký ức liên quan đến thế giới này đều không có....
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-1 basis-1/2 mb-2">
                            <div
                                class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                                <a href="truyen/toi-cuong-trang-buc-da-kiem-he-thong.html"
                                    title="truyen/toi-cuong-trang-buc-da-kiem-he-thong"
                                    class="img shrink-0 w-[90px] h-[130px] img-h-full rounded-lg overflow-hidden mr-2 relative">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/cover/thumbs/350x0/toi-cuong-trang-buc.jpg"
                                            srcset="uploads/cover/thumbs/350x0/toi-cuong-trang-buc.jpg">
                                        <img loading="lazy" src="uploads/cover/thumbs/350x0/toi-cuong-trang-buc.jpg"
                                            data-src="uploads/cover/thumbs/350x0/toi-cuong-trang-buc.jpg"
                                            alt="Tối Cường Trang Bức Đả Kiểm Hệ Thống" class="img-fluid">
                                    </picture> <span class="novel-stripe">
                                        <span class="story-status">FULL</span>
                                    </span>
                                </a>
                                <div class="flex-1 content">
                                    <h3>
                                        <a href="truyen/toi-cuong-trang-buc-da-kiem-he-thong.html"
                                            title="Tối Cường Trang Bức Đả Kiểm Hệ Thống"
                                            class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Tối
                                            Cường Trang Bức Đả Kiểm Hệ Thống</a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <a href="tac-gia/thai-thuong-bo-y.html" title="Thái Thượng Bố Y"
                                            class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Thái
                                            Thượng Bố Y</a>
                                        <a href="danh-muc/dich.html" title="Dịch"
                                            class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                            style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                    </div>
                                    <div class="story-info lg:text-[0.875rem]">
                                        <span class="text-[#dc3545] mr-1 whitespace-nowrap">3.399.769 Chữ</span>
                                        <span class="text-[#28a745] mr-1 whitespace-nowrap">1897 Chương</span>
                                    </div>
                                    <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                        &quot;Người trẻ tuổi, năm đó ta bắt đầu Trang Bức thời điểm, các ngươi còn chỉ
                                        là một giọt chất lỏng!&quot;
                                        &quot;Tiên tử, theo tại hạ đi một chuyến, bảo đảm mang ngươi Trang Bức mang
                                        ngươi bay, mang ngươi đồng thời khà khà khà!&quot;
                                        Người mặc cuồng đồ áo...
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-1 basis-1/2 mb-2">
                            <div
                                class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                                <a href="truyen/nuong-tu-nha-ta-khong-thich-hop.html"
                                    title="truyen/nuong-tu-nha-ta-khong-thich-hop"
                                    class="img shrink-0 w-[90px] h-[130px] img-h-full rounded-lg overflow-hidden mr-2 relative">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/cover/thumbs/350x0/nuong-tu-nha-ta.jpeg"
                                            srcset="uploads/cover/thumbs/350x0/nuong-tu-nha-ta.jpg">
                                        <img loading="lazy" src="uploads/cover/thumbs/350x0/nuong-tu-nha-ta.jpg"
                                            data-src="uploads/cover/thumbs/350x0/nuong-tu-nha-ta.jpeg"
                                            alt="Nương Tử Nhà Ta, Không Thích Hợp" class="img-fluid">
                                    </picture> <span class="novel-stripe">
                                        <span class="story-status">FULL</span>
                                    </span>
                                </a>
                                <div class="flex-1 content">
                                    <h3>
                                        <a href="truyen/nuong-tu-nha-ta-khong-thich-hop.html"
                                            title="Nương Tử Nhà Ta, Không Thích Hợp"
                                            class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Nương
                                            Tử Nhà Ta, Không Thích Hợp</a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <a href="tac-gia/nhat-thien-tri-ha.html" title="Nhất Thiền Tri Hạ"
                                            class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Nhất
                                            Thiền Tri Hạ</a>
                                        <a href="danh-muc/dich.html" title="Dịch"
                                            class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                            style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                    </div>
                                    <div class="story-info lg:text-[0.875rem]">
                                        <span class="text-[#dc3545] mr-1 whitespace-nowrap">2.927.656 Chữ</span>
                                        <span class="text-[#28a745] mr-1 whitespace-nowrap">3054 Chương</span>
                                    </div>
                                    <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                        Tỉnh lại sau giấc ngủ. Lạc Thanh Chu trở thành con thứ Lạc gia Thành Quốc phủ
                                        của Đại Viêm đế quốc
                                        Vì giúp Lạc gia Nhị công tử từ hôn, Lạc Thanh Chu bị ép ở rể, cưới một tân nương
                                        nghe nói bị si ngốc, không biết nói...
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-1 basis-1/2 mb-2">
                            <div
                                class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                                <a href="truyen/tan-the-tro-choi-ghep-hinh.html"
                                    title="truyen/tan-the-tro-choi-ghep-hinh"
                                    class="img shrink-0 w-[90px] h-[130px] img-h-full rounded-lg overflow-hidden mr-2 relative">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/cover/thumbs/350x0/tan-the-tro-choi-ghep-hinh.jpg"
                                            srcset="uploads/cover/thumbs/350x0/tan-the-tro-choi-ghep-hinh.jpg">
                                        <img loading="lazy"
                                            src="uploads/cover/thumbs/350x0/tan-the-tro-choi-ghep-hinh.jpg"
                                            data-src="uploads/cover/thumbs/350x0/tan-the-tro-choi-ghep-hinh.jpg"
                                            alt="Tận Thế Trò Chơi Ghép Hình" class="img-fluid">
                                    </picture> <span class="novel-stripe">
                                        <span class="story-status">FULL</span>
                                    </span>
                                </a>
                                <div class="flex-1 content">
                                    <h3>
                                        <a href="truyen/tan-the-tro-choi-ghep-hinh.html"
                                            title="Tận Thế Trò Chơi Ghép Hình"
                                            class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Tận
                                            Thế Trò Chơi Ghép Hình</a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <a href="tac-gia/canh-tong-tam.html" title="Canh Tòng Tâm"
                                            class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Canh
                                            Tòng Tâm</a>
                                        <a href="danh-muc/dich.html" title="Dịch"
                                            class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                            style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                    </div>
                                    <div class="story-info lg:text-[0.875rem]">
                                        <span class="text-[#dc3545] mr-1 whitespace-nowrap">2.283.778 Chữ</span>
                                        <span class="text-[#28a745] mr-1 whitespace-nowrap">1937 Chương</span>
                                    </div>
                                    <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                        Pháp tắc sinh tồn tại tận thế: Hãy tránh bi thương, sợ hãi, phẫn nộ. Một khi đã
                                        ở bên ngoài Tháp Tận Thế, bất luận tâm tình tiêu cực gì cũng đều có thể hấp dẫn
                                        quái vật kinh khủng.
                                        ----
                                        Ngủ một giấc tỉnh lại, Bạch Vụ phát...
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-1 basis-1/2 mb-2">
                            <div
                                class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                                <a href="truyen/sieu-cap-thien-phu.html" title="truyen/sieu-cap-thien-phu"
                                    class="img shrink-0 w-[90px] h-[130px] img-h-full rounded-lg overflow-hidden mr-2 relative">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/cover/thumbs/350x0/sieu-cap-thien-phu.png"
                                            srcset="uploads/cover/thumbs/350x0/sieu-cap-thien-phu.png">
                                        <img loading="lazy" src="uploads/cover/thumbs/350x0/sieu-cap-thien-phu.png"
                                            data-src="uploads/cover/thumbs/350x0/sieu-cap-thien-phu.png"
                                            alt="Siêu Cấp Thiên Phú" class="img-fluid">
                                    </picture>
                                </a>
                                <div class="flex-1 content">
                                    <h3>
                                        <a href="truyen/sieu-cap-thien-phu.html" title="Siêu Cấp Thiên Phú"
                                            class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Siêu
                                            Cấp Thiên Phú</a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <a href="tac-gia/kiem-than-bat-kha-chien-bai.html"
                                            title="Kiếm Thần Bất Khả Chiến Bại"
                                            class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Kiếm
                                            Thần Bất Khả Chiến Bại</a>
                                        <a href="danh-muc/dich.html" title="Dịch"
                                            class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                            style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                    </div>
                                    <div class="story-info lg:text-[0.875rem]">
                                        <span class="text-[#dc3545] mr-1 whitespace-nowrap">3.273.465 Chữ</span>
                                        <span class="text-[#28a745] mr-1 whitespace-nowrap">2258 Chương</span>
                                    </div>
                                    <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                        Trong tương lai, có rất nhiều vết nứt không gian xuất hiện trên trái đất, có vô
                                        số hung thú từ bên trong vết nứt không gian tuôn ra, nhân loại đột nhiên rớt
                                        khỏi đỉnh của chuỗi thức ăn, kéo dài hơi tàn ở dưới sự hung tàn của...
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-1 basis-1/2 mb-2">
                            <div
                                class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                                <a href="truyen/dai-chua-te.html" title="truyen/dai-chua-te"
                                    class="img shrink-0 w-[90px] h-[130px] img-h-full rounded-lg overflow-hidden mr-2 relative">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/cover/thumbs/350x0/dai-chua-te.jpg"
                                            srcset="uploads/cover/thumbs/350x0/dai-chua-te.jpg">
                                        <img loading="lazy" src="uploads/cover/thumbs/350x0/dai-chua-te.jpg"
                                            data-src="uploads/cover/thumbs/350x0/dai-chua-te.jpg" alt="Đại Chúa Tể"
                                            class="img-fluid">
                                    </picture>
                                </a>
                                <div class="flex-1 content">
                                    <h3>
                                        <a href="truyen/dai-chua-te.html" title="Đại Chúa Tể"
                                            class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Đại
                                            Chúa Tể</a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <a href="tac-gia/thien-tam-tho-dau.html" title="Thiên Tàm Thổ Đậu"
                                            class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Thiên
                                            Tàm Thổ Đậu</a>
                                        <a href="danh-muc/dich.html" title="Dịch"
                                            class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                            style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                    </div>
                                    <div class="story-info lg:text-[0.875rem]">
                                        <span class="text-[#dc3545] mr-1 whitespace-nowrap">272.411 Chữ</span>
                                        <span class="text-[#28a745] mr-1 whitespace-nowrap">135 Chương</span>
                                    </div>
                                    <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                        Thế giới Đại Thiên, nơi các vị diện giao nhau, vạn tộc hiện lên như nấm, quần
                                        hùng tụ hội, một vị thiên chi chí tôn đến từ hạ vị diện tại vô tận thế giới diễn
                                        lại một truyền kỳ mà mọi người hướng tới, theo đuổi con đường...
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-1 basis-1/2 mb-2">
                            <div
                                class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                                <a href="truyen/tu-minh-tu-thanh-nguoi-duoi-quy.html"
                                    title="truyen/tu-minh-tu-thanh-nguoi-duoi-quy"
                                    class="img shrink-0 w-[90px] h-[130px] img-h-full rounded-lg overflow-hidden mr-2 relative">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/cover/thumbs/350x0/tu-minh-tu-thanh-duoi-quy.jpg"
                                            srcset="uploads/cover/thumbs/350x0/tu-minh-tu-thanh-duoi-quy.jpg">
                                        <img loading="lazy"
                                            src="uploads/cover/thumbs/350x0/tu-minh-tu-thanh-duoi-quy.jpg"
                                            data-src="uploads/cover/thumbs/350x0/tu-minh-tu-thanh-duoi-quy.jpg"
                                            alt="" class="img-fluid">
                                    </picture> <span class="novel-stripe">
                                        <span class="story-status">FULL</span>
                                    </span>
                                </a>
                                <div class="flex-1 content">
                                    <h3>
                                        <a href="truyen/tu-minh-tu-thanh-nguoi-duoi-quy.html"
                                            title="Tự Mình Tu Thành Người Đuổi Quỷ"
                                            class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Tự
                                            Mình Tu Thành Người Đuổi Quỷ</a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <a href="tac-gia/ung-huu-phuc-khi.html" title="Ủng Hữu Phúc Khí"
                                            class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Ủng
                                            Hữu Phúc Khí</a>
                                        <a href="danh-muc/dich.html" title="Dịch"
                                            class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                            style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                    </div>
                                    <div class="story-info lg:text-[0.875rem]">
                                        <span class="text-[#dc3545] mr-1 whitespace-nowrap">1.048.574 Chữ</span>
                                        <span class="text-[#28a745] mr-1 whitespace-nowrap">741 Chương</span>
                                    </div>
                                    <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                        Đỗ Duy là một bác sĩ tâm lý đang sống và làm việc tại New York.
                                        Thật ra anh rất muốn trở về Trung Quốc, sống một cuộc sống thanh thản và ổn
                                        định, chứ không phải sống tại nơi đất khách quê người, lắm lúc sợ hãi về
                                        những...
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-1 basis-1/2 mb-2">
                            <div
                                class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                                <a href="truyen/tinh-mon.html" title="truyen/tinh-mon"
                                    class="img shrink-0 w-[90px] h-[130px] img-h-full rounded-lg overflow-hidden mr-2 relative">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/cover/thumbs/350x0/tinh-mon.jpg"
                                            srcset="uploads/cover/thumbs/350x0/tinh-mon.jpg">
                                        <img loading="lazy" src="uploads/cover/thumbs/350x0/tinh-mon.jpg"
                                            data-src="uploads/cover/thumbs/350x0/tinh-mon.jpg" alt="Tinh Môn"
                                            class="img-fluid">
                                    </picture> <span class="novel-stripe">
                                        <span class="story-status">FULL</span>
                                    </span>
                                </a>
                                <div class="flex-1 content">
                                    <h3>
                                        <a href="truyen/tinh-mon.html" title="Tinh Môn"
                                            class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Tinh
                                            Môn</a>
                                    </h3>
                                    <div class="flex items-center justify-between">
                                        <a href="tac-gia/lao-ung-cat-tieu-ke.html" title="Lão Ưng Cật Tiểu Kê"
                                            class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Lão
                                            Ưng Cật Tiểu Kê</a>
                                        <a href="danh-muc/dich.html" title="Dịch"
                                            class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                            style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                    </div>
                                    <div class="story-info lg:text-[0.875rem]">
                                        <span class="text-[#dc3545] mr-1 whitespace-nowrap">4.927.158 Chữ</span>
                                        <span class="text-[#28a745] mr-1 whitespace-nowrap">3635 Chương</span>
                                    </div>
                                    <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                        Truyền thuyết, trong tinh không sâu thẳm cổ xưa có một cánh cửa màu đỏ sẫm bị
                                        máu và lửa liếm qua.
                                        Truyền kỳ và thần thoại, hắc ám xen kẽ quang minh, vô số truyền thuyết đều đang
                                        chảy xuôi dọc theo cánh cửa cổ xưa ấy.
                                        Quan sát...
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-1 ranking">
        <div class="container">
            <div class="flex flex-wrap -mx-2">
                <div class="basis-full xl:basis-1/3 px-2 mb-4">
                    <div
                        class="box-ranking bg-white rounded overflow-hidden border border-solid border-[rgba(0,0,0,.125)] h-full flex flex-col shadow-[0_0_1px_rgba(0,0,0,.13)]">
                        <div class="head relative p-4 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                            <h2 class="font-bold text-[1.125rem] text-center">Yêu thích trong tháng</h2>
                            <a href="truyen-yeu-thich.html" title="Tất cả"
                                class="readmore text-[#128c7e] text-[0.875rem] absolute top-1/2 right-4 -translate-y-1/2">Tất
                                cả <i class="ml-2 fa-solid fa-right-long"></i></a>
                        </div>
                        <ul class="list-story">
                            <li class="rank-1 flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">1</span>
                                <div class="content flex-1 mr-2">
                                    <h3>
                                        <a href="truyen/trieu-hoi-cuong-trieu-o-mat-the.html"
                                            title="Triệu Hồi Cuồng Triều Ở Mạt Thế"
                                            class="title font-bold text-[#444] text-[0.875rem] line-clamp-1">Triệu Hồi
                                            Cuồng Triều Ở Mạt Thế</a>
                                    </h3>
                                    <i class="fa-solid fa-heart text-[#ef1310] text-[11px]"></i>
                                    <a href="tac-gia/hac-tam-dai-bach.html" title="Hắc Tâm Đại Bạch"
                                        class="block text-[0.75rem] text-[#6c757d] w-fit">Hắc Tâm Đại Bạch</a>
                                </div>
                                <a href="truyen/trieu-hoi-cuong-trieu-o-mat-the.html"
                                    title="Triệu Hồi Cuồng Triều Ở Mạt Thế"
                                    class="book-cover block w-[52px] h-[87px] shrink-0 img-h-full mr-2">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/cover/thumbs/350x0/trieu-hoi-cuong-trieu.jpg"
                                            srcset="uploads/cover/thumbs/350x0/trieu-hoi-cuong-trieu.jpg">
                                        <img loading="lazy" src="uploads/cover/thumbs/350x0/trieu-hoi-cuong-trieu.jpg"
                                            data-src="uploads/cover/thumbs/350x0/trieu-hoi-cuong-trieu.jpg"
                                            alt="Triệu Hồi Cuồng Triều Ở Mạt Thế" class="img-fluid">
                                    </picture>
                                </a>
                            </li>
                            <li class="flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">2</span>
                                <a href="truyen/tinh-mon.html" title="Tinh Môn"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Tinh Môn</a>
                                <i class="fa-solid fa-heart text-[#ef1310] text-[11px]"></i>
                            </li>
                            <li class="flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">3</span>
                                <a href="truyen/nhu-y-tieu-lang-quan.html" title="Như Ý Tiểu Lang Quân"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Như Ý Tiểu Lang
                                    Quân</a>
                                <i class="fa-solid fa-heart text-[#ef1310] text-[11px]"></i>
                            </li>
                            <li class="flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">4</span>
                                <a href="truyen/toan-nang-khi-thieu.html" title="Toàn Năng Khí Thiếu"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Toàn Năng Khí
                                    Thiếu</a>
                                <i class="fa-solid fa-heart text-[#ef1310] text-[11px]"></i>
                            </li>
                            <li class="flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">5</span>
                                <a href="truyen/nuong-tu-nha-ta-khong-thich-hop.html"
                                    title="Nương Tử Nhà Ta, Không Thích Hợp"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Nương Tử Nhà Ta,
                                    Không Thích Hợp</a>
                                <i class="fa-solid fa-heart text-[#ef1310] text-[11px]"></i>
                            </li>
                            <li class="flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">6</span>
                                <a href="truyen/toi-cuong-trang-buc-da-kiem-he-thong.html"
                                    title="Tối Cường Trang Bức Đả Kiểm Hệ Thống"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Tối Cường Trang
                                    Bức Đả Kiểm Hệ Thống</a>
                                <i class="fa-solid fa-heart text-[#ef1310] text-[11px]"></i>
                            </li>
                            <li class="flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">7</span>
                                <a href="truyen/sieu-cap-thien-phu.html" title="Siêu Cấp Thiên Phú"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Siêu Cấp Thiên
                                    Phú</a>
                                <i class="fa-solid fa-heart text-[#ef1310] text-[11px]"></i>
                            </li>
                            <li class="flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">8</span>
                                <a href="truyen/dai-chua-te.html" title="Đại Chúa Tể"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Đại Chúa Tể</a>
                                <i class="fa-solid fa-heart text-[#ef1310] text-[11px]"></i>
                            </li>
                            <li class="flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">9</span>
                                <a href="truyen/tu-minh-tu-thanh-nguoi-duoi-quy.html"
                                    title="Tự Mình Tu Thành Người Đuổi Quỷ"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Tự Mình Tu Thành
                                    Người Đuổi Quỷ</a>
                                <i class="fa-solid fa-heart text-[#ef1310] text-[11px]"></i>
                            </li>
                            <li class="flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">10</span>
                                <a href="truyen/tro-choi-tu-vong-luan-hoi.html" title="Trò Chơi Tử Vong Luân Hồi"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Trò Chơi Tử Vong
                                    Luân Hồi</a>
                                <i class="fa-solid fa-heart text-[#ef1310] text-[11px]"></i>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="basis-full xl:basis-1/3 px-2 mb-4">
                    <div
                        class="box-ranking bg-white rounded overflow-hidden border border-solid border-[rgba(0,0,0,.125)] h-full flex flex-col shadow-[0_0_1px_rgba(0,0,0,.13)]">
                        <div class="head relative p-4 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                            <h2 class="font-bold text-[1.125rem] text-center">Truyện hot</h2>
                            <a href="truyen-hot.html" title="Tất cả"
                                class="readmore text-[#128c7e] text-[0.875rem] absolute top-1/2 right-4 -translate-y-1/2">Tất
                                cả <i class="ml-2 fa-solid fa-right-long"></i></a>
                        </div>
                        <ul class="list-story">
                            <li class="rank-1 flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">1</span>
                                <div class="content flex-1 mr-2">
                                    <h3>
                                        <a href="truyen/van-toc-chi-kiep.html" title="Vạn Tộc Chi Kiếp"
                                            class="title font-bold text-[#444] text-[0.875rem] line-clamp-1">Vạn Tộc
                                            Chi Kiếp</a>
                                    </h3>
                                    <p class="text-[0.75rem] text-[#007bff]">100190 Lượt mở vip</p>
                                    <a href="tac-gia/lao-ung-cat-tieu-ke.html" title="Lão Ưng Cật Tiểu Kê"
                                        class="block text-[0.75rem] text-[#6c757d] w-fit">Lão Ưng Cật Tiểu Kê</a>
                                </div>
                                <a href="truyen/van-toc-chi-kiep.html" title="Vạn Tộc Chi Kiếp"
                                    class="book-cover block w-[52px] h-[87px] shrink-0 img-h-full mr-2">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/cover/thumbs/350x0/van-toc-chi-kiep.jpg"
                                            srcset="uploads/cover/thumbs/350x0/van-toc-chi-kiep.jpg">
                                        <img loading="lazy" src="uploads/cover/thumbs/350x0/van-toc-chi-kiep.jpg"
                                            data-src="uploads/cover/thumbs/350x0/van-toc-chi-kiep.jpg"
                                            alt="Vạn Tộc Chi Kiếp" class="img-fluid">
                                    </picture>
                                </a>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">2</span>
                                <a href="truyen/vinh-hang-thanh-vuong.html" title="Vĩnh Hằng Thánh Vương"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Vĩnh Hằng Thánh
                                    Vương</a>
                                <span class="text-[11px]">66.410</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">3</span>
                                <a href="truyen/van-co-toi-cuong-tong.html" title="Vạn Cổ Tối Cường Tông"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Vạn Cổ Tối Cường
                                    Tông</a>
                                <span class="text-[11px]">65.237</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">4</span>
                                <a href="truyen/co-chan-nhan.html" title="Cổ Chân Nhân"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Cổ Chân Nhân</a>
                                <span class="text-[11px]">62.928</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">5</span>
                                <a href="truyen/tu-chan-lieu-thien-quan.html" title="Tu Chân Liêu Thiên Quần"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Tu Chân Liêu
                                    Thiên Quần</a>
                                <span class="text-[11px]">62.457</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">6</span>
                                <a href="truyen/luoc-thien-ky.html" title="Lược Thiên Ký"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Lược Thiên
                                    Ký</a>
                                <span class="text-[11px]">45.117</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">7</span>
                                <a href="truyen/xich-tam-tuan-thien.html" title="Xích Tâm Tuần Thiên"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Xích Tâm Tuần
                                    Thiên</a>
                                <span class="text-[11px]">43.969</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">8</span>
                                <a href="truyen/tinh-mon.html" title="Tinh Môn"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Tinh Môn</a>
                                <span class="text-[11px]">39.990</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">9</span>
                                <a href="truyen/ta-chi-muon-an-tinh-lam-nguoi-trong-cau-dao.html"
                                    title="Ta Chỉ Muốn An Tĩnh Làm Người Trong Cẩu Đạo"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Ta Chỉ Muốn An
                                    Tĩnh Làm Người Trong Cẩu Đạo</a>
                                <span class="text-[11px]">36.384</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">10</span>
                                <a href="truyen/thi-ra-ta-la-tuyet-the-vo-than.html"
                                    title="Thì Ra Ta Là Tuyệt Thế Võ Thần"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Thì Ra Ta Là
                                    Tuyệt Thế Võ Thần</a>
                                <span class="text-[11px]">32.961</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="basis-full xl:basis-1/3 px-2 mb-4">
                    <div
                        class="box-ranking bg-white rounded overflow-hidden border border-solid border-[rgba(0,0,0,.125)] h-full flex flex-col shadow-[0_0_1px_rgba(0,0,0,.13)]">
                        <div class="head relative p-4 border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                            <h2 class="font-bold text-[1.125rem] text-center">Thịnh hành tuần</h2>
                            <a href="truyen-thinh-hanh-trong-tuan.html" title="Tất cả"
                                class="readmore text-[#128c7e] text-[0.875rem] absolute top-1/2 right-4 -translate-y-1/2">Tất
                                cả <i class="ml-2 fa-solid fa-right-long"></i></a>
                        </div>
                        <ul class="list-story">
                            <li class="rank-1 flex p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">1</span>
                                <div class="content flex-1 mr-2">
                                    <h3>
                                        <a href="truyen/han-huong.html" title="Hán Hương"
                                            class="title font-bold text-[#444] text-[0.875rem] line-clamp-1">Hán
                                            Hương</a>
                                    </h3>
                                    <p class="text-[0.75rem] text-[#007bff]">1299 Lượt mở vip</p>
                                    <a href="tac-gia/kiet-du-2-2.html" title="Kiết Dữ 2"
                                        class="block text-[0.75rem] text-[#6c757d] w-fit">Kiết Dữ 2</a>
                                </div>
                                <a href="truyen/han-huong.html" title="Hán Hương"
                                    class="book-cover block w-[52px] h-[87px] shrink-0 img-h-full mr-2">
                                    <picture>
                                        <source media="(min-width:0px)"
                                            data-srcset="uploads/cover/thumbs/350x0/han-huong.png"
                                            srcset="uploads/cover/thumbs/350x0/han-huong.png">
                                        <img loading="lazy" src="uploads/cover/thumbs/350x0/han-huong.png"
                                            data-src="uploads/cover/thumbs/350x0/han-huong.png" alt="Hán Hương"
                                            class="img-fluid">
                                    </picture>
                                </a>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">2</span>
                                <a href="truyen/am-duong-tao-hoa-kinh.html" title="Âm Dương Tạo Hóa Kinh"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Âm Dương Tạo Hóa
                                    Kinh</a>
                                <span class="text-[11px]">1.017</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">3</span>
                                <a href="truyen/vong-du-song-cung-my-nu.html" title="Võng Du Sống Cùng Mỹ Nữ"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Võng Du Sống
                                    Cùng Mỹ Nữ</a>
                                <span class="text-[11px]">800</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">4</span>
                                <a href="truyen/vo-dich-kiem-vuc.html" title="Vô Địch Kiếm Vực"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Vô Địch Kiếm
                                    Vực</a>
                                <span class="text-[11px]">789</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">5</span>
                                <a href="truyen/dinh-cao-quyen-luc.html" title="Đỉnh Cao Quyền Lực"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Đỉnh Cao Quyền
                                    Lực</a>
                                <span class="text-[11px]">729</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">6</span>
                                <a href="truyen/quan-bang.html" title="Quan Bảng"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Quan Bảng</a>
                                <span class="text-[11px]">720</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">7</span>
                                <a href="truyen/gia-phu-han-cao-to.html" title="Gia Phụ Hán Cao Tổ"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Gia Phụ Hán Cao
                                    Tổ</a>
                                <span class="text-[11px]">690</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">8</span>
                                <a href="truyen/vinh-hang-thanh-vuong.html" title="Vĩnh Hằng Thánh Vương"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Vĩnh Hằng Thánh
                                    Vương</a>
                                <span class="text-[11px]">675</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">9</span>
                                <a href="truyen/van-toc-chi-kiep.html" title="Vạn Tộc Chi Kiếp"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Vạn Tộc Chi
                                    Kiếp</a>
                                <span class="text-[11px]">629</span>
                            </li>
                            <li class="flex items-center p-2 border-b-[1px] border-solid border-[#f4f4f4]">
                                <span
                                    class="number shrink-0 min-w-[20px] h-5 rounded-full inline-flex items-center justify-center bg-[#ededed] text-[#666] text-[11px] mr-2">10</span>
                                <a href="truyen/cuong-gia-hang-lam-o-do-thi.html" title="Cường Giả Hàng Lâm Ở Đô Thị"
                                    class="title text-[0.75rem] text-[#444] flex-1 mr-2 line-clamp-1">Cường Giả Hàng
                                    Lâm Ở Đô Thị</a>
                                <span class="text-[11px]">554</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-1">
        <div class="container">
            <div class="flex items-center justify-between mb-2 head-all bg-white pr-3">
                <h2 class="title py-3 px-5 font-bold 2xl:text-[1.5rem] text-[1.25rem]">Tác Giả Việt</h2>
                <a href="tac-gia-viet.html" title="Tất cả" class="readmore text-[#128c7e] text-[0.875rem]">Tất cả
                    <i class="ml-2 fa-solid fa-right-long"></i></a>
            </div>
            <div
                class="flex flex-nowrap whitespace-nowrap md:whitespace-normal overflow-x-auto md:overflow-x-visible md:flex-wrap -mx-1">
                <div class="basis-[70%] md:basis-1/3 px-1 mb-2">
                    <div
                        class="author-vn h-full flex p-3 bg-white rounded transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)]">
                        <a href="truyen/margin-calls.html" title="Margin Calls"
                            class="img block shrink-0 w-[90px] h-[130px] img-h-full mr-2 rounded-lg overflow-hidden relative">
                            <picture>
                                <img loading="lazy" src="uploads/cover/margin-call.png"
                                    data-src="uploads/cover/margin-call.png" alt="Margin Calls" class="img-fluid">
                            </picture>
                        </a>
                        <div class="content">
                            <h3>
                                <a href="truyen/margin-calls.html" title="Margin Calls"
                                    class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Margin
                                    Calls</a>
                            </h3>
                            <a href="tac-gia/vy-duong.html" title="Vy Dương"
                                class="author text-[#6c757d] lg:text-[0.875rem]">Vy Dương</a>
                            <div class="tag flex flex-wrap mt-2">
                                <a href="the-loai/trinh-tham.html" title="Trinh Thám"
                                    class="tag-item bllock py-1 px-4 text-[0.75rem] text-center mr-2 mb-2 text-ellipsis rounded-xl border border-solid border-[#008000] hover:bg-[#008000] hover:text-white">Trinh
                                    Thám</a>
                                <a href="the-loai/thuong-nghiep.html" title="Thương Nghiệp"
                                    class="tag-item bllock py-1 px-4 text-[0.75rem] text-center mr-2 mb-2 text-ellipsis rounded-xl border border-solid border-[#008000] hover:bg-[#008000] hover:text-white">Thương
                                    Nghiệp</a>
                            </div>
                            <a href="truyen/margin-calls/chuong-52.html" title="Chương 52: Tấm hình cũ"
                                class="chapter-name text-[#128c7e] text-[0.875rem]">Chương 52: Tấm hình cũ</a>
                        </div>
                    </div>
                </div>
                <div class="basis-[70%] md:basis-1/3 px-1 mb-2">
                    <div
                        class="author-vn h-full flex p-3 bg-white rounded transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)]">
                        <a href="truyen/iraq-phong-van.html" title="Iraq Phong Vân"
                            class="img block shrink-0 w-[90px] h-[130px] img-h-full mr-2 rounded-lg overflow-hidden relative">
                            <picture>
                                <img loading="lazy" src="uploads/cover/irac-phong-van.jpg"
                                    data-src="uploads/cover/irac-phong-van.jpg" alt="Iraq Phong Vân"
                                    class="img-fluid">
                            </picture>
                        </a>
                        <div class="content">
                            <h3>
                                <a href="truyen/iraq-phong-van.html" title="Iraq Phong Vân"
                                    class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Iraq
                                    Phong Vân</a>
                            </h3>
                            <a href="tac-gia/hung-gau-lua.html" title="Hùng Gấu Lửa"
                                class="author text-[#6c757d] lg:text-[0.875rem]">Hùng Gấu Lửa</a>
                            <div class="tag flex flex-wrap mt-2">
                                <a href="the-loai/trung-sinh.html" title="Trùng Sinh"
                                    class="tag-item bllock py-1 px-4 text-[0.75rem] text-center mr-2 mb-2 text-ellipsis rounded-xl border border-solid border-[#008000] hover:bg-[#008000] hover:text-white">Trùng
                                    Sinh</a>
                                <a href="the-loai/lich-su.html" title="Lịch Sử"
                                    class="tag-item bllock py-1 px-4 text-[0.75rem] text-center mr-2 mb-2 text-ellipsis rounded-xl border border-solid border-[#008000] hover:bg-[#008000] hover:text-white">Lịch
                                    Sử</a>
                            </div>
                            <a href="truyen/iraq-phong-van/chuong-203.html" title="Q3 - Chương 52: Nhà Trắng thoả hiệp"
                                class="chapter-name text-[#128c7e] text-[0.875rem]">Q3 - Chương 52: Nhà Trắng thoả
                                hiệp</a>
                        </div>
                    </div>
                </div>
                <div class="basis-[70%] md:basis-1/3 px-1 mb-2">
                    <div
                        class="author-vn h-full flex p-3 bg-white rounded transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)]">
                        <a href="truyen/tung-co-mot-nguoi-yeu-toi-nhu-sinh-menh.html"
                            title="Từng Có Một Người, Yêu Tôi Như Sinh Mệnh"
                            class="img block shrink-0 w-[90px] h-[130px] img-h-full mr-2 rounded-lg overflow-hidden relative">
                            <picture>
                                <img loading="lazy"
                                    src="uploads/users/story/tung-co-mot-nguoi-yeu-toi-nhu-sinh-menh-tai-ban.jpg"
                                    data-src="uploads/users/story/tung-co-mot-nguoi-yeu-toi-nhu-sinh-menh-tai-ban.jpg"
                                    alt="tung-co-mot-nguoi-yeu-toi-nhu-sinh-menh-tai-ban.jpg" class="img-fluid">
                            </picture>
                            <span class="novel-stripe">
                                <span class="story-status">FULL</span>
                            </span>
                        </a>
                        <div class="content">
                            <h3>
                                <a href="truyen/tung-co-mot-nguoi-yeu-toi-nhu-sinh-menh.html"
                                    title="Từng Có Một Người, Yêu Tôi Như Sinh Mệnh"
                                    class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Từng
                                    Có Một Người, Yêu Tôi Như Sinh Mệnh</a>
                            </h3>
                            <a href="tac-gia/thu-nghi.html" title="Thư Nghi"
                                class="author text-[#6c757d] lg:text-[0.875rem]">Thư Nghi</a>
                            <div class="tag flex flex-wrap mt-2">
                                <a href="the-loai/do-thi.html" title="Đô Thị"
                                    class="tag-item bllock py-1 px-4 text-[0.75rem] text-center mr-2 mb-2 text-ellipsis rounded-xl border border-solid border-[#008000] hover:bg-[#008000] hover:text-white">Đô
                                    Thị</a>
                                <a href="the-loai/hien-dai.html" title="Hiện Đại"
                                    class="tag-item bllock py-1 px-4 text-[0.75rem] text-center mr-2 mb-2 text-ellipsis rounded-xl border border-solid border-[#008000] hover:bg-[#008000] hover:text-white">Hiện
                                    Đại</a>
                            </div>
                            <a href="truyen/tung-co-mot-nguoi-yeu-toi-nhu-sinh-menh/chuong-12.html"
                                title="Chương 12: Ngoại truyện: Nếu tôi thật lòng"
                                class="chapter-name text-[#128c7e] text-[0.875rem]">Chương 12: Ngoại truyện: Nếu tôi
                                thật lòng</a>
                        </div>
                    </div>
                </div>
                <div class="basis-[70%] md:basis-1/3 px-1 mb-2">
                    <div
                        class="author-vn h-full flex p-3 bg-white rounded transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)]">
                        <a href="truyen/nam-thanchuyen-tu-tien.html" title="Nam Thần:Câu chuyện tu tiên"
                            class="img block shrink-0 w-[90px] h-[130px] img-h-full mr-2 rounded-lg overflow-hidden relative">
                            <picture>
                                <img loading="lazy"
                                    src="uploads/users/story/dalle-2024-08-13-225233-an-illustration-of-an-18-year-old-handsome-young-man-dressed-in-a-fusion-of-traditional-eastern-cultivation-tu-tien-and-modern-style-the-left-side.e9"
                                    data-src="uploads/users/story/dalle-2024-08-13-225233-an-illustration-of-an-18-year-old-handsome-young-man-dressed-in-a-fusion-of-traditional-eastern-cultivation-tu-tien-and-modern-style-the-left-side.webp"
                                    alt="dalle-2024-08-13-225233-an-illustration-of-an-18-year-old-handsome-young-man-dressed-in-a-fusion-of-traditional-eastern-cultivation-tu-tien-and-modern-style-the-left-side.webp"
                                    class="img-fluid">
                            </picture>
                        </a>
                        <div class="content">
                            <h3>
                                <a href="truyen/nam-thanchuyen-tu-tien.html" title="Nam Thần:Câu chuyện tu tiên"
                                    class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Nam
                                    Thần:Câu chuyện tu tiên</a>
                            </h3>
                            <a href="tac-gia/hasaki.html" title="Hasaki"
                                class="author text-[#6c757d] lg:text-[0.875rem]">Hasaki</a>
                            <div class="tag flex flex-wrap mt-2">
                                <a href="the-loai/di-gioi.html" title="Dị Giới"
                                    class="tag-item bllock py-1 px-4 text-[0.75rem] text-center mr-2 mb-2 text-ellipsis rounded-xl border border-solid border-[#008000] hover:bg-[#008000] hover:text-white">Dị
                                    Giới</a>
                                <a href="the-loai/he-thong.html" title="Hệ Thống"
                                    class="tag-item bllock py-1 px-4 text-[0.75rem] text-center mr-2 mb-2 text-ellipsis rounded-xl border border-solid border-[#008000] hover:bg-[#008000] hover:text-white">Hệ
                                    Thống</a>
                            </div>
                            <a href="truyen/nam-thanchuyen-tu-tien/chuong-30.html"
                                title="Chương 29: Đối Đầu Với Kẻ Thù Bí Ẩn"
                                class="chapter-name text-[#128c7e] text-[0.875rem]">Chương 29: Đối Đầu Với Kẻ Thù Bí
                                Ẩn</a>
                        </div>
                    </div>
                </div>
                <div class="basis-[70%] md:basis-1/3 px-1 mb-2">
                    <div
                        class="author-vn h-full flex p-3 bg-white rounded transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)]">
                        <a href="truyen/su-troi-day-cua-loai-pan-2024.html" title="KINHCOMIC: PHÙ THUỶ KIẾN TẠO"
                            class="img block shrink-0 w-[90px] h-[130px] img-h-full mr-2 rounded-lg overflow-hidden relative">
                            <picture>
                                <img loading="lazy" src="uploads/users/story/-3.jpg"
                                    data-src="uploads/users/story/-3.jpg" alt="-3.jpg" class="img-fluid">
                            </picture>
                        </a>
                        <div class="content">
                            <h3>
                                <a href="truyen/su-troi-day-cua-loai-pan-2024.html" title="KINHCOMIC: PHÙ THUỶ KIẾN TẠO"
                                    class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">KINHCOMIC:
                                    PHÙ THUỶ KIẾN TẠO</a>
                            </h3>
                            <a href="tac-gia/3t-ent.html" title="3T Ent"
                                class="author text-[#6c757d] lg:text-[0.875rem]">3T Ent</a>
                            <div class="tag flex flex-wrap mt-2">
                                <a href="the-loai/huyen-ao.html" title="Huyền Ảo"
                                    class="tag-item bllock py-1 px-4 text-[0.75rem] text-center mr-2 mb-2 text-ellipsis rounded-xl border border-solid border-[#008000] hover:bg-[#008000] hover:text-white">Huyền
                                    Ảo</a>
                                <a href="the-loai/phieu-luu.html" title="Phiêu Lưu"
                                    class="tag-item bllock py-1 px-4 text-[0.75rem] text-center mr-2 mb-2 text-ellipsis rounded-xl border border-solid border-[#008000] hover:bg-[#008000] hover:text-white">Phiêu
                                    Lưu</a>
                            </div>
                            <a href="truyen/su-troi-day-cua-loai-pan-2024/chuong-5.html"
                                title="S1: SỰ TRỖI DẬY CỦA LOÀI PAN - CHƯƠNG 4"
                                class="chapter-name text-[#128c7e] text-[0.875rem]">S1: SỰ TRỖI DẬY CỦA LOÀI PAN -
                                CHƯƠNG 4</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-1 just-finished">
        <div class="container">
            <div class="module-content bg-[#fefefe] border border-solid border-[#d8d8d8] rounded">
                <div class="flex items-center justify-between head-all p-3 pb-0">
                    <h2 class="title font-bold 2xl:text-[1.5rem] text-[1.25rem] text-[#6c5ce7]">Mới hoàn thành</h2>
                    <a href="truyen-hoan-thanh.html" title="Tất cả"
                        class="readmore text-[#128c7e] text-[0.875rem] ">Tất cả <i
                            class="ml-2 fa-solid fa-right-long"></i></a>
                </div>
                <div class="flex flex-wrap -mx-1 p-2">
                    <div class="basis-full md:basis-1/3 px-1 mb-2">
                        <div
                            class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                            <div class="book w-[100px] shrink-0 mr-2 relative">
                                <div class="book__cover">
                                    <a href="truyen/phu-luc-ta-ve-deu-bi-cam-dung.html"
                                        title="Phù Lục Ta Vẽ Đều Bị Cấm Dùng" class="book-link relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/phu-luc-ta-ve.jpg"
                                                srcset="uploads/cover/thumbs/350x0/phu-luc-ta-ve.jpg">
                                            <img loading="lazy" src="uploads/cover/thumbs/350x0/phu-luc-ta-ve.jpg"
                                                data-src="uploads/cover/thumbs/350x0/phu-luc-ta-ve.jpg"
                                                alt="Phù Lục Ta Vẽ Đều Bị Cấm Dùng" class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <div class="book__side"><span class="book__side__label">banlong.us</span></div>
                                </div>
                            </div>
                            <div class="flex-1 content">
                                <h3>
                                    <a href="truyen/phu-luc-ta-ve-deu-bi-cam-dung.html"
                                        title="Phù Lục Ta Vẽ Đều Bị Cấm Dùng"
                                        class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Phù
                                        Lục Ta Vẽ Đều Bị Cấm Dùng</a>
                                </h3>
                                <div class="flex items-center justify-between">
                                    <a href="tac-gia/an-tinh-phung-trang.html" title="An Tĩnh Phủng Tràng"
                                        class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">An
                                        Tĩnh Phủng Tràng</a>
                                    <a href="danh-muc/dich.html" title="Dịch"
                                        class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                        style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                </div>
                                <div class="story-info lg:text-[0.875rem]">
                                    <span class="text-[#dc3545] mr-1 whitespace-nowrap">584.910 Chữ</span>
                                    <span class="text-[#28a745] mr-1 whitespace-nowrap">603 Chương</span>
                                    <span class="text-[#007bff] mr-1 whitespace-nowrap">206 Đọc</span>
                                </div>
                                <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                    Sau khi Giang Thành xuyên tới thế giới tu tiên lại phát hiện ra hắn không có thiên
                                    phú tu hành, nhưng ở phương diện luyện chế phù lục lại ngoài ý muốn tài hoa hơn
                                    người....
                                    Người mua: &quot;Giang sư huynh, ta cần một chút phù lục phòng thân.&quot;...
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="basis-full md:basis-1/3 px-1 mb-2">
                        <div
                            class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                            <div class="book w-[100px] shrink-0 mr-2 relative">
                                <div class="book__cover">
                                    <a href="truyen/xuyen-thu-toi-ke-thua-tu-hop-vien-nau-an-sieu-ngon.html"
                                        title="Xuyên Thư Tôi Kế Thừa Tứ Hợp Viện Nấu Ăn Siêu Ngon"
                                        class="book-link relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/xuyen-thu-toi-ke-thua.jpg"
                                                srcset="uploads/cover/thumbs/350x0/xuyen-thu-toi-ke-thua.jpg">
                                            <img loading="lazy"
                                                src="uploads/cover/thumbs/350x0/xuyen-thu-toi-ke-thua.jpg"
                                                data-src="uploads/cover/thumbs/350x0/xuyen-thu-toi-ke-thua.jpg"
                                                alt="" class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <div class="book__side"><span class="book__side__label">banlong.us</span></div>
                                </div>
                            </div>
                            <div class="flex-1 content">
                                <h3>
                                    <a href="truyen/xuyen-thu-toi-ke-thua-tu-hop-vien-nau-an-sieu-ngon.html"
                                        title="Xuyên Thư Tôi Kế Thừa Tứ Hợp Viện Nấu Ăn Siêu Ngon"
                                        class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Xuyên
                                        Thư Tôi Kế Thừa Tứ Hợp Viện Nấu Ăn Siêu Ngon</a>
                                </h3>
                                <div class="flex items-center justify-between">
                                    <a href="tac-gia/cong-tu-gia.html" title="Công Tử Gia"
                                        class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Công
                                        Tử Gia</a>
                                    <a href="danh-muc/dich.html" title="Dịch"
                                        class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                        style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                </div>
                                <div class="story-info lg:text-[0.875rem]">
                                    <span class="text-[#dc3545] mr-1 whitespace-nowrap">235.734 Chữ</span>
                                    <span class="text-[#28a745] mr-1 whitespace-nowrap">249 Chương</span>
                                    <span class="text-[#007bff] mr-1 whitespace-nowrap">195 Đọc</span>
                                </div>
                                <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                    Food blogger trứ danh - Thời Nhiễm - kế thừa một tòa tứ hợp viện, kết quả vừa ký văn
                                    bản kế thừa xong đã bị tai nạn giao thông, xuyên luôn vào một cuốn tiểu thuyết.Thời
                                    Nhiễm cầm điện thoại lên nhìn thoáng qua, hay lắm, ngày bị tông...
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="basis-full md:basis-1/3 px-1 mb-2">
                        <div
                            class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                            <div class="book w-[100px] shrink-0 mr-2 relative">
                                <div class="book__cover">
                                    <a href="truyen/vo-thanh-mon.html" title="Võ Thánh Môn"
                                        class="book-link relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/vo-thanh-mon.jpg"
                                                srcset="uploads/cover/thumbs/350x0/vo-thanh-mon.jpg">
                                            <img loading="lazy" src="uploads/cover/thumbs/350x0/vo-thanh-mon.jpg"
                                                data-src="uploads/cover/thumbs/350x0/vo-thanh-mon.jpg"
                                                alt="Võ Thánh Môn" class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <div class="book__side"><span class="book__side__label">banlong.us</span></div>
                                </div>
                            </div>
                            <div class="flex-1 content">
                                <h3>
                                    <a href="truyen/vo-thanh-mon.html" title="Võ Thánh Môn"
                                        class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Võ
                                        Thánh Môn</a>
                                </h3>
                                <div class="flex items-center justify-between">
                                    <a href="tac-gia/long-nhan.html" title="Long Nhân"
                                        class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Long
                                        Nhân</a>
                                    <a href="danh-muc/dich.html" title="Dịch"
                                        class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                        style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                </div>
                                <div class="story-info lg:text-[0.875rem]">
                                    <span class="text-[#dc3545] mr-1 whitespace-nowrap">229.832 Chữ</span>
                                    <span class="text-[#28a745] mr-1 whitespace-nowrap">127 Chương</span>
                                    <span class="text-[#007bff] mr-1 whitespace-nowrap">216 Đọc</span>
                                </div>
                                <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                    Vũ trụ bao la với hằng hà sa số những ngôi sao, phải chăng mỗi ngôi sao sẽ chiếu
                                    sáng số mệnh của mỗi con người?
                                    Thiên định hay nhân định, câu hỏi đó luôn đi theo chúng ta từ khi biết tư duy. Là
                                    tuân theo định đề “Tử...
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="basis-full md:basis-1/3 px-1 mb-2">
                        <div
                            class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                            <div class="book w-[100px] shrink-0 mr-2 relative">
                                <div class="book__cover">
                                    <a href="truyen/he-thong-trung-y.html" title="Hệ Thống Trung Y"
                                        class="book-link relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/he-thong-trung-y.jpg"
                                                srcset="uploads/cover/thumbs/350x0/he-thong-trung-y.jpg">
                                            <img loading="lazy" src="uploads/cover/thumbs/350x0/he-thong-trung-y.jpg"
                                                data-src="uploads/cover/thumbs/350x0/he-thong-trung-y.jpg"
                                                alt="Hệ Thống Trung Y" class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <div class="book__side"><span class="book__side__label">banlong.us</span></div>
                                </div>
                            </div>
                            <div class="flex-1 content">
                                <h3>
                                    <a href="truyen/he-thong-trung-y.html" title="Hệ Thống Trung Y"
                                        class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Hệ
                                        Thống Trung Y</a>
                                </h3>
                                <div class="flex items-center justify-between">
                                    <a href="tac-gia/uc-oc-ngu.html" title="Ức Ốc Ngư"
                                        class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Ức Ốc
                                        Ngư</a>
                                    <a href="danh-muc/dich.html" title="Dịch"
                                        class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                        style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                </div>
                                <div class="story-info lg:text-[0.875rem]">
                                    <span class="text-[#dc3545] mr-1 whitespace-nowrap">502.143 Chữ</span>
                                    <span class="text-[#28a745] mr-1 whitespace-nowrap">394 Chương</span>
                                    <span class="text-[#007bff] mr-1 whitespace-nowrap">983 Đọc</span>
                                </div>
                                <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                    Trần Khánh vốn là một sinh viên vừa tốt nghiệp đại học Trung Y Bắc Kinh, trở về Hán
                                    Y Đường của nhà mình làm việc. Ngay ngày đầu tiên tọa chẩn, hắn đã kích hoạt được hệ
                                    thống đại y. Lúc Trần Khánh mở đại lễ bao tân thủ,...
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="basis-full md:basis-1/3 px-1 mb-2">
                        <div
                            class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                            <div class="book w-[100px] shrink-0 mr-2 relative">
                                <div class="book__cover">
                                    <a href="truyen/dao-si-da-truong-kiem.html" title="Đạo Sĩ Dạ Trượng Kiếm"
                                        class="book-link relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/dao-si-da-truong-kiem.jpg"
                                                srcset="uploads/cover/thumbs/350x0/dao-si-da-truong-kiem.jpg">
                                            <img loading="lazy"
                                                src="uploads/cover/thumbs/350x0/dao-si-da-truong-kiem.jpg"
                                                data-src="uploads/cover/thumbs/350x0/dao-si-da-truong-kiem.jpg"
                                                alt="" class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <div class="book__side"><span class="book__side__label">banlong.us</span></div>
                                </div>
                            </div>
                            <div class="flex-1 content">
                                <h3>
                                    <a href="truyen/dao-si-da-truong-kiem.html" title="Đạo Sĩ Dạ Trượng Kiếm"
                                        class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Đạo
                                        Sĩ Dạ Trượng Kiếm</a>
                                </h3>
                                <div class="flex items-center justify-between">
                                    <a href="tac-gia/than-van-chi-tiem.html" title="Thân Vẫn Chỉ Tiêm"
                                        class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Thân
                                        Vẫn Chỉ Tiêm</a>
                                    <a href="danh-muc/dich.html" title="Dịch"
                                        class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                        style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                </div>
                                <div class="story-info lg:text-[0.875rem]">
                                    <span class="text-[#dc3545] mr-1 whitespace-nowrap">1.148.726 Chữ</span>
                                    <span class="text-[#28a745] mr-1 whitespace-nowrap">1136 Chương</span>
                                    <span class="text-[#007bff] mr-1 whitespace-nowrap">681 Đọc</span>
                                </div>
                                <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                    Viễn phó nhân gian kinh hồng yến,
                                    Nhất đổ hồng trần thịnh thế nhan!
                                    ...
                                    Trượng kiếm độc hành, kiến quỷ thần thế gian!
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="basis-full md:basis-1/3 px-1 mb-2">
                        <div
                            class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                            <div class="book w-[100px] shrink-0 mr-2 relative">
                                <div class="book__cover">
                                    <a href="truyen/am-duong-tao-hoa-kinh.html" title="Âm Dương Tạo Hóa Kinh"
                                        class="book-link relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/am-duong-tao-hoa-kinh.jpg"
                                                srcset="uploads/cover/thumbs/350x0/am-duong-tao-hoa-kinh.jpg">
                                            <img loading="lazy"
                                                src="uploads/cover/thumbs/350x0/am-duong-tao-hoa-kinh.jpg"
                                                data-src="uploads/cover/thumbs/350x0/am-duong-tao-hoa-kinh.jpg"
                                                alt="Âm Dương Tạo Hóa Kinh" class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <div class="book__side"><span class="book__side__label">banlong.us</span></div>
                                </div>
                            </div>
                            <div class="flex-1 content">
                                <h3>
                                    <a href="truyen/am-duong-tao-hoa-kinh.html" title="Âm Dương Tạo Hóa Kinh"
                                        class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Âm
                                        Dương Tạo Hóa Kinh</a>
                                </h3>
                                <div class="flex items-center justify-between">
                                    <a href="tac-gia/tan-duong.html" title="Tàn Dương"
                                        class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Tàn
                                        Dương</a>
                                    <a href="danh-muc/dich.html" title="Dịch"
                                        class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                        style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                </div>
                                <div class="story-info lg:text-[0.875rem]">
                                    <span class="text-[#dc3545] mr-1 whitespace-nowrap">2.245.968 Chữ</span>
                                    <span class="text-[#28a745] mr-1 whitespace-nowrap">1785 Chương</span>
                                    <span class="text-[#007bff] mr-1 whitespace-nowrap">14.611 Đọc</span>
                                </div>
                                <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                    Một bàn cờ bao phủ cả chư thiên vạn giới, phàm nhân cũng vậy, Tiên nhân cũng thế,
                                    tất cả đều giống như một con cờ vùng vẫy cầu sinh, muốn tránh thoát thiên địa ràng
                                    buộc, cầu lấy hai chữ trường sinh hư vô mờ mịt…
                                    Lạc Hồng Tinh,...
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="basis-full md:basis-1/3 px-1 mb-2">
                        <div
                            class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                            <div class="book w-[100px] shrink-0 mr-2 relative">
                                <div class="book__cover">
                                    <a href="truyen/dinh-cap-ngo-tinh-tu-co-so-quyen-phap-bat-dau.html"
                                        title="Đỉnh Cấp Ngộ Tính: Từ Cơ Sở Quyền Pháp Bắt Đầu"
                                        class="book-link relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/bat-dau-ngo-tinh-tu-co-so.jpg"
                                                srcset="uploads/cover/thumbs/350x0/bat-dau-ngo-tinh-tu-co-so.jpg">
                                            <img loading="lazy"
                                                src="uploads/cover/thumbs/350x0/bat-dau-ngo-tinh-tu-co-so.jpg"
                                                data-src="uploads/cover/thumbs/350x0/bat-dau-ngo-tinh-tu-co-so.jpg"
                                                alt="" class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <div class="book__side"><span class="book__side__label">banlong.us</span></div>
                                </div>
                            </div>
                            <div class="flex-1 content">
                                <h3>
                                    <a href="truyen/dinh-cap-ngo-tinh-tu-co-so-quyen-phap-bat-dau.html"
                                        title="Đỉnh Cấp Ngộ Tính: Từ Cơ Sở Quyền Pháp Bắt Đầu"
                                        class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Đỉnh
                                        Cấp Ngộ Tính: Từ Cơ Sở Quyền Pháp Bắt Đầu</a>
                                </h3>
                                <div class="flex items-center justify-between">
                                    <a href="tac-gia/nguyet-trung-am.html" title="Nguyệt Trung Âm"
                                        class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Nguyệt
                                        Trung Âm</a>
                                    <a href="danh-muc/dich.html" title="Dịch"
                                        class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                        style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                </div>
                                <div class="story-info lg:text-[0.875rem]">
                                    <span class="text-[#dc3545] mr-1 whitespace-nowrap">2.589.528 Chữ</span>
                                    <span class="text-[#28a745] mr-1 whitespace-nowrap">2215 Chương</span>
                                    <span class="text-[#007bff] mr-1 whitespace-nowrap">19.722 Đọc</span>
                                </div>
                                <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                    Lục Trường Sinh xuyên thành học đồ của Diệu Thủ Viên, vốn định cố gắng trở thành đại
                                    thần y hành y tế thế nhưng sau khi hắn bắt đầu luyện võ lại phát hiện mỗi khi luyện
                                    một môn võ công tới viên mãn thì có thể gia tăng...
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="basis-full md:basis-1/3 px-1 mb-2">
                        <div
                            class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                            <div class="book w-[100px] shrink-0 mr-2 relative">
                                <div class="book__cover">
                                    <a href="truyen/song-cung-bieu-ty.html" title="Sống Cùng Biểu Tỷ"
                                        class="book-link relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/song-cung-bieu-ty.jpg"
                                                srcset="uploads/cover/thumbs/350x0/song-cung-bieu-ty.jpg">
                                            <img loading="lazy" src="uploads/cover/thumbs/350x0/song-cung-bieu-ty.jpg"
                                                data-src="uploads/cover/thumbs/350x0/song-cung-bieu-ty.jpg"
                                                alt="Sống Cùng Biểu Tỷ" class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <div class="book__side"><span class="book__side__label">banlong.us</span></div>
                                </div>
                            </div>
                            <div class="flex-1 content">
                                <h3>
                                    <a href="truyen/song-cung-bieu-ty.html" title="Sống Cùng Biểu Tỷ"
                                        class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Sống
                                        Cùng Biểu Tỷ</a>
                                </h3>
                                <div class="flex items-center justify-between">
                                    <a href="tac-gia/to-phai.html" title="Tô Phái"
                                        class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Tô
                                        Phái</a>
                                    <a href="danh-muc/dich.html" title="Dịch"
                                        class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                        style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                </div>
                                <div class="story-info lg:text-[0.875rem]">
                                    <span class="text-[#dc3545] mr-1 whitespace-nowrap">2.945.525 Chữ</span>
                                    <span class="text-[#28a745] mr-1 whitespace-nowrap">2141 Chương</span>
                                    <span class="text-[#007bff] mr-1 whitespace-nowrap">5.194 Đọc</span>
                                </div>
                                <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                    Sống Cùng Biểu Tỷ là câu truyện đô thị kể về Tần Thiên vốn là một sinh viên bình
                                    thường, nhưng có một hôm hắn nhận được một hộp bưu phẩm, trong đó có một chiếc nhẫn.
                                    Nhờ chiếc nhẫn đó mà mỗi khi hắn thịt được mỹ nữ thì...
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="basis-full md:basis-1/3 px-1 mb-2">
                        <div
                            class="novel-item h-full p-4 bg-white flex flex-wrap transition-all duration-300 hover:shadow-[2px_2px_9px_rgba(0,0,0,.44)] border-t-[1px] border-dashed border-[#bababa]">
                            <div class="book w-[100px] shrink-0 mr-2 relative">
                                <div class="book__cover">
                                    <a href="truyen/bac-am-dai-thanh.html" title="Bắc Âm Đại Thánh"
                                        class="book-link relative">
                                        <picture>
                                            <source media="(min-width:0px)"
                                                data-srcset="uploads/cover/thumbs/350x0/bac-am-dai-thanh.jpg"
                                                srcset="uploads/cover/thumbs/350x0/bac-am-dai-thanh.jpg">
                                            <img loading="lazy" src="uploads/cover/thumbs/350x0/bac-am-dai-thanh.jpg"
                                                data-src="uploads/cover/thumbs/350x0/bac-am-dai-thanh.jpg"
                                                alt="" class="img-fluid">
                                        </picture> <span class="novel-stripe">
                                            <span class="story-status">FULL</span>
                                        </span>
                                    </a>
                                    <div class="book__side"><span class="book__side__label">banlong.us</span></div>
                                </div>
                            </div>
                            <div class="flex-1 content">
                                <h3>
                                    <a href="truyen/bac-am-dai-thanh.html" title="Bắc Âm Đại Thánh"
                                        class="title font-bold xl:text-[1.125rem] text-[0.875rem] line-clamp-1 mb-2">Bắc
                                        Âm Đại Thánh</a>
                                </h3>
                                <div class="flex items-center justify-between">
                                    <a href="tac-gia/mong-dien-quai-khach.html" title="Mông Diện Quái Khách"
                                        class="author text-[#6c757d] lg:text-[0.875rem] mr-2 mb-1 line-clamp-1">Mông
                                        Diện Quái Khách</a>
                                    <a href="danh-muc/dich.html" title="Dịch"
                                        class="inline-block shrink-0 py-[2px] px-[11px] border border-solid text-[11px] rounded"
                                        style="color: #0000ff;border-color:#0000ff">Dịch</a>
                                </div>
                                <div class="story-info lg:text-[0.875rem]">
                                    <span class="text-[#dc3545] mr-1 whitespace-nowrap">1.744.805 Chữ</span>
                                    <span class="text-[#28a745] mr-1 whitespace-nowrap">1530 Chương</span>
                                    <span class="text-[#007bff] mr-1 whitespace-nowrap">9.488 Đọc</span>
                                </div>
                                <div class="s-content text-[0.75rem] text-[#3a3a3a] mt-2 pl-3 line-clamp-4">
                                    Tận thế hàng lâm, vạn giới trầm luân!
                                    Sau một lần tai nạn khi đi du lịch, Chu Giáp bỗng nhiên bị đẩy đến Cửu U thế giới,
                                    giãy dụa cầu sinh.
                                    - Truyện được viết sau khi hoàn thành bộ Mạc Cầu Tiên Duyên - một siêu phẩm.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-1 pro-cate mb-5">
        <div class="container">
            <div class="flex items-center justify-between mb-2 head-all bg-white pr-3">
                <h2 class="title py-3 px-5 font-bold 2xl:text-[1.5rem] text-[1.25rem]">Truyện mới lựa chọn</h2>
                <a href="truyen-moi-de-cu.html" title="Tất cả" class="readmore text-[#128c7e] text-[0.875rem]">
                    Tất cả <i class="ml-2 fa-solid fa-right-long"></i>
                </a>
            </div>
            <div class="swiper-container slide-cate">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/phu-luc-ta-ve-deu-bi-cam-dung.html" title="Phù Lục Ta Vẽ Đều Bị Cấm Dùng"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/phu-luc-ta-ve.jpg"
                                        srcset="uploads/cover/thumbs/350x0/phu-luc-ta-ve.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/phu-luc-ta-ve.jpg"
                                        data-src="uploads/cover/thumbs/350x0/phu-luc-ta-ve.jpg"
                                        alt="Phù Lục Ta Vẽ Đều Bị Cấm Dùng" class="img-fluid">
                                </picture> <span class="novel-stripe">
                                    <span class="story-status">FULL</span>
                                </span>
                            </a>
                            <h3>
                                <a href="truyen/phu-luc-ta-ve-deu-bi-cam-dung.html"
                                    title="Phù Lục Ta Vẽ Đều Bị Cấm Dùng"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Phù Lục Ta Vẽ Đều Bị Cấm Dùng
                                </a>
                            </h3>
                            <a href="tac-gia/an-tinh-phung-trang.html" title="An Tĩnh Phủng Tràng"
                                class="cate lg:text-[0.875rem]">
                                An Tĩnh Phủng Tràng
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/ai-bao-han-tu-tien.html" title="Ai Bảo Hắn Tu Tiên - 1304"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/ai-bao-han-tu-tien.jpg"
                                        srcset="uploads/cover/thumbs/350x0/ai-bao-han-tu-tien.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/ai-bao-han-tu-tien.jpg"
                                        data-src="uploads/cover/thumbs/350x0/ai-bao-han-tu-tien.jpg" alt=""
                                        class="img-fluid">
                                </picture>
                            </a>
                            <h3>
                                <a href="truyen/ai-bao-han-tu-tien.html" title="Ai Bảo Hắn Tu Tiên - 1304"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Ai Bảo Hắn Tu Tiên - 1304
                                </a>
                            </h3>
                            <a href="tac-gia/toi-bach-dich-o-nha.html" title="Tối Bạch Đích Ô Nha"
                                class="cate lg:text-[0.875rem]">
                                Tối Bạch Đích Ô Nha
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/dai-minh-khoi-lua.html" title="Đại Minh Khói Lửa"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/users/story/thumbs/350x0/dmyhhhh.jpg"
                                        srcset="uploads/users/story/thumbs/350x0/dmyhhhh.jpg">
                                    <img loading="lazy" src="uploads/users/story/thumbs/350x0/dmyhhhh.jpg"
                                        data-src="uploads/users/story/thumbs/350x0/dmyhhhh.jpg" alt="dmyhhhh.jpg"
                                        class="img-fluid">
                                </picture>
                            </a>
                            <h3>
                                <a href="truyen/dai-minh-khoi-lua.html" title="Đại Minh Khói Lửa"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Đại Minh Khói Lửa
                                </a>
                            </h3>
                            <a href="tac-gia/duong-quang-ha-ta-tu.html" title="Dương Quang Hạ Tả Tự"
                                class="cate lg:text-[0.875rem]">
                                Dương Quang Hạ Tả Tự
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/xuyen-thu-toi-ke-thua-tu-hop-vien-nau-an-sieu-ngon.html"
                                title="Xuyên Thư Tôi Kế Thừa Tứ Hợp Viện Nấu Ăn Siêu Ngon"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/xuyen-thu-toi-ke-thua.jpg"
                                        srcset="uploads/cover/thumbs/350x0/xuyen-thu-toi-ke-thua.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/xuyen-thu-toi-ke-thua.jpg"
                                        data-src="uploads/cover/thumbs/350x0/xuyen-thu-toi-ke-thua.jpg" alt=""
                                        class="img-fluid">
                                </picture> <span class="novel-stripe">
                                    <span class="story-status">FULL</span>
                                </span>
                            </a>
                            <h3>
                                <a href="truyen/xuyen-thu-toi-ke-thua-tu-hop-vien-nau-an-sieu-ngon.html"
                                    title="Xuyên Thư Tôi Kế Thừa Tứ Hợp Viện Nấu Ăn Siêu Ngon"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Xuyên Thư Tôi Kế Thừa Tứ Hợp Viện Nấu Ăn Siêu Ngon
                                </a>
                            </h3>
                            <a href="tac-gia/cong-tu-gia.html" title="Công Tử Gia" class="cate lg:text-[0.875rem]">
                                Công Tử Gia
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/vo-thanh-mon.html" title="Võ Thánh Môn"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/vo-thanh-mon.jpg"
                                        srcset="uploads/cover/thumbs/350x0/vo-thanh-mon.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/vo-thanh-mon.jpg"
                                        data-src="uploads/cover/thumbs/350x0/vo-thanh-mon.jpg" alt="Võ Thánh Môn"
                                        class="img-fluid">
                                </picture> <span class="novel-stripe">
                                    <span class="story-status">FULL</span>
                                </span>
                            </a>
                            <h3>
                                <a href="truyen/vo-thanh-mon.html" title="Võ Thánh Môn"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Võ Thánh Môn
                                </a>
                            </h3>
                            <a href="tac-gia/long-nhan.html" title="Long Nhân" class="cate lg:text-[0.875rem]">
                                Long Nhân
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/he-thong-trung-y.html" title="Hệ Thống Trung Y"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/he-thong-trung-y.jpg"
                                        srcset="uploads/cover/thumbs/350x0/he-thong-trung-y.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/he-thong-trung-y.jpg"
                                        data-src="uploads/cover/thumbs/350x0/he-thong-trung-y.jpg"
                                        alt="Hệ Thống Trung Y" class="img-fluid">
                                </picture> <span class="novel-stripe">
                                    <span class="story-status">FULL</span>
                                </span>
                            </a>
                            <h3>
                                <a href="truyen/he-thong-trung-y.html" title="Hệ Thống Trung Y"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Hệ Thống Trung Y
                                </a>
                            </h3>
                            <a href="tac-gia/uc-oc-ngu.html" title="Ức Ốc Ngư" class="cate lg:text-[0.875rem]">
                                Ức Ốc Ngư
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/dao-si-da-truong-kiem.html" title="Đạo Sĩ Dạ Trượng Kiếm"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/dao-si-da-truong-kiem.jpg"
                                        srcset="uploads/cover/thumbs/350x0/dao-si-da-truong-kiem.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/dao-si-da-truong-kiem.jpg"
                                        data-src="uploads/cover/thumbs/350x0/dao-si-da-truong-kiem.jpg" alt=""
                                        class="img-fluid">
                                </picture> <span class="novel-stripe">
                                    <span class="story-status">FULL</span>
                                </span>
                            </a>
                            <h3>
                                <a href="truyen/dao-si-da-truong-kiem.html" title="Đạo Sĩ Dạ Trượng Kiếm"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Đạo Sĩ Dạ Trượng Kiếm
                                </a>
                            </h3>
                            <a href="tac-gia/than-van-chi-tiem.html" title="Thân Vẫn Chỉ Tiêm"
                                class="cate lg:text-[0.875rem]">
                                Thân Vẫn Chỉ Tiêm
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/am-duong-tao-hoa-kinh.html" title="Âm Dương Tạo Hóa Kinh"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/am-duong-tao-hoa-kinh.jpg"
                                        srcset="uploads/cover/thumbs/350x0/am-duong-tao-hoa-kinh.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/am-duong-tao-hoa-kinh.jpg"
                                        data-src="uploads/cover/thumbs/350x0/am-duong-tao-hoa-kinh.jpg"
                                        alt="Âm Dương Tạo Hóa Kinh" class="img-fluid">
                                </picture> <span class="novel-stripe">
                                    <span class="story-status">FULL</span>
                                </span>
                            </a>
                            <h3>
                                <a href="truyen/am-duong-tao-hoa-kinh.html" title="Âm Dương Tạo Hóa Kinh"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Âm Dương Tạo Hóa Kinh
                                </a>
                            </h3>
                            <a href="tac-gia/tan-duong.html" title="Tàn Dương" class="cate lg:text-[0.875rem]">
                                Tàn Dương
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/the-tu-hung-manh-co-nuong-nay-ta-nhat-dinh-phai-cuop.html"
                                title="Thế Tử Hung Mãnh: Cô Nương Này, Ta Nhất Định Phải Cướp"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/users/story/thumbs/350x0/unnamed-1.jpg"
                                        srcset="uploads/users/story/thumbs/350x0/unnamed-1.jpg">
                                    <img loading="lazy" src="uploads/users/story/thumbs/350x0/unnamed-1.jpg"
                                        data-src="uploads/users/story/thumbs/350x0/unnamed-1.jpg" alt="unnamed-1.jpg"
                                        class="img-fluid">
                                </picture>
                            </a>
                            <h3>
                                <a href="truyen/the-tu-hung-manh-co-nuong-nay-ta-nhat-dinh-phai-cuop.html"
                                    title="Thế Tử Hung Mãnh: Cô Nương Này, Ta Nhất Định Phải Cướp"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Thế Tử Hung Mãnh: Cô Nương Này, Ta Nhất Định Phải Cướp
                                </a>
                            </h3>
                            <a href="tac-gia/nguyet-ha-qua-tu-tuu.html" title="Nguyệt Hạ Quả Tử Tửu"
                                class="cate lg:text-[0.875rem]">
                                Nguyệt Hạ Quả Tử Tửu
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/cai-nguyen-rua-nay-that-qua-tuyet-voi.html"
                                title="Cái Nguyền Rủa Này Thật Quá Tuyệt Vời - 1039"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/cai-nguyen-rua-nay.jpg"
                                        srcset="uploads/cover/thumbs/350x0/cai-nguyen-rua-nay.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/cai-nguyen-rua-nay.jpg"
                                        data-src="uploads/cover/thumbs/350x0/cai-nguyen-rua-nay.jpg"
                                        alt="Cái Nguyền Rủa Này Thật Quá Tuyệt Vời" class="img-fluid">
                                </picture>
                            </a>
                            <h3>
                                <a href="truyen/cai-nguyen-rua-nay-that-qua-tuyet-voi.html"
                                    title="Cái Nguyền Rủa Này Thật Quá Tuyệt Vời - 1039"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Cái Nguyền Rủa Này Thật Quá Tuyệt Vời - 1039
                                </a>
                            </h3>
                            <a href="tac-gia/hanh-gia-huu-tam.html" title="Hành Giả Hữu Tam"
                                class="cate lg:text-[0.875rem]">
                                Hành Giả Hữu Tam
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/dinh-cap-ngo-tinh-tu-co-so-quyen-phap-bat-dau.html"
                                title="Đỉnh Cấp Ngộ Tính: Từ Cơ Sở Quyền Pháp Bắt Đầu"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/bat-dau-ngo-tinh-tu-co-so.jpg"
                                        srcset="uploads/cover/thumbs/350x0/bat-dau-ngo-tinh-tu-co-so.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/bat-dau-ngo-tinh-tu-co-so.jpg"
                                        data-src="uploads/cover/thumbs/350x0/bat-dau-ngo-tinh-tu-co-so.jpg"
                                        alt="" class="img-fluid">
                                </picture> <span class="novel-stripe">
                                    <span class="story-status">FULL</span>
                                </span>
                            </a>
                            <h3>
                                <a href="truyen/dinh-cap-ngo-tinh-tu-co-so-quyen-phap-bat-dau.html"
                                    title="Đỉnh Cấp Ngộ Tính: Từ Cơ Sở Quyền Pháp Bắt Đầu"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Đỉnh Cấp Ngộ Tính: Từ Cơ Sở Quyền Pháp Bắt Đầu
                                </a>
                            </h3>
                            <a href="tac-gia/nguyet-trung-am.html" title="Nguyệt Trung Âm"
                                class="cate lg:text-[0.875rem]">
                                Nguyệt Trung Âm
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="card-story max-w-[300px]">
                            <a href="truyen/nhan-toc-tran-thu-su.html" title="Nhân Tộc Trấn Thủ Sứ - 3673"
                                class="img c-img pt-[138%] rounded-md overflow-hidden shadow-[0_7px_10px_1px_rgba(34,34,34,.1)] relative">
                                <picture>
                                    <source media="(min-width:0px)"
                                        data-srcset="uploads/cover/thumbs/350x0/nhan-toc-tran-thu-su.jpg"
                                        srcset="uploads/cover/thumbs/350x0/nhan-toc-tran-thu-su.jpg">
                                    <img loading="lazy" src="uploads/cover/thumbs/350x0/nhan-toc-tran-thu-su.jpg"
                                        data-src="uploads/cover/thumbs/350x0/nhan-toc-tran-thu-su.jpg"
                                        alt="Nhân Tộc Trấn Thủ Sứ" class="img-fluid">
                                </picture>
                            </a>
                            <h3>
                                <a href="truyen/nhan-toc-tran-thu-su.html" title="Nhân Tộc Trấn Thủ Sứ - 3673"
                                    class="title line-clamp-1 my-1 2xl:text-[1.125rem] text-[0.875rem] font-bold">
                                    Nhân Tộc Trấn Thủ Sứ - 3673
                                </a>
                            </h3>
                            <a href="tac-gia/bach-cau-dich-the.html" title="Bạch Câu Dịch Thệ"
                                class="cate lg:text-[0.875rem]">
                                Bạch Câu Dịch Thệ
                            </a>
                        </div>
                    </div>
                </div>
                <div
                    class="swiper-button swiper-prev cate-prev flex items-center justify-center absolute top-[40%] left-0 -translate-y-1/2 z-[1] cursor-pointer w-10 h-10 rounded-full bg-[#f0f8ff] text-[#128c7e] text-[1.3rem]">
                    <i class="fa-solid fa-chevron-left"></i>
                </div>
                <div
                    class="swiper-button swiper-next cate-next flex items-center justify-center absolute top-[40%] right-0 -translate-y-1/2 z-[1] cursor-pointer w-10 h-10 rounded-full bg-[#f0f8ff] text-[#128c7e] text-[1.3rem]">
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
@endsection
