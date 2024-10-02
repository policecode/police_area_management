<?php 
use App\Enums\StatusStory;
?>
@extends('layouts.backend')
@section('content')
    <script src="{{ asset('assets/js/vue.js') }}"></script>
    <script src="{{ asset('assets/js/routeapi.js') }}"></script>
    <script src="{{ asset('assets/js/vue-input.js') }}"></script>
    @include('parts.template.importQuilleditor')
    <script src="{{ asset('assets/js/vue-multiselect.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/vue-multiselect.min.css') }}">
    <script>
        var statusStory = <?= json_encode(StatusStory::getValues()) ?>
    </script>
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
                    <select class="form-select">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>
                </div>
                <div class="col-3">
                    <input v-model="querySearch.keyword" type="text" class="form-control" placeholder="Search...">
                </div>
                <div class="col-1">
                    <button @click="searchItem" class="btn btn-success">Fillter</button>
                </div>
            </div>
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
                                    <th>Ảnh bìa</th>
                                    <th>Tên truyện</th>
                                    <th>Đường dẫn</th>
                                    <th>Số lượt xem</th>
                                    <th>Cập nhật gần đây nhất</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Ảnh bìa</th>
                                    <th>Tên truyện</th>
                                    <th>Đường dẫn</th>
                                    <th>Số lượt xem</th>
                                    <th>Cập nhật gần đây nhất</th>
                                    <th>Hành động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(item, index) in items">
                                    <td>@{{ index + 1 }}</td>
                                    <td><img :src="item.thumbnail" class="img-thumbnail w-75" /></td>
                                    <td>@{{ item.title }}</td>
                                    <td>@{{ item.slug }}</td>
                                    <td>@{{ item.view_count }}</td>
                                    <td>@{{ displayDate(item.updated_at) }}</td>
                                    <td>
                                        <a @click="showItem(item)" class="btn btn-warning">Sửa</a>
                                        <a @click="deleteItem(item)" class="btn btn-danger mt-1">Xóa</a>
                                        <a :href="linkChapers(item.id)" class="btn btn-success mt-1">Chapers</a>
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
        <template v-if="screen=='detail'">
            <div>
                <form @submit="save">
                    <legend v-if="itemDetail.id" class="text-primary">Thêm người dùng mới</legend>
                    <legend v-else class="text-primary">Thêm người dùng mới</legend>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Tên truyện</label>
                                <input type="text" v-model="itemDetail.title" class="form-control"
                                    :class={'is-invalid':errors.title} placeholder="Tên truyện...">
                                <div v-if="errors.title" class="invalid-feedback">@{{ errors.title[0] }}</div>
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
                                <label for="">Ảnh đại diện</label>
                                <div class="input-group mb-3">
                                    <input type="file" @change="uploadFile($event, 'thumbnail')" class="form-control" id="inputUploadThumbnail">
                                </div>
                                <img v-if="itemDetail.thumbnail" :src="itemDetail.thumbnail" class="rounded mx-auto d-block w-100" alt="Image thumbnail">
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Trạng thái truyện</label>
                                <select v-model="itemDetail.status" class="form-control"
                                    :class={'is-invalid':errors.status}>
                                    <option value="">Trạng thái truyện</option>
                                    <option v-for="item in statusStory" :value="item.key">@{{item.value}}</option>
                                </select>
                                <div v-if="errors.status" class="invalid-feedback">@{{ errors.status[0] }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Tác giả</label>
                                <multiselect v-model="selectedAuthor" :class={'is-invalid':errors.author_id} @search-change="getAuthors" :options="authors" :multiple="false" :close-on-select="true" :searchable="true" placeholder="Tìm kiếm tác giả" label="name" track-by="id" class="alignleft actions" :show-labels="false" :allow-empty="true"></multiselect> 
                                <div v-if="errors.author_id" class="invalid-feedback">@{{ errors.author_id[0] }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Thể loại</label>
                                <multiselect v-model="selectedCat" :options="categories" :multiple="true" :close-on-select="true" :searchable="true" placeholder="Thể loại" label="name" track-by="id" class="alignleft actions" :show-labels="false" :allow-empty="true" ></multiselect> 
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="">Giới thiệu truyện</label>
                                <fvn-text-editor v-model="itemDetail.description" label="Giới thiệu truyện"></fvn-text-editor>
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
    
    <script src="{{ asset('backend/js/manager_stories.js?version=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection


@section('scripts')
@endsection
