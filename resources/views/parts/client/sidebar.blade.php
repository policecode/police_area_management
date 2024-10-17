<?php
use App\Http\Helpers\SettingHelpers;
use App\Enums\TotalChapter;
$option = SettingHelpers::getInstance();
$all_categories = get_all_categories();
$totalChapter = TotalChapter::asArray();

?>
<div id="client_sidebar_app">
    <header class="header d-none d-lg-block">
        <!-- place navbar here -->
        <nav class="navbar navbar-expand-lg navbar-dark header__navbar p-md-0">
            <div class="container">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ $option->getOptionImage('fvn_logo') ? $option->getOptionImage('fvn_logo') : asset('assets/images/logo_text.png') }}"
                        alt="{{ $option->getOptionValue('fvn_web_title') }}" srcset="" class="img-fluid"
                        style="width: 200px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Thể loại
                            </a>
                            <ul class="dropdown-menu dropdown-menu-custom">
                                @foreach ($all_categories as $key => $cat)
                                    <li><a class="dropdown-item"
                                            href="{{ route('client.tag', ['tag_slug' => $cat['slug']]) }}">{{ $cat['name'] }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Theo số chương
                            </a>
                            <ul class="dropdown-menu dropdown-menu-custom">
                                @foreach ($totalChapter as $item)
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('client.total-chapter', ['slug_total' => $item['key']]) }}">{{ $item['value'] }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                    </ul>

                    <div class="form-check form-switch me-3 d-flex align-items-center">
                        <label class="form-check-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                                class="bi bi-brightness-high" viewBox="0 0 16 16" style="fill: #fff;">
                                <path
                                    d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z">
                                </path>
                            </svg>
                        </label>
                        <input v-model="isThemeLight" @change="changeThemes" value="1"
                            class="form-check-input theme_mode" type="checkbox"
                            style="transform: scale(1.3); margin-left: 12px; margin-right: 12px;" />

                        <label class="form-check-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 384 512"
                                style="fill: #fff;">
                                <path
                                    d="M144.7 98.7c-21 34.1-33.1 74.3-33.1 117.3c0 98 62.8 181.4 150.4 211.7c-12.4 2.8-25.3 4.3-38.6 4.3C126.6 432 48 353.3 48 256c0-68.9 39.4-128.4 96.8-157.3zm62.1-66C91.1 41.2 0 137.9 0 256C0 379.7 100 480 223.5 480c47.8 0 92-15 128.4-40.6c1.9-1.3 3.7-2.7 5.5-4c4.8-3.6 9.4-7.4 13.9-11.4c2.7-2.4 5.3-4.8 7.9-7.3c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-3.7 .6-7.4 1.2-11.1 1.6c-5 .5-10.1 .9-15.3 1c-1.2 0-2.5 0-3.7 0c-.1 0-.2 0-.3 0c-96.8-.2-175.2-78.9-175.2-176c0-54.8 24.9-103.7 64.1-136c1-.9 2.1-1.7 3.2-2.6c4-3.2 8.2-6.2 12.5-9c3.1-2 6.3-4 9.6-5.8c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-3.6-.3-7.1-.5-10.7-.6c-2.7-.1-5.5-.1-8.2-.1c-3.3 0-6.5 .1-9.8 .2c-2.3 .1-4.6 .2-6.9 .4z">
                                </path>
                            </svg>
                        </label>
                    </div>

                    <div class="d-flex header__form-search">
                        <input v-model="querySearch.keyword" class="form-control search-story" type="text"
                            placeholder="Tìm kiếm" name="key_word">
                        <div v-if="items.length > 0" class="col-12 search-result shadow no-result">
                            <div class="card text-white bg-light">
                                <div class="card-body p-0">
                                    <ul v-if="items.length > 0" class="list-group list-group-flush">
                                        <li v-for="(item, index) in items" class="list-group-item hover-darkgrey">
                                            <a :href="item.url" :title="titleAuthor(item.author_name)"
                                                class="text-dark hover-title d-block">@{{ item.title }}
                                                (@{{ item.author_name }})</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div v-if="(items.length == 0) && (querySearch.keyword.length > 3)"
                            class="col-12 search-result shadow no-result">
                            <div class="card text-white bg-light">
                                <div class="card-body p-0 text-dark text-align">
                                    <i v-if="loading" class="fa-solid fa-spinner spin_circle"></i>
                                    <span v-else>Không tìm thấy truyện nào</span>
                                </div>
                            </div>
                        </div>
                        <button class="btn" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="header-mobile d-sm-block d-lg-none">
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('index') }}">
                    <img src="{{ $option->getOptionImage('fvn_logo') ? $option->getOptionImage('fvn_logo') : asset('assets/images/logo_text.png') }}"
                        alt="{{ $option->getOptionValue('fvn_web_title') }}" srcset="" class="img-fluid"
                        style="width: 200px;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end text-bg-dark w-75" tabindex="-1" id="offcanvasDarkNavbar"
                    aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header">
                        <img src="{{ $option->getOptionImage('fvn_logo') ? $option->getOptionImage('fvn_logo') : asset('assets/images/logo_text.png') }}"
                            alt="{{ $option->getOptionValue('fvn_web_title') }}" srcset="" class="img-fluid"
                            style="width: 200px;">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 mb-3">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Thể loại
                                </a>
                                <ul class="dropdown-menu dropdown-menu-custom">
                                    @foreach ($all_categories as $key => $cat)
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('client.tag', ['tag_slug' => $cat['slug']]) }}">{{ $cat['name'] }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Theo số chương
                                </a>
                                <ul class="dropdown-menu dropdown-menu-custom">
                                    @foreach ($totalChapter as $item)
                                        <li>
                                            <a class="dropdown-item"
                                                href="{{ route('client.total-chapter', ['slug_total' => $item['key']]) }}">{{ $item['value'] }}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                        </ul>

                        <div class="form-check form-switch d-flex align-items-center mb-3 p-0">
                            <label class="form-check-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    fill="currentColor" class="bi bi-brightness-high" viewBox="0 0 16 16"
                                    style="fill: #fff;">
                                    <path
                                        d="M8 11a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0 1a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z">
                                    </path>
                                </svg>
                            </label>
                            <input v-model="isThemeLight" @change="changeThemes" class="form-check-input theme_mode"
                                type="checkbox" style="transform: scale(1.3); margin-left: 12px; margin-right: 12px;">

                            <label class="form-check-label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                    viewBox="0 0 384 512" style="fill: #fff;">
                                    <path
                                        d="M144.7 98.7c-21 34.1-33.1 74.3-33.1 117.3c0 98 62.8 181.4 150.4 211.7c-12.4 2.8-25.3 4.3-38.6 4.3C126.6 432 48 353.3 48 256c0-68.9 39.4-128.4 96.8-157.3zm62.1-66C91.1 41.2 0 137.9 0 256C0 379.7 100 480 223.5 480c47.8 0 92-15 128.4-40.6c1.9-1.3 3.7-2.7 5.5-4c4.8-3.6 9.4-7.4 13.9-11.4c2.7-2.4 5.3-4.8 7.9-7.3c5-4.9 6.3-12.5 3.1-18.7s-10.1-9.7-17-8.5c-3.7 .6-7.4 1.2-11.1 1.6c-5 .5-10.1 .9-15.3 1c-1.2 0-2.5 0-3.7 0c-.1 0-.2 0-.3 0c-96.8-.2-175.2-78.9-175.2-176c0-54.8 24.9-103.7 64.1-136c1-.9 2.1-1.7 3.2-2.6c4-3.2 8.2-6.2 12.5-9c3.1-2 6.3-4 9.6-5.8c6.1-3.5 9.2-10.5 7.7-17.3s-7.3-11.9-14.3-12.5c-3.6-.3-7.1-.5-10.7-.6c-2.7-.1-5.5-.1-8.2-.1c-3.3 0-6.5 .1-9.8 .2c-2.3 .1-4.6 .2-6.9 .4z">
                                    </path>
                                </svg>
                            </label>
                        </div>

                        <div class="d-flex header__form-search" action="" method="GET">
                            <input v-model="querySearch.keyword" class="form-control search-story" type="text"
                                placeholder="Tìm kiếm" name="key_word">
                            <div v-if="items.length > 0" class="col-12 search-result shadow no-result">
                                <div class="card text-white bg-light">
                                    <div class="card-body p-0">
                                        <ul v-if="items.length > 0" class="list-group list-group-flush">
                                            <li v-for="(item, index) in items" class="list-group-item">
                                                <a :href="item.url" :title="titleAuthor(item.author_name)"
                                                    class="text-dark hover-title d-block">
                                                    @{{ item.title }} (@{{ item.author_name }})
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div v-if="(items.length == 0) && (querySearch.keyword.length > 3)"
                                class="col-12 search-result shadow no-result">
                                <div class="card text-white bg-light">
                                    <div class="card-body p-0 text-dark text-align">
                                        <i v-if="loading" class="fa-solid fa-spinner spin_circle"></i>
                                        <span v-else>Không tìm thấy truyện nào</span>
                                    </div>

                                </div>
                            </div>

                            <button class="btn" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="bg-light header-bottom">
        <div class="container py-1">
            @if (!empty($breadcrumb))
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="margin-bottom: 0;">
                        @foreach ($breadcrumb as $item)
                            @if ($item['title'] && $item['url'])
                                <li class="breadcrumb-item"><a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                                </li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">{{ $item['title'] }}</li>
                            @endif
                        @endforeach
                    </ol>
                </nav>
            @else
                <p class="mb-0">
                    {{ $option->getOptionValue('fvn_content_top') }}
                </p>
            @endif
        </div>
    </div>
