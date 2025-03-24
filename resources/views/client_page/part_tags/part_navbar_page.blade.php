<section id="client_navbar_tabs_app" class="nav-page py-3">
    <div class="container sm:flex items-center justify-between">
        <h1 class="title font-bold xl:text-[1.5rem] text-[1.25rem] sm:mr-2 mb-2 sm:mb-0 text-center sm:text-left">{{ $breadcrumb[1]['title'] }}</h1>
        <ul class="tab-categories-title bg-[#128c7e] text-[13px] flex justify-between items-center rounded overflow-hidden text-white">
            <li><a @click="showCategories" href="javasciprt:void(0)" title="Thể loại" class="block p-2 rounded">Thể loại</a></li>
            <li><a href="{{route('client.full-story')}}" title="Hoàn thành" class="block p-2 rounded">Hoàn thành</a></li>
            <li><a href="{{route('client.new-update')}}" title="Mới" class="block p-2 rounded">Truyện mới</a></li>
            <li><a href="{{route('client.hot-story')}}" title="Truyện hay" class="block p-2 rounded">Truyện Hay</a></li>
            <li><a href="{{route('client.view-story')}}" title="Xem nhiều" class="block p-2 rounded">Xem nhiều</a></li>
            <li><a href="{{route('client.superSearch')}}" title="Tìm kiếm nâng cao" class="block p-2 rounded">Filter</a></li>
        </ul>
    </div>
</section>

<script>
    var vue_client_navbar_tabs = {

    };
    var appClientNavbarTab = new Vue({
        el: '#client_navbar_tabs_app',
        data: vue_client_navbar_tabs,
        mounted: function() {},
        computed: {},
        methods: {
            showCategories() {
                vue_client_sidebar_app.show_categories = true;
            },
   
        },
        watch: {

        },
    });
</script>