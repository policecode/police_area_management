<?php
use App\Http\Helpers\SettingHelpers;
$option = SettingHelpers::getInstance();
// $all_categories = get_all_categories();
?>
<footer
    class="footer bg-[#fff] border-t-[1px] border-solid border-[#f8f9fa] shadow-[-2px_-10px_15px_0_rgba(68,64,64,.19)] py-2">
    <div class="container flex justify-between items-center flex-wrap">
        <div class="flex flex-wrap justify-center">
            @if ($option->getOptionValue('fvn_telegram_link'))
                <div class="mr-4 items-center">
                    <h3>
                        <a href="{{ $option->getOptionValue('fvn_telegram_link') }}" title="Nhóm Telegram"
                            class="title line-clamp-1 my-1 text-[1.125rem] font-bold">
                            <i class="fa-brands fa-telegram"></i>
                            Telegram
                        </a>
                    </h3>
                </div>
            @endif

            @if ($option->getOptionValue('fvn_facebook_link'))
                <div class="mr-4">
                    <h3>
                        <a href="{{ $option->getOptionValue('fvn_facebook_link') }}" title="Nhóm Facebook "
                            class="title line-clamp-1 my-1 text-[1.125rem] font-bold text-[#007bff]">
                            <i class="fa-brands fa-facebook"></i>
                            Facebook
                        </a>
                    </h3>

                </div>
            @endif
            @if ($option->getOptionValue('fvn_tiktok_link'))
                <div class="mr-4">
                    <h3>
                        <a href="{{ $option->getOptionValue('fvn_tiktok_link') }}" title="Nhóm Tiktok "
                            class="title line-clamp-1 my-1 text-[1.125rem] font-bold text-[#373941]">
                            <i class="fa-brands fa-tiktok"></i>
                            Tiktok
                        </a>
                    </h3>
                </div>
            @endif
            @if ($option->getOptionValue('fvn_twitter_link'))
                <div class="mr-4">
                    <h3>
                        <a href="{{ $option->getOptionValue('fvn_twitter_link') }}" title="Nhóm Twitter "
                            class="title line-clamp-1 my-1 text-[1.125rem] font-bold text-[#26a8cb]">
                            <i class="fa-brands fa-twitter"></i>
                            Twitter
                        </a>
                    </h3>
                </div>
            @endif
            @if ($option->getOptionValue('fvn_discord_link'))
                <div class="mr-4">
                    <h3>
                        <a href="{{ $option->getOptionValue('fvn_discord_link') }}" title="Nhóm Discord "
                            class="title line-clamp-1 my-1 text-[1.125rem] font-bold text-[#4497f8]">
                            <i class="fa-brands fa-discord"></i>
                            Discord
                        </a>
                    </h3>
                </div>
            @endif
            @if ($option->getOptionValue('fvn_instagram_link'))
                <div class="mr-4">
                    <h3>
                        <a href="{{ $option->getOptionValue('fvn_instagram_link') }}" title="Nhóm Instagram "
                            class="title line-clamp-1 my-1 text-[1.125rem] font-bold text-[#007bff]">
                            <i class="fa-brands text-[#d31f1f]"></i>
                            Instagram
                        </a>
                    </h3>
                </div>
            @endif
        </div>
        <div class="menu-footer mb-2">
            <ul>

                <li>
                    <a href="{{ route('client.dieu-khoan-dich-vu') }}" title="Điều khoản dịch vụ">Điều khoản dịch vụ</a>
                </li>
                <li>
                    <a href="{{ route('client.ban-quyen') }}" title="Bản quyền">Bản quyền</a>
                </li>
                <li>
                    <a href="{{ route('client.chinh-sach-bao-mat') }}" title="Chính sách bảo mật">Chính sách bảo mật</a>
                </li>
                <li>
                    <a href="{{ route('client.lien-he') }}" title="Liên hệ">Liên hệ</a>
                </li>
            </ul>
        </div>
        <div class="flex flex-wrap justify-center">
        </div>
    </div>
</footer>
