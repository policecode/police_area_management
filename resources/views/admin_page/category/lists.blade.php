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
            <a @click="changeScreen('detail')" class="btn btn-primary">Thêm mới</a>
            <div class="row mt-4">
                <div class="col-3">
                    <select  v-model="querySearch.type" class="form-select">
                        <option value="" selected>Chủ đề</option>
                        @foreach ($categoryType as $item)
                            <option value="{{ $item['key'] }}">{{ $item['value'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3">
                    <input v-model="querySearch.keyword" type="text" class="form-control" placeholder="Search...">
                </div>
                <div class="col-3">
                    <button @click="searchItem" class="btn btn-success">Fillter</button>
                    <button @click="clearFilter" class="btn btn-danger">Clear Fillter</button>
                </div>
            </div>
            <div class="card shadow mb-4 mt-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quản lý thể loại</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- <div class="alert alert-success">Message</div> --}}
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Thể loại</th>
                                    <th>Đường dẫn tĩnh</th>
                                    <th>Số lượng truyện</th>
                                    <th>Chủ đề</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Tên tác giả</th>
                                    <th>Đường dẫn tĩnh</th>
                                    <th>Số lượng truyện</th>
                                    <th>Chủ đề</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(item, index) in items">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ item.name }}</td>
                                    <td>@{{ item.slug }}</td>
                                    <td>@{{ item.story_count }}</td>
                                    <td>@{{ item.type_name }}</td>
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
                    <legend v-if="itemDetail.id" class="text-primary">Cập nhật thông tin tag</legend>
                    <legend v-else class="text-primary">Thêm tag mới</legend>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Quản lý tag</label>
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

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Chủ đề</label>
                                <select v-model="itemDetail.type" class="form-control"
                                    :class={'is-invalid':errors.group_id}>
                                    @foreach ($categoryType as $item)
                                        <option value="{{ $item['key'] }}">{{ $item['value'] }}</option>
                                    @endforeach
                                </select>
                                <div v-if="errors.name" class="invalid-feedback">@{{ errors.type }}</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="">Thông tin chi tiết về Tag</label>
                                <fvn-text-editor v-model="itemDetail.description"
                                    label="Giới thiệu về tác giả"></fvn-text-editor>
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

    <script src="{{ asset('backend/js/manager_category.js?version=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection


@section('scripts')
@endsection
