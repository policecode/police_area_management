<?php 
use App\Enums\GroupsEnum;
?>
@extends('layouts.backend')
@section('content')
    <script>
        var groups = {{ Illuminate\Support\Js::from(GroupsEnum::getInstances()) }};
    </script>
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
            <a @click="changeScreen('detail')" class="btn btn-primary">Thêm nhóm mới</a>
            <div class="row mt-4">
        
                <div class="col-3">
                    <input v-model="querySearch.keyword" type="text" class="form-control" placeholder="Search...">
                </div>
                <div class="col-4">
                    <button @click="searchItem" class="btn btn-success">Fillter</button>
                    <button @click="clearFilter" class="btn btn-danger">Clear Fillter</button>
                </div>
            </div>
            <div class="card shadow mb-4 mt-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quản lý nhóm</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- <div class="alert alert-success">Message</div> --}}
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Tên nhóm</th>
                                    <th>Key</th>
                                    <th>Phân quyền</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Tên nhóm</th>
                                    <th>Key</th>
                                    <th>Phân quyền</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(item, index) in items">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ item.name }}</td>
                                    <td>@{{ item.slug }}</td>
                                    <td><a @click="showItem(item, 'permission')" class="btn btn-success">Phân quyền</a></td>
                                    <td><a @click="showItem(item)" class="btn btn-warning">Sửa</a></td>
                                    <td><a @click="deleteItem(item)" class="btn btn-danger">Xóa</a></td>
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
        <template v-if="screen=='detail'">
            <div>
                <form @submit="save">
                    <legend v-if="itemDetail.id" class="text-primary">Cập nhật thông tin nhóm</legend>
                    <legend v-else class="text-primary">Thêm nhóm mới</legend>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Tên nhóm</label>
                                <input type="text" v-model="itemDetail.name" class="form-control"
                                    :class={'is-invalid':errors.name} placeholder="Tên nhóm...">
                                <div v-if="errors.name" class="invalid-feedback">@{{ errors.name[0] }}</div>
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Slug</label>
                                <input type="text" v-model="itemDetail.slug" class="form-control"
                                    :class={'is-invalid':errors.slug} placeholder="Key...">
                                <div v-if="errors.slug" class="invalid-feedback">@{{ errors.slug[0] }}</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Lưu lại</button>
                            <button @click="closeItem" class="btn btn-danger">Hủy</button>
                        </div>
                    </div>
                </form>

            </div>
        </template>
        <template v-if="screen=='permission'">
            <div class="bg-body-secondary">
                <form @submit="savePermission">
                    <legend class="text-primary">Bảng phân quyền</legend>
                    <div class="row">
                        <div v-for="item in groups" class="col-12 mb-4">
                            <div class="row">
                                <h5 class="text-dark">@{{item.value}}</h5>
                                <div v-for="role in item.permission" class="form-check col-3">
                                    <input v-model="itemDetail.permissions" class="form-check-input" type="checkbox" :value="role.role" :id="role.role">
                                    <label class="form-check-label" :for="role.role">
                                      @{{role.name}}
                                    </label>
                                  </div>
                            </div>
                            <hr/>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Lưu lại</button>
                            <button @click="closeItem" class="btn btn-danger">Hủy</button>
                        </div>
                    </div>
                </form>
        </template>
    </div>
    
    <script src="{{ asset('backend/js/manager_groups.js?version=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection


@section('scripts')
@endsection
