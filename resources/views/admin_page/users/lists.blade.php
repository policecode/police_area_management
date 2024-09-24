<?php

?>
@extends('layouts.backend')
@section('content')
    <script src="{{ asset('assets/js/vue.js') }}"></script>
    <script src="{{ asset('assets/js/routeapi.js') }}"></script>
    <script src="{{ asset('assets/js/vue-input.js') }}"></script>
    <div id="app">
        <a class="btn btn-primary">Thêm mới</a>
        <!-- DataTales Example -->
        <div class="card shadow mb-4 mt-2">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Quản lý người dùng</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    {{-- <div class="alert alert-success">Message</div> --}}
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Nhóm</th>
                                <th>Thời gian</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Nhóm</th>
                                <th>Thời gian</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr v-for="item in items">
                                <td>@{{ item.name }}</td>
                                <td>@{{ item.email }}</td>
                                <td>@{{ item.group_id }}</td>
                                <td>@{{ displayDate(item.created_at) }}</td>
                                <td><a class="btn btn-warning">Sửa</a></td>
                                <td><a class="btn btn-danger delete__action">Xóa</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <fvn-paging :page="querySearch.page" :per_page="querySearch.per_page" :total="querySearch.total" @change-limit="changeLimit" @change-page="(page) => nextPage(page)"></fvn-paging>
            {{-- @include('parts.template.paging') --}}
            {{-- @include('parts.backend.formDelete') --}}
        </div>
        <div v-if="loading" class="position-fixed top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="z-index: 9999; background-color: rgb(0 0 0 / 50%);">
            <div class="spinner-border text-success" role="status" style="width: 5rem; height: 5rem;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    </div>
    <script src="{{ asset('backend/js/manager_users.js?version=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection


@section('scripts')
@endsection
