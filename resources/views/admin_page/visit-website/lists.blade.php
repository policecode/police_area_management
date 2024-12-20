<?php 
?>
@extends('layouts.backend')
@section('content')
    <script src="{{ asset('assets_global/js/vue.js') }}"></script>
    <script src="{{ asset('assets_global/js/routeapi.js') }}"></script>
    <script src="{{ asset('assets_global/js/vue-input.js') }}"></script>
    {{-- @include('parts.template.importQuilleditor') --}}
    {{-- <script src="{{ asset('assets_global/js/vue-multiselect.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets_global/css/vue-multiselect.min.css') }}"> --}}
    <script src="{{ asset('assets_global/js/vuejs-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets_global/js/vuejs-datepicker-locale-vi.js') }}"></script>
    <script src="{{ asset('assets_global/js/VueBootstrapTypeahead.umd.min.js') }}"></script>

    <div id="app">
        <template v-if="screen=='list'">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ $page_title }}</h1>
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
            </div>
            {{-- <a @click="changeScreen('detail')" class="btn btn-primary">Thêm mới</a> --}}
            <div class="row mt-4">
                {{-- <div class="col-3">
                    <select class="form-select">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                </div> --}}
                {{-- <div class="col-3">
                    <input v-model="querySearch.keyword" type="text" class="form-control" placeholder="Search...">
                </div> --}}
                <div class="col-3">
                    <datepicker v-model="querySearch.key" format="yyyy-MM-dd" name="key" class="w-100 candidate-dob" input-class="w-100" placeholder="Chọn ngày"></datepicker>
                </div>
                <div class="col-3">
                    <button @click="searchItem" class="btn btn-success">Fillter</button>
                    <button @click="clearFilter" class="btn btn-danger">Clear Fillter</button>
                </div>
            </div>
            <div class="card shadow mb-4 mt-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thống kê lượng truy cập</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- <div class="alert alert-success">Message</div> --}}
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Địa chỉ Ip</th>
                                    <th>Số lượng request</th>
                                    <th>Thời gian tạo</th>
                                    <th>Thời gian cập nhật cuối</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Địa chỉ Ip</th>
                                    <th>Số lượng request</th>
                                    <th>Thời gian tạo</th>
                                    <th>Thời gian cập nhật cuối</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(item, index) in items">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ item.ip_address }}</td>
                                    <td>@{{ item.count }}</td>
                                    <td>@{{ formatdate(item.created_at) }}</td>
                                    <td>@{{ formatdate(item.updated_at) }}</td>
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
                    <legend v-if="itemDetail.id" class="text-primary">Cập nhật thông tin tác giả</legend>
                    <legend v-else class="text-primary">Thêm tác giả mới</legend>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Tên tác giả</label>
                                <input type="text" v-model="itemDetail.name" class="form-control"
                                    :class={'is-invalid':errors.name} placeholder="Tên tác giả...">
                                <div v-if="errors.name" class="invalid-feedback">@{{ errors.name[0] }}</div>
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Slug</label>
                                <input type="text" v-model="itemDetail.slug" class="form-control"
                                    :class={'is-invalid':errors.slug} placeholder="Slug...">
                                <div v-if="errors.slug" class="invalid-feedback">@{{ errors.slug[0] }}</div>
                            </div>
                        </div>
    
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="">Giới thiệu về tác giả</label>
                                <fvn-text-editor v-model="itemDetail.description" label="Giới thiệu về tác giả"></fvn-text-editor>
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

    </div>
    
    <script src="{{ asset('backend/js/manager_visit_website.js?version=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection


@section('scripts')
@endsection