</div>

<script>
    var vue_client_sidebar_app = {
        loading: false,
        items: [],
        isThemeLight: LocalStorageHelper.get('sidebar_theme_web', false),
        querySearch: {
            total: 0,
            page: 1,
            per_page: 10,
            keyword: '',
            order_by: 'id',
            order_type: 'DESC'
        },
        apiUrl: FVN_LARAVEL_HOME + '/api',
        pointInTime: null
    };
    var appClientSideBar = new Vue({
        el: '#client_sidebar_app',
        data: vue_client_sidebar_app,
        mounted: function() {
            this.changeThemes();
        },
        computed: {},
        methods: {
            async getItems() {
                this.items = [];

                this.buildQueryItem();
                const jsonData = await new RouteApi().get(this.getItemUrl)
                if (jsonData.result) {
                    this.items = jsonData.data;
                } else {
                    this.items = [];
                    // jAlert(jsonData.message);
                }
            },
            buildQueryItem() {
                this.getItemUrl = this.apiUrl + '/search/keyword?is_paginate=0';
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
            titleAuthor(name) {
                return `Tác giả: ${name}`
            },
            changeThemes() {
                if (this.isThemeLight) {
                    document.querySelector('body').classList.add('dark-theme');
                    LocalStorageHelper.set('sidebar_theme_web', this.isThemeLight);
                } else {
                    document.querySelector('body').classList.remove('dark-theme');
                    LocalStorageHelper.set('sidebar_theme_web', '')
                }
            }
        },
        watch: {
            'querySearch.keyword'(newVal) {
                this.loading = true;
                this.items = [];
                if (this.pointInTime) {
                    clearTimeout(this.pointInTime);
                }
                if (newVal.length > 3) {
                    this.pointInTime = setTimeout(() => {
                        this.getItems();
                        this.loading = false;
                    }, 1000)
                }
            }
        },
    });
</script>
