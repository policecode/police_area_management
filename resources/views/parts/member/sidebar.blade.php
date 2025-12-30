<?php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();

?>
<div id="member_sidebar_app">
     <div class="main-sidebar fixed top-0 left-[-100%] xl:left-0 w-[250px] h-full z-[100] overflow-y-auto bg-[#343a40]" :class="{'hidden_': show_navbar}">
        <span  @click="show_navbar = false" class="close-menu-sidebar absolute top-3 right-3 z-[1] text-[#c2c7d0] text-[1.25rem]">
            <i class="fa-solid fa-xmark"></i>
        </span>
         <p
             class="head text-[#c2c7d0] text-[1.25rem] py-[0.875rem] px-2 border border-b-[1px] border-solid border-[#4b545c]">
             Trang cá nhân
         </p>
         <div class="admin-nav px-2 mt-2">
             <ul>
                 <li><a href="{{route('member.profile_detail')}}" class="active" title="Thông tin cá nhân"><i
                             class="fa-solid fa-user mr-2"></i>Thông tin cá nhân</a></li>
                 {{-- <li class=""><a href="{{route('member.payment')}}" title="Lịch sử giao dịch"><i
                             class="fa-solid fa-file-invoice-dollar mr-2"></i>Lịch sử giao dịch</a>
                     <ul>
                         <li><a href="https://blhvip.vn/lich-su-mua-chuong" class="" title="Lịch sử mua chương">Lịch
                                 sử mua chương</a></li>
                         <li><a href="{{route('member.payment')}}" class="" title="Lịch sử nạp Linh Thạch">Lịch
                                 sử nạp Linh Thạch</a></li>
                         <li><a href="https://blhvip.vn/lich-su-ung-ho" class="" title="Lịch sử ủng hộ">Lịch sử
                                 ủng hộ</a></li>
                         <li><a href="https://blhvip.vn/lich-su-de-cu" class="" title="Lịch sử đề cử">Lịch sử
                                 đề cử</a></li>
                     </ul>
                     <span class="btn-dropdown-menu "><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                 </li> --}}
                 <li><a href="{{route('member.alert')}}" class="" title="Thông báo"><i
                             class="fa-solid fa-bell mr-2"></i>Thông báo</a></li>
                 <li><a href="{{route('member.mystory')}}" class="" title="Truyện của tôi"><i
                             class="fa-solid fa-book-open-reader mr-2"></i>Truyện của tôi</a></li>
                 <li><a href="{{route('member.gilfcode')}}" class="" title="Nhập Giftcode"><i
                             class="fa-solid fa-gift mr-2"></i>Nhập Giftcode</a></li>
                 <li><a href="{{route('auth.logout')}}" title=""><i
                             class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Đăng xuất</a></li>
             </ul>
         </div>
     </div>
     <div class="head-admin flex items-center justify-between px-2 bg-white border-b-[1px] border-solid border-[#dee2e6]">
         <span @click="show_navbar = !show_navbar" class="show-nav-admin inline-block p-4 cursor-pointer">
             <i class="fa-solid fa-bars"></i>
         </span>
         <div class="flex items-center">
             <a href="{{ route('index') }}" title="Trang chủ" class="block p-4"><i class="fa-solid fa-house"></i></a>
             <div class="admin-user relative p-4">
                 <span class="name text-[#222] text-[0.875rem]">@{{ user.name }}<i
                         class="fa-solid fa-caret-down ml-1"></i></span>
             </div>
         </div>
     </div>
 </div>


 <script>
    var vue_member_sidebar_app = {
        loading: false,
        show_navbar: false,
        user: {{ Illuminate\Support\Js::from($user) }},
        pointInTime: null
    };
    var appMemberSideBar = new Vue({
        el: '#member_sidebar_app',
        data: vue_member_sidebar_app,
        mounted: function() {
            // this.changeThemes();
        },
        computed: {},
        methods: {
            
        },
        watch: {
         'show_navbar'(newVal) {
            const element = document.querySelector('.main-content__admin');
            if(newVal) {
                element.classList.add('hidden_');
            } else {
                element.classList.remove('hidden_');
            }
         }
        },
    });
</script>