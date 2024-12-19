<?php
use App\Http\Helpers\SettingHelpers;
$option = SettingHelpers::getInstance();
$all_categories = get_all_categories();
?>
<footer class="footer bg-[#fff] border-t-[1px] border-solid border-[#f8f9fa] shadow-[-2px_-10px_15px_0_rgba(68,64,64,.19)] py-2">
    <div class="container">
        <div class="menu-footer mb-2">
            <ul>
                <li>
                    <a href="page/dieu-khoan-dich-vu.html" title="Điều khoản dịch vụ">Điều khoản dịch vụ</a>
                </li>
                <li>
                    <a href="page/ban-quyen.html" title="Bản quyền">Bản quyền</a>
                </li>
                <li>
                    <a href="page/chinh-sach-bao-mat.html" title="Chính sách bảo mật">Chính sách bảo mật</a>
                </li>
                <li>
                    <a href="page/lien-he.html" title="Liên hệ">Liên hệ</a>
                </li>
            </ul>
        </div>
        <div class="flex flex-wrap justify-center">
        </div>
    </div>
</footer>
<div class="box-storyboard">
    <div class="head p-4 flex items-center justify-content-between">
        <p class="title font-bold text-[1.25rem]">
            Tủ truyện
        </p>
        <span class="btn-close-board"><i class="fa-solid fa-xmark"></i></span>
    </div>
    <div class="px-4 mb-4 ">
        <ul
            class="tab-categories-title tab-categories-title-admin border border-solid bg-[#128c7e] border-[#128c7e] text-[13px] flex justify-between items-center rounded-xl overflow-hidden text-white storyboard-box">
            <li>
                <a href="javascript:void(0)" title="Truyện đã đọc" data-type="1"
                    data-action="https://banlong.us/load-item-storyboard"
                    class="block not-login main-item-storyboard text-center p-2 border-r-[1px] border-solid border-[#128c7e] bg-white text-[#128c7e]">Truyện
                    đã đọc</a>
            </li>
            <li>
                <a href="javascript:void(0)" title="Truyện đang mua" data-type="2"
                    data-action="https://banlong.us/load-item-storyboard"
                    class="block not-login text-center p-2 border-r-[1px] border-solid border-[#128c7e] bg-white text-[#128c7e]">Truyện
                    đang mua</a>
            </li>
            <li>
                <a href="javascript:void(0)" title="Truyện đã lưu" data-type="3"
                    data-action="https://banlong.us/load-item-storyboard"
                    class="block not-login text-center p-2 border-r-[1px] border-solid border-[#128c7e] bg-white text-[#128c7e]">Truyện
                    đã lưu</a>
            </li>
        </ul>
    </div>
    <div class="board-content board-content-result flex-1 p-4"></div>
</div>
<div class="overlay-board"></div>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ER083V7JR6"></script>

<script src="{{ asset('assets/frontend/js/jquery-3.4.0.minb2fd.js?v='.FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
<script src="{{ asset('assets/frontend/js/toastify.minbb07.js?v='.FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
<script src="{{ asset('assets/frontend/js/xhrb2fd.js?v='.FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
<script src="{{ asset('assets/frontend/js/validatorb2fd.js?v='.FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
<script src="{{ asset('assets/tech5s_js/tech5s_base.minb2fd.js?v='.FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
<script src="{{ asset('assets/tech5s_js/libraries/Techb2fd.js?v='.FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
<script src="{{ asset('assets/tech5s_js/libraries/BackToTopb2fd.js?v='.FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
<script src="{{ asset('assets/frontend/js/toastify.minbb07.js?v='.FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
<script src="{{ asset('assets/frontend/js/baseb2fd.js?v='.FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
{{-- <script src="{{ asset('assets/frontend/js/scriptb2fd.js?v='.FVN_VERSION_LARAVEL) }}" type="text/javascript" type="text/javascript" defer></script> --}}
<script src="{{ asset('assets/js/modalb2fd.js?v='.FVN_VERSION_LARAVEL) }}" type="module" type="text/javascript" defer></script>
<script src="{{ asset('assets/js/scriptb2fd.js?v='.FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
<script src="{{ asset('assets/js/slider42bb.js?v='.FVN_VERSION_LARAVEL) }}" type="text/javascript" defer></script>
{{-- <script>
    (function() {
        function c() {
            var b = a.contentDocument || a.contentWindow.document;
            if (b) {
                var d = b.createElement('script');
                d.innerHTML =
                    "window.__CF$cv$params={r:'8f3f916bebfd107d',t:'MTczNDUyOTI2Mi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='cdn-cgi/challenge-platform/h/b/scripts/jsd/787bc399e22f/maind41d.js';document.getElementsByTagName('head')[0].appendChild(a);";
                b.getElementsByTagName('head')[0].appendChild(d)
            }
        }
        if (document.body) {
            var a = document.createElement('iframe');
            a.height = 1;
            a.width = 1;
            a.style.position = 'absolute';
            a.style.top = 0;
            a.style.left = 0;
            a.style.border = 'none';
            a.style.visibility = 'hidden';
            document.body.appendChild(a);
            if ('loading' !== document.readyState) c();
            else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
            else {
                var e = document.onreadystatechange || function() {};
                document.onreadystatechange = function(b) {
                    e(b);
                    'loading' !== document.readyState && (document.onreadystatechange = e, c())
                }
            }
        }
    })();
</script> --}}
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"
    integrity="sha512-ZpsOmlRQV6y907TI0dKBHq9Md29nnaEIPlkf84rnaERnq6zvWvPUqr2ft8M1aS28oN72PdrCzSjY4U6VaAw1EQ=="
    data-cf-beacon='{"rayId":"8f3f916bebfd107d","version":"2024.10.5","r":1,"serverTiming":{"name":{"cfExtPri":true,"cfL4":true,"cfSpeedBrain":true,"cfCacheStatus":true}},"token":"0012a0c47dac48d3b6fefb247d7fd933","b":1}'
    crossorigin="anonymous"></script>
