@extends('layouts.frontend_v1')
@section('head')
    <meta name="robots" content="none" />
    <meta name="googlebot" content="none">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/confirm.minb2fd.css?v='.FVN_VERSION_LARAVEL) }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/scss/chapterdcb9.css?v='.FVN_VERSION_LARAVEL) }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/tech5scomment/theme/css/emojionearea.minaf78.css?v='.FVN_VERSION_LARAVEL) }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/tech5scomment/theme/css/commentaf78.css?v='.FVN_VERSION_LARAVEL) }}" type="text/css" />

@endsection
@section('content')
    <script>
        var redirectToStory = '{{ $story['link'] }}';
        var apiUrlChapter =
            '{{ route('client.api.chaper', ['story_slug' => $story['slug'], 'chaper_slug' => $chaper['slug']]) }}';
    </script>
    <section class="py-4 read-stories">
        <div class="container chapter-content-container chapter-page-apply" style="">
            <ul class="breadcrumb">
                <li><a href="../../index.html" title="Trang chủ">Trang chủ</a></li>
                <li><a href="../../danh-muc/dich.html" title="Dịch">Dịch</a></li>
                <li><a href="../ac-mong-kinh-tap.html" title="Ác Mộng Kinh Tập">Ác Mộng Kinh Tập</a></li>
                <li><span>Chương 3: Hành trình.</span></li>
            </ul>

            <div class="box-control py-3 flex flex-wrap justify-center">
                <a href="chuong-2.html" title="Chương trước"
                    class="btn btn-control xl:text-[1.25rem] text-white !rounded bg-[#128c7e] xl:py-2 xl:px-4 hover:bg-[#0e6d62] hover:text-white">
                    <i class="fa-solid fa-angle-left mr-2"></i> Chương trước
                </a>
                <span
                    class="btn show-chapter__list !rounded xl:py-2 xl:px-4 text-white bg-[#6c757d] mx-1 text-[1.25rem] cursor-pointer btn-show-list-chapter-page">
                    <i class="fa-solid fa-table-list"></i>
                </span>
                <a href="chuong-4.html" title="Chương trước"
                    class="btn btn-control xl:text-[1.25rem] text-white !rounded bg-[#128c7e] xl:py-2 xl:px-4 hover:bg-[#0e6d62] hover:text-white">
                    Chương tiếp <i class="fa-solid fa-angle-right ml-2"></i>
                </a>
                <div class="w-full">
                    <div class="list-chapter-page"></div>
                </div>
            </div>
            <div id="chapter-content"
                style="background:#ffffff;color:#292e33;font-size:18px;line-height:24px;font-family:Roboto;">
                <h1 class="chapter-title font-bold mb-2">Chương 3: Hành trình.</h1>
                <p class="info-detail mb-1">
                    <i class="fa-solid fa-book mr-1"></i> Ác Mộng Kinh Tập
                </p>
                <p class="info-detail lg:">
                    <span class="mr-2 last:mr-0"><i class="fa-solid fa-pen-to-square mr-1"></i> Ôn Nhu Khuyến Thụy
                        Sư</span>
                    <span class="mr-2 last:mr-0"><i class="fa-regular fa-file-word mr-1"></i> 1576 Chữ</span>
                    <span class="mr-2 last:mr-0"><i class="fa-solid fa-clock mr-1"></i> 23/09/2024 09:59:02</span>
                </p>
                <div class="s-content text-justify mt-4  published-content">
                    <p>"Được rồi, có lẽ bây giờ người đều đã đến đủ. " Vạm vỡ tự nhiên vậy mà trở thành thủ lĩnh trong
                        đội ngũ: "Tiếp theo nhiệm vụ sắp bắt đầu rồi, mọi người hãy chuẩn bị cho tốt."</p>
                    <p>Như thể đáp lại lời nói của vạm vỡ vậy, phía xa dần dần đã có ánh sáng.</p>
                    <p>Khi ánh sáng càng ngày càng gần, hai luồng sáng xuyên qua đêm tối, một chiếc xe khách mới tinh
                        sang trọng chậm rãi dừng ở một bên sân ga.</p>
                    <p>"Nói ít lại, quan sát nhiều hơn, trước khi làm việc gì hãy đảm bảo an toàn trước, cố gắng không
                        hành động một mình. " Nhân lúc cửa xe khách còn chưa mở ra, vạm vỡ lại tranh thủ thời gian hạ
                        giọng dặn dò thêm vài câu.</p>
                    <p>Người phụ nữ có nốt ruồi viền môi dường như không vừa mắt với thái độ của vạm vỡ, phá đám nói:
                        "Rủi ro và lợi ích đi đôi với nhau, muốn đạt được thứ gì, thì phải trả giá trước."</p>
                    <p>Vừa dứt lời, cửa xe mở ra.</p>
                    <p>Từ trên có một cậu thanh niên nhảy xuống.</p>
                    <p>Húi cua, thân trên mặc một chiếc áo hoodies màu xanh lam, nửa dưới mặc một chiếc quần jean đã
                        giặt đến bạc màu, dáng vẻ thanh tú, khoảng ngoài 20 tuổi.</p>
                    <p>Miệng mấp máy như đang nhai kẹo cao su.</p>
                    <p>"Các vị hành khách đã đợi lâu rồi, xin lỗi vì lý do thời tiết đã làm chậm trễ. " Cậu thanh niên
                        vừa mở miệng đã cho tất cả mọi người một sự ngạc nhiên lớn, vậy mà lại là nữ.</p>
                    <p>Cô gái tự mình giới thiệu: "Thật vinh hạnh khi được làm hướng dẫn viên du lịch cho mọi người
                        trong chuyến đi này, tôi họ Trịnh, mọi người có thể gọi tôi là Tiểu Trịnh, hoặc là hướng dẫn
                        Trịnh."</p>
                    <p>"Hướng dẫn Trịnh. " Có người trả lời.</p>
                    <p>Tất cả mọi người đều rất ăn ý không xưng hô Tiểu Trịnh.</p>
                    <p>"Được rồi, mọi người nhanh lên xe thôi. " Hướng dẫn Trịnh khách khí chào hỏi: "Thời tiết xấu,
                        đường không dễ đi, chúng ta hãy tranh thủ thời gian."</p>
                    <p>Mọi người lên xe theo thứ tự từ trái sang phải, đầu tiên là vạm vỡ, sau đó là người phụ nữ có nốt
                        ruồi viền môi, nam nhân viên, người đàn ông trung niên đầu trọc, Giang Thành, tên mập linh hoạt,
                        cô gái thuần khiết lên xe cuối cùng.</p>
                    <p>Sau khi lên xe mới phát hiện đã có những hành khách khác trên xe.</p>
                    <p>Một cặp đôi tình nhân đang ngồi ở phía sau bên trái, cô gái đang đọc tạp chí, còn bạn trai đeo
                        bịt mắt và tai nghe, dựa vào kính cửa sổ nghỉ ngơi.</p>
                    <p>Ngoài ra còn có một phụ nữ trung niên dẫn theo một cậu bé lớn ngồi ở hàng ghế đầu tiên phía sau
                        tài xế.</p>
                    <p>Hẳn là hai mẹ con, chỉ có điều cậu bé có thể là do bị bệnh, tâm trạng không tốt, ánh mắt thất
                        thường, Giang Thành đi ngang qua phát hiện những ngón tay trên hai bàn tay của cậu đều quấn
                        băng.</p>
                    <p>Hướng dẫn Trịnh sau khi lên xe thì yêu cầu mọi người tìm một chỗ ngồi, sau đó đóng cửa lại, cô ta
                        ngồi ở bên phải tài xế.</p>
                    <p>Vạm vỡ ngồi sau hai mẹ con, người phụ nữ có nốt ruồi viền môi ngồi sau hướng dẫn Trịnh.</p>
                    <p>Vị trí mà Giang Thành chọn là hàng ghế thứ hai phía sau cặp tình nhân, hắn vừa ngồi xuống, một
                        thân hình cao lớn sáp đến: "Người anh em, hai chúng ta ngồi cùng nhau đi!"</p>
                    <p>Giang Thành ngẩng đầu lên, đúng như dự đoán là tên mập linh hoạt, hắn nói: "Được, nhưng tôi không
                        quen ngồi bên trong."</p>
                    <p>"Không sao, tôi có thể chen chúc một chút."</p>
                    <p>Nửa phút sau tên mập đã chen vào như ý nguyện, nhưng phần thừa ra vẫn chiếm sang một ít chỗ ngồi
                        của Giang Thành, buộc hắn phải dịch ra ngoài một ít.</p>
                    <p>Nam nhân viên nhiều lần muốn ngồi chung với người khác, nhưng đều nhận được sự lạnh nhạt, cuối
                        cùng vẫn là cô gái thuần khiết bảo anh ta ngồi xuống bên cạnh.</p>
                    <p>Người đàn ông trung niên ngồi một mình ở hàng cuối cùng, Giang Thành quay đầu lại nhìn anh ta một
                        cái, phát hiện sắc mặt âm trầm của anh ta đã đến mức có thể nhỏ ra giọt nước.</p>
                    <p>"Người anh em, nói cho tôi biết nơi này xảy ra chuyện gì?" Tên mập sáp đến, thấp giọng hỏi: "Tôi
                        ngủ thiếp đi rồi tới nơi này."</p>
                    <p>Giang Thành thêm mắm thêm muối vào tin tức có được từ vạm vỡ rồi nói với tên mập một lượt, nghe
                        xong anh ta suýt chút nữa đã khóc nói: "Nếu như chết ở đây, cả nhà đều sẽ chảy máu chết bất đắc
                        kỳ tử?"</p>
                    <p>"Đúng là như vậy."</p>
                    <p>"Sao tôi thấy anh cũng không quá sợ hãi thế?"</p>
                    <p>Giang Thành quay đầu lại, ngữ khí vô cùng trịnh trọng nói: "Bởi vì tôi là một cô nhi."</p>
                    <p>Hành trình rất bình yên, bình yên đến mức nam nhân viên cảm thấy có thể sẽ tiếp tục bình yên như
                        vậy, nhưng cùng với tiếng phanh gấp đột ngột vang lên, tất cả mộng tưởng đều tan thành mây khói.
                    </p>
                    <p>"Rầm!"</p>
                    <p>Quán tính lớn mang theo những mảnh kính vỡ, quét qua toàn bộ chiếc xe như một cơn bão.</p>
                    <p>Xe, đâm phải thứ gì đó.</p>
                    <p>Nam nhân viên thu mình trên ghế không ngừng la hét, cho đến khi vạm vỡ kéo anh ta ra khỏi xe, cho
                        hai cái bạt tai.</p>
                    <p>"Không muốn chết thì câm miệng lại!" Anh ta hung ác uy hiếp.</p>
                    <p>Nam nhân viên người đầy bụi đất co mình lại dưới đất, một lúc lâu sau mới đứng dậy trốn ở cuối
                        cùng của đội ngũ.</p>
                    <p>Quả thực.</p>
                    <p>Xe, đâm vào cây roi.</p>
                    <p>Tài xế xuống kiểm tra thì phát hiện trời mưa to khiến lề đường bị sạt lở, làm thay đổi quỹ đạo
                        bình thường của xe, mất thăng bằng và tông vào một gốc cây bên đường.</p>
                    <p>May mắn thay, không có ai bị thương nặng, đa số là trầy xước do mảnh kính vỡ làm.</p>
                    <p>Nhưng xe không lái được nữa, ở đây...</p>
                    <p>Giang Thành nhìn một vòng, có thể nói là trước không có làng, sau không có tiệm, chỉ có một con
                        đường thẳng dẫn đến một phương hướng không xác định.</p>
                    <p>Mưa, mặc dù đã nhỏ hơn chút, nhưng vẫn đang rơi.</p>
                    <p>"Các hành khách, thành thật xin lỗi. " Hướng dẫn Trịnh xoa xoa tay đi đến, trên cánh tay có những
                        vết máu nhỏ: "Xem ra hành trình hôm nay xôi hỏng bỏng không rồi."</p>
                    <p>Mới gặp mặt được vài tiếng đồng hồ mà cô ta đã hai lần xin lỗi rồi, nhưng ai cũng biết chẳng lần
                        nào là cô ta chân thành cả.</p>
                    <p>Theo lời của vạm vỡ, cô ta chỉ là một NPC để thúc đẩy cốt truyện.</p>
                    <p>"Hay là thế này đi, tôi biết trong khu rừng kia có một căn biệt thự, mọi người có thể đến đó trú
                        mưa trước, chờ chúng tôi tìm được xe, sẽ quay lại đón mọi người. " Hướng dẫn Trịnh chỉ vào khu
                        rừng cách đó không xa.</p>
                    <p>Ngay cả một người mới như Giang Thành cũng cảm thấy đây không phải là một lựa chọn tốt, nhưng vạm
                        vỡ và những người khác lại đồng ý, sau đó quay người đi về phía rừng cây.</p>
                    <p>Nhiệm vụ thực sự... đến rồi!</p>
                    <p>Bầu không khí thoải mái ban đầu cũng thay đổi theo.</p>
                    <p>"Đợi đã!" Hướng dẫn Trịnh gọi bọn họ lại, sau đó chạy trở lại xe lấy mấy chiếc ô xuống: "Đừng để
                        bị ướt."</p>
                    <p>"Cảm ơn!"</p>
                    <p>Đi trên con đường lầy lội, nếu không chú ý có thể sẽ bị ngã, nhóm người đi khoảng nửa giờ, cuối
                        cùng trước mặt cũng xuất hiện một ngôi biệt thự ba tầng.</p>
                    <p>Biệt thự được bao phủ bởi tầng tầng lớp lớp rừng rậm, nếu không đi khoảng cách rất gần thì cực kỳ
                        khó tìm được.</p>
                    <p>"Trong này người có ở được không?" Cô gái thuần khiết thấp giọng hỏi.</p>
                    <p>Sự đổ nát của biệt thự là điều dễ thấy, phỏng chừng 5 năm rồi cũng chưa có ai dọn dẹp, trước cửa
                        chất đống tầng tầng lớp lớp lá rụng.</p>
                    <p>"Nếu không muốn ở, có thể ở bên ngoài. " Vạm vỡ không thèm quay đầu lại, sau đó che ô, đi về phía
                        biệt thự.</p>
                    <p>Giang Thành nhìn bóng lưng của vạm vỡ, tâm tình của vạm vỡ dường như càng ngày càng kém, kỳ thật
                        tất cả mọi người đều có thể nghe ra, cô gái thuần khiết kia chỉ là đang càu nhàu một chút thôi.
                    </p>
                    <p>Nhưng Giang Thành lại ngửi thấy một mùi sợ hãi từ những lời càu nhàu và bất mãn của hai người.
                    </p>
                    <p>Chờ sau khi tất cả mọi người đều đã đi theo phía sau, tên mập che cùng một chiếc ô với Giang
                        Thành thúc giục: "Nhìn cái gì vậy người anh em, mau qua đó thôi."</p>
                    <p>"Ừm."</p>
                    <p>Gõ cửa không ai trả lời, vạm vỡ thử đẩy vào một cái, không ngờ cánh cửa gỗ dày cộp vậy mà lại mở
                        ra một khe hở.</p>
                    <p>Cửa, không khóa.</p>
                    <p>Sau khi cánh cửa được mở hoàn toàn, khung cảnh bên trong hiện ra trước mắt.</p>
                    <p>Phòng khách rộng rãi chỉ là hơi cũ kỹ một chút, nhưng lại không có cảm giác đổ nát, trên sàn nhà
                        tích tụ một lớp bụi mỏng, trên chiếc bàn ăn hình chữ nhật cũng vậy.</p>
                </div>
            </div>
        </div>
        <div class="container chapter-page-apply" style="">
      
            <div class="flex justify-between flex-wrap mt-6">
                <p class="text-[#128c7e]">
                    Sưu Tầm, 23/09/2024 09:59:02
                </p>
                <p class="text-[#128c7e]">Lượt xem: 46</p>
            </div>
            <div class="box-control py-3 flex flex-wrap justify-center">
                <a href="chuong-2.html" title="Chương trước"
                    class="btn btn-control xl:text-[1.25rem] text-white !rounded bg-[#128c7e] xl:py-2 xl:px-4 hover:bg-[#0e6d62] hover:text-white">
                    <i class="fa-solid fa-angle-left mr-2"></i> Chương trước
                </a>
                <span
                    class="btn show-chapter__list !rounded xl:py-2 xl:px-4 text-white bg-[#6c757d] mx-1 text-[1.25rem] cursor-pointer btn-show-list-chapter-page">
                    <i class="fa-solid fa-table-list"></i>
                </span>
                <a href="chuong-4.html" title="Chương trước"
                    class="btn btn-control xl:text-[1.25rem] text-white !rounded bg-[#128c7e] xl:py-2 xl:px-4 hover:bg-[#0e6d62] hover:text-white">
                    Chương tiếp <i class="fa-solid fa-angle-right ml-2"></i>
                </a>
                <div class="w-full">
                    <div class="list-chapter-page"></div>
                </div>
            </div>
            <div class="text-center">
                <a href="javascript:void(0)" title="Báo lỗi chương"
                    class="btn bg-[#f0ad4e] !text-white font-bold mr-2 last:mr-0 sm:min-w-[130px] mb-2"
                    modal-rs-target="modal-report">
                    <i class="fa-solid fa-triangle-exclamation mr-2"></i>Báo lỗi chương
                </a>
            </div>
        </div>
        <div class="container mt-6">
            <div id="comment-chapter-box"
                class="box-comment-wapper p-3 rounded bg-[#fff] mb-6 shadow-[2px_2px_6px_rgba(0,0,0,.13)]">
                <p class="text-[1.125rem] md:text-[1.25rem] mb-4 font-bold text[rgba(0,0,0,0.8)]">Bình luận (0)</p>
                <div class="simple-comment-box hidden"
                    idx="TldNZ1QwSHpkWDlUSjVvTlFnMnRjV3htVHBWeWNnVFhwbmVrNVVhM3BIVDJWWlUwZHVOMnh4YUV4UlprUm9kM1poVTFoM1VsQnNjbEU0TVdZPQ=="
                    identifier="c29HWnBSdTRtQWxXR0VtM0xraTkzYlFXQ21seGZpWXpOU2RtTnRiR3hqZWxFeVRsRTlQVTVLYTFKQlJtOUplakJSWm5Wb1owSlVOR2hzTTJNMWVGTlFPRVZKVFE9PQ=="
                    referrer="truyen/ac-mong-kinh-tap">
                    <p class="mb-2">* Hãy <a href="../../dang-nhap.html" class="text-[#128c7e] font-bold"
                            title="">đăng
                            nhập</a> để tham gia bình luận về truyện nhé.</p>
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
        </div>
    </section>
    <div class="fixed top-0 right-0 left-0 z-50 flex h-full w-full items-center justify-center overflow-hidden overflow-y-auto overflow-x-hidden bg-[#00000099] duration-500 md:inset-0 invisible pointer-events-none opacity-0"
        modal-rs="modal-report">
        <div class="popup-form md:max-w-[500px] bg-white relative mx-auto max-h-screen w-full max-w-[90%] overflow-y-auto rounded-md md:h-auto"
            modal-rs-content="">
            <span
                class="close-modal bg-[#128c7e] rounded p-1 flex w-6 h-6 items-center justify-center cursor-pointer absolute top-4 right-4 z-[1]"
                modal-rs-close="">
                <img src="../../asset/images/close-modal.png" alt="">
            </span>
            <p class="font-medium text-center text-[#000] text-[1.3rem] p-4 border-b-[1px] border-solid border-[#ebebeb]">
                Báo lỗi chương</p>
            <div id="report_chapter_error_form" class="form p-4 formValidation" accept-charset="utf8" absolute
                data-success="NOTIFICATION.toastrMessageReload">
                <input type="hidden" name="_token" value="f6n6nXmbaeGSTOsTpgAo7wkhO38kABB3FFG2GsG7"> <input
                    type="hidden" name="story_id" value="383">
                <input type="hidden" name="chapter_id" value="561808">
                <input type="hidden" name="user_id" value="">
                <p class="text-note text-[#607d8b] mb-2">Nhập mô tả lỗi</p>
                <textarea
                    class="form-control border border-solid border-[#ebebeb] bg-white rounded-md h-16 resize-none mb-2 w-full px-3 py-2"
                    name="content" rules="required" m-required="Vui lòng nhập mô tả lỗi"></textarea>
                <button id="report_chapter_error_btn" class="btn btn-green !rounded">Báo cáo</button>
            </div>
        </div>
    </div>
    <div class="chapter-action-box-wrapper">
        <div class="position-relative">
            <div class="setting-frontend font-bold">
                <p class="title-setting text-[1rem] lg:text-[1.25rem]">Cài đặt giao diện</p>
                <div class="p-3">
                    <div class="flex justify-between items-center mb-8">
                        <p class="title-item text-[0.9375rem]">Cỡ chữ (<span class="preview-value"></span>px):</p>
                        <input type="range" id="fontsize" min="12" max="30" value="18">
                    </div>
                    <div class="flex justify-between items-center mb-8">
                        <p class="title-item text-[0.9375rem]">Cách dòng (<span class="preview-value"></span>px):</p>
                        <input type="range" id="lineheight" min="20" max="50" value="24">
                    </div>
                    <div class="flex justify-between items-center mb-8">
                        <p class="title-item text-[0.9375rem]">Font chữ :</p>
                        <select id="fontfamily">
                            <option value="Roboto" selected>Roboto</option>
                            <option value="Athiti">Athiti</option>
                            <option value="Tahoma">Tahoma</option>
                            <option value="Helvetica">Helvetica</option>
                            <option value="Courier New">Courier New</option>
                            <option value="Verdana">Verdana</option>
                            <option value="Arial">Arial</option>
                            <option value="Palatino Linotypeoption">Palatino Linotypeoption</option>
                            <option value="Times New Roman">Times New Roman</option>
                        </select>
                    </div>
                    <div class="flex justify-between items-center mb-6">
                        <p class="title-item text-[0.9375rem]">Kiểu nền</p>
                        <div class="flex gap-3 w-full">
                            <div class="item-def-theme bg-[#f0f0f0]" data-color="#292e33" data-bg="#f0f0f0"></div>
                            <div class="item-def-theme bg-[#eae4d3]" data-color="#5b4636" data-bg="#eae4d3"></div>
                            <div class="item-def-theme bg-[#252c33]" data-color="#b6babf" data-bg="#252c33"></div>
                        </div>
                    </div>
                    <div class="flex justify-between items-center mb-2">
                        <p class="title-item text-[0.9375rem]">Màu chữ :</p>
                        <input type="color" id="color" value="#292e33">
                    </div>
                    <div class="flex justify-between items-center">
                        <p class="title-item text-[0.9375rem]">Màu nền :</p>
                        <input type="color" id="bg" value="#ffffff">
                    </div>
                    <label class="flex gap-2 items-center mt-6">
                        <p class="text-[0.9375rem]">Áp dụng màu nền cho toàn trang: </p>
                        <input type="checkbox" id="site_bg_apply" class="w-auto">
                    </label>
                    <div class="mt-6 text-right">
                        <a href="javascript:void(0)"
                            class="inline-block text-[1rem] !text-white !rounded bg-[#128c7e] py-2 px-4 hover:bg-[#0e6d62] mr-3"
                            onclick="CHAPTER_MANAGE.resetBaseTheme()" title="Trở về mặc định">
                            <i class="fa-solid fa-repeat mr-2"></i>Reset
                        </a>
                        <a href="javascript:void(0)"
                            class="inline-block text-[1rem] !text-white !rounded bg-[#7c7c7c] py-2 px-4 hover:bg-[#4c4c4c]"
                            onclick="$('.setting-frontend').removeClass('active')" title="Trở về mặc định">
                            <i class="fa-regular fa-rectangle-xmark mr-2"></i>Đóng
                        </a>
                    </div>
                </div>
            </div>
            <div class="chapter-action-box">
                <a href="javascript:void(0)" class="item-action show-chapter-theme-setting" title="Cài đặt giao diện">
                    <i class="fa-solid fa-gear"></i>
                </a>
                <a href="javascript:void(0)" class="item-action scroll-to-commnet-box" title="Bình luận truyện">
                    <i class="fa-solid fa-comments"></i>
                </a>
                <a href="../ac-mong-kinh-tap.html" class="item-action" title="Chi tiết truyện">
                    <i class="fa-solid fa-book"></i>
                </a>
                <a href="javascript:void(0)" class="item-action" onclick="CHAPTER_MANAGE.resetBaseTheme()"
                    title="Trở về mặc định">
                    <i class="fa-solid fa-repeat"></i>
                </a>
                <a href="javascript:void(0)" class="item-action" modal-rs-target="modal-report" title="Trở về mặc định">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </a>
            </div>
        </div>
    </div>

    <a id="scroll-to-top-btn" class="bottom-right" style="display: none;"><i class="fas fa-angle-double-up"></i></a>
    <script>
        var vue_chapter_app = {
            loading: false,
            barBtn: {
                desktop: true,
                mobile: true,
                setting: false
            },
            styles: {
                fontSize: LocalStorageHelper.get('chaper_font_size', 20)
            },
            items: [],
            querySearch: {
                total: 0,
                page: 1,
                per_page: 50,
                order_by: 'id',
                order_type: 'ASC'
            },
            itemDetail: {},
            story: {{ Illuminate\Support\Js::from($story) }},
            chaper: {{ Illuminate\Support\Js::from($chaper) }},
            apiUrl: FVN_LARAVEL_HOME + '/read',
            pointInTime: null,
        };
        var appChapter = new Vue({
            el: '#app_chapter',
            data: vue_chapter_app,
            mounted: function() {
                this.addViewStory();
                this.addHistoryReadStory();
            },
            computed: {

            },
            methods: {
                addViewStory() {
                    setTimeout(async () => {
                        let jsonData = await new RouteApi().post(`${this.apiUrl}/increase-views`, {
                            story_id: this.story.id,
                            chaper_id: this.chaper.id
                        });
                        if (jsonData.status) {
                            console.log(jsonData.message);
                        } else {
                            console.log(jsonData.message);
                        }
                    }, 60000);
                },
                reduceSize() {
                    if (this.styles.fontSize <= 15) {
                        return;
                    }
                    --this.styles.fontSize;
                },
                increaseSize() {
                    if (this.styles.fontSize >= 35) {
                        return;
                    }
                    ++this.styles.fontSize;
                },
                addHistoryReadStory() {
                    let listStoryHistory = LocalStorageHelper.getObject('fvn_story_history', []);
                    let story = {
                        id: this.story.id,
                        title: this.story.title,
                        slug: this.story.slug,
                        link: this.story.link,
                        chapter_name: this.chaper.name,
                        slug_chapter: this.chaper.slug,
                        position: this.chaper.position,
                        link_chapter: this.chaper.link
                    }
                    let results = [];
                    results.push(story);
                    if (listStoryHistory.length > 0) {
                        for (let i = 0; i < listStoryHistory.length; i++) {
                            if (listStoryHistory[i].id != story.id) {
                                results.push(listStoryHistory[i]);
                            }
                            if (results.length >= 5) {
                                break;
                            }
                        }
                    }
                    LocalStorageHelper.setObject('fvn_story_history', results);

                }
            },
            watch: {
                'styles.fontSize'(newVal) {
                    LocalStorageHelper.set('chaper_font_size', newVal);
                    $('.chapter-content').css({
                        'font-size': newVal + 'px'
                    });
                }
            },
        });
    </script>
@endsection

@section('scripts')
    <script src="{{ asset('frontend/js/chapter.js?v=' . FVN_VERSION_LARAVEL) }}"></script>
    <script src="{{ asset('assets/js/website_security.js?v=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection
