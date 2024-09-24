<?php

?>
@extends('layouts.backend')
@section('content')
    <script src="{{ asset('assets/js/vue.js') }}"></script>
    <script src="{{ asset('assets/js/routeapi.js') }}"></script>
    <script src="{{ asset('assets/js/vue-input.js') }}"></script>
    <div id="app">
        <template v-if="screen=='list'">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{$page_title}}</h1>
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
            </div>
            <a @click="changeScreen('detail')" class="btn btn-primary">Thêm mới</a>
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
                                    <th></th>
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
                                    <th></th>
                                    <th>Tên</th>
                                    <th>Email</th>
                                    <th>Nhóm</th>
                                    <th>Thời gian</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(item, index) in items">
                                    <td>@{{index+1}}</td>
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
        </template>
        <div v-if="loading" class="position-fixed top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center" style="z-index: 9999; background-color: rgb(0 0 0 / 50%);">
            <div class="spinner-border text-success" role="status" style="width: 5rem; height: 5rem;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <template v-if="screen=='detail'">
            <form  method="POST">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="">Tên</label>
                            {{--  class error: is-invalid--}}
                            <input type="text" name="name" class="form-control " placeholder="Tên...">
                                {{-- <div class="invalid-feedback">
                                </div> --}}
                        </div>
                    </div>
            
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control " placeholder="Email...">
                                {{-- <div class="invalid-feedback">
                                </div> --}}
                        </div>
                    </div>
            
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="">Nhóm</label>
                            <select name="group_id" id="" class="form-control">
                                <option value="">Chọn nhóm</option>
                                <option value="1">admin</option>
                            </select>
                                {{-- <div class="invalid-feedback">
                                </div> --}}
                        </div>
                    </div>
            
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="">Mật khẩu</label>
                            <input type="password" name="password" class="form-control" placeholder="Mật khẩu...">
                                {{-- <div class="invalid-feedback">
                                </div> --}}
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-primary">Lưu lại</button>
                        <button class="btn btn-danger">Hủy</button>
                    </div>
                </div>
            
            </form>
        </template>
    </div>
    <script src="{{ asset('backend/js/manager_users.js?version=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection


@section('scripts')
@endsection
