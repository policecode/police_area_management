<?php
use App\Enums\CategoryType;

$categoryType = CategoryType::asArray();
?>
@extends('layouts.backend')
@section('content')
    <script src="{{ asset('assets_global/js/vue.js') }}"></script>
    <script src="{{ asset('assets_global/js/routeapi.js') }}"></script>
    <script src="{{ asset('assets_global/js/vue-input.js') }}"></script>
    @include('parts.template.importQuilleditor')
    <script src="{{ asset('assets_global/js/vue-multiselect.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets_global/css/vue-multiselect.min.css') }}">

    <div id="app">
        <template v-if="screen=='list'">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ $page_title }}</h1>
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
            </div>
            <div class="row mt-4">
                <div class="col-3">
                     <multiselect v-model="multiselect.story" 
                        @search-change="getStories" :options="stories" :multiple="false"
                        :close-on-select="true" :searchable="true" placeholder="Lọc theo truyện"
                        label="title" track-by="id" class="alignleft actions" :show-labels="false"
                        :allow-empty="true"></multiselect>
                </div>
                <div class="col-3">
                   <multiselect v-model="multiselect.user"
                        @search-change="getUsers" :options="users" :multiple="false"
                        :close-on-select="true" :searchable="true" placeholder="Tìm theo tài khoản"
                        label="name" track-by="id" class="alignleft actions" :show-labels="false"
                        :allow-empty="true"></multiselect>
                </div>
                <div class="col-3">
                    <button @click="searchItem" class="btn btn-success">Fillter</button>
                    <button @click="clearFilter" class="btn btn-danger">Clear Fillter</button>
                </div>
            </div>
            <div class="card shadow mb-4 mt-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quản lý đánh giá</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- <div class="alert alert-success">Message</div> --}}
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Tên truyện</th>
                                    <th>Tài khoản</th>
                                    <th>Bình luận</th>
                                    <th>Sao</th>
                                    <th>IP</th>
                                    <th>Thời gian</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Tên truyện</th>
                                    <th>Tài khoản</th>
                                    <th>Bình luận</th>
                                    <th>Sao</th>
                                    <th>IP</th>
                                    <th>Thời gian</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(item, index) in items">
                                    <td>@{{ index + 1 }}</td>
                                    <td>
                                        <a :href="item.url_story" target="_blank" >@{{ item.title }}</a>
                                    </td>
                                    <td>
                                        <a :href="item.url_profile" target="_blank" >@{{ item.name }}</a>
                                    </td>
                                    <td>@{{ item.content }}</td>
                                    <td>@{{ item.point_star }}</td>
                                    <td>@{{ item.ip_address }}</td>
                                    <td>@{{ convertStringAfterTime(item.after_minutes) }}</td>
                                    <td>
                                        {{-- <a @click="showItem(item)" class="btn btn-success position-relative">
                                            <i class="fa-regular fa-comment"></i>
                                        </a> --}}
                                        <a @click="deleteItem(item)" class="btn btn-danger"><i
                                                class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <fvn-paging :page="querySearch.page" :per_page="querySearch.per_page" :total="querySearch.total"
                    @change-limit="changeLimit" @change-page="(page) => nextPage(page)"></fvn-paging>
            </div>
        </template>
        <div v-if="loading"
            class="position-fixed top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center"
            style="z-index: 9999; background-color: rgb(0 0 0 / 50%);">
            <div class="spinner-border text-success" role="status" style="width: 5rem; height: 5rem;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        {{-- <template v-if="screen=='comment_childs'">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Tài khoản</th>
                                <th>Trả lời</th>
                                <th>Bình luận</th>
                                <th>Thời gian</th>
                                <th>Số Like</th>
                            </tr>
                        </thead>
             
                        <tbody>
                            <tr v-for="(item, index) in itemDetail.childs">
                                <td>@{{ index + 1 }}</td>
                                <td>
                                    <a :href="item.url_profile" target="_blank" >@{{ item.name }}</a>
                                </td>
                                <td>
                                    <a v-if="item.url_ask_profile" :href="item.url_ask_profile" target="_blank" >@{{ item.ask_name }}</a>
                                    <span v-else>Không có</span>
                                </td>
                                <td>@{{ item.content }}</td>
                                <td>@{{ convertStringAfterTime(item.after_minutes) }}</td>
                                <td>@{{ item.like }}</td>
                                <td>
                                    <a @click="deleteItem(item)" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <button @click="closeItem" class="btn btn-danger">Quay lại</button>
            </div>
        </template> --}}

    </div>

    <script src="{{ asset('backend/js/manager_star_ratings.js?version=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection


@section('scripts')
@endsection
