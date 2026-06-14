<?php 
?>
@extends('layouts.backend')
@section('content')
    <script src="{{ asset('assets_global/js/vue.js') }}"></script>
    <script src="{{ asset('assets_global/js/routeapi.js') }}"></script>
    <script src="{{ asset('assets_global/js/vue-input.js') }}"></script>
    @include('parts.template.importQuilleditor')
    <script src="{{ asset('assets_global/js/vue-multiselect.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets_global/css/vue-multiselect.min.css') }}">
    <script>
        var story = <?= json_encode($story) ?>;
    </script>
    <div id="app">
        <template v-if="screen=='list'">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">{{ $page_title }}</h1>
                {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
            </div>
            <a v-if="backUrl" :href="backUrl" class="btn btn-danger">Quay lại</a>
            <a @click="save" class="btn btn-primary">Tạo audio hàng loạt</a>

            <div class="row mt-4">
           
                <div class="col-2">
                    <input v-model="querySearch.id" type="number" min="1" class="form-control" placeholder="ID...">
                </div>
                <div class="col-2">
                    <input v-model="querySearch.keyword" type="text" class="form-control" placeholder="Search...">
                </div>
                <div class="col-2">
                    <button @click="searchItem" class="btn btn-success">Fillter</button>
                    <button @click="clearFilter" class="btn btn-danger">Clear</button>

                </div>
            </div>
            <div class="card shadow mb-4 mt-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Truyện: @{{story.title}} -
                        Số chương: @{{story.total_chapter}} -
                        Số lượt nghe: @{{story.listen_count}}
x
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- <div class="alert alert-success">Message</div> --}}
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Chương</th>
                                    <th>
                                        <a  @click="orderBy('content_length')" class="link-offset-1">
                                            Số từ trong chương
                                            <i v-if="isOrder('content_length', 'ASC')" class="fa-solid fa-sort-up"></i>
                                            <i v-if="isOrder('content_length', 'DESC')" class="fa-solid fa-sort-down"></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a  @click="orderBy('position')" class="link-offset-1">
                                            Vị trí
                                            <i v-if="isOrder('position', 'ASC')" class="fa-solid fa-sort-up"></i>
                                            <i v-if="isOrder('position', 'DESC')" class="fa-solid fa-sort-down"></i>
                                        </a>
                                    </th>
                                    <th>
                                        Số lượt nghe
                                    </th>
                                    <th>
                                        Trạng thái
                                    </th>
                                    <th>
                                        Cập nhật
                                    </th>
                                    <th>Giá bán</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Chương</th>
                                    <th>Số từ trong chương</th>
                                    <th>Vị trí</th>
                                    <th>Số lượt nghe</th>
                                    <th>Trạng thái</th>
                                    <th>Cập nhật</th>
                                    <th>Giá bán</th>
                                    <th>Hành động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(item, index) in items">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ item.name }}</td>
                                    <td>@{{ item.content_length }}</td>
                                    <td>@{{ item.position }}</td>
                                    <td>@{{ item.listen_count }}</td>
                                    <td>@{{ item.status_text }}</td>
                                    <td>@{{ displayDate(item.updated_at) }}</td>
                                    <td>@{{ item.money }}</td>
                                    <td>
                                        <a @click="showItem(item)" class="btn btn-warning">Cập nhật</a>
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

    </div>
    
    <script src="{{ asset('backend/js/manager_audio_chapers.js?version=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection


@section('scripts')
@endsection
