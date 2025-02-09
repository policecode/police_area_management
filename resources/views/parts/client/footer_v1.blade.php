<?php
// use App\Http\Helpers\SettingHelpers;
// $option = SettingHelpers::getInstance();
// $all_categories = get_all_categories();
?>
<footer
    class="footer bg-[#fff] border-t-[1px] border-solid border-[#f8f9fa] shadow-[-2px_-10px_15px_0_rgba(68,64,64,.19)] py-2">
    <div class="container">
        <div class="menu-footer mb-2">
            <ul>
                <li>
                    <a href="{{route('client.dieu-khoan-dich-vu')}}" title="Điều khoản dịch vụ">Điều khoản dịch vụ</a>
                </li>
                <li>
                    <a href="{{route('client.ban-quyen')}}" title="Bản quyền">Bản quyền</a>
                </li>
                <li>
                    <a href="{{route('client.chinh-sach-bao-mat')}}" title="Chính sách bảo mật">Chính sách bảo mật</a>
                </li>
                <li>
                    <a href="{{route('client.lien-he')}}" title="Liên hệ">Liên hệ</a>
                </li>
            </ul>
        </div>
        <div class="flex flex-wrap justify-center">
        </div>
    </div>
</footer>
