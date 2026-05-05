
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
              
            </div>
            <div class="row mt-4">
                
                <div class="col-2">
                    <input v-model="querySearch.keyword" type="text" class="form-control" placeholder="Search...">
                </div>
                <div class="col-2">
                    <input v-model="querySearch.user_id" type="number" class="form-control" placeholder="user ID...">
                </div>
                <div class="col-2">
                    <input v-model="querySearch.story_id" type="number" class="form-control" placeholder="Story ID...">
                </div>
                <div class="col-2">
                    <input v-model="querySearch.chapter_id" type="number" class="form-control" placeholder="Chapter ID...">
                </div>
             
                <div class="col-2">
                    <button @click="searchItem" class="btn btn-success">Fillter</button>
                    <button @click="clearFilter" class="btn btn-danger">Clear</button>
                </div>
            </div>
            <div class="card shadow mb-4 mt-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quản Lý Đơn Hàng Chương Truyện</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- <div class="alert alert-success">Message</div> --}}
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Người mua</th>
                                    <th>Truyện đã mua</th>
                                    <th>Chương đã mua</th>
                                    <th>Giá mua</th>
                                    <th>
                                        <a  @click="orderBy('created_at')" class="link-offset-1">
                                            Thời gian mua
                                            <i v-if="isOrder('created_at', 'ASC')" class="fa-solid fa-sort-up"></i>
                                            <i v-if="isOrder('created_at', 'DESC')" class="fa-solid fa-sort-down"></i>
                                        </a>
                                    </th>
                                    <th>Chi tiết</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Người mua</th>
                                    <th>Truyện đã mua</th>
                                    <th>Chương đã mua</th>
                                    <th>Giá mua</th>
                                    <th>Thời gian mua</th>
                                    <th>Chi tiết</th>
                                    <th>Xóa</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(item, index) in items">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ item.user_name }} (ID: @{{ item.user_id }})</td>
                                    <td>
                                        <a :href="item.url_story" target="_blank">@{{ item.story_title }} (ID: @{{ item.story_id }})</a>
                                    </td>
                                    <td>
                                        <a :href="item.url_chapter" target="_blank">@{{ item.chapter_title }} (ID: @{{ item.chapter_id }})</a>
                                    </td>
                                    <td>@{{ item.money }} LT</td>
                                    <td>@{{ displayDate(item.created_at, true) }}</td>
                                    <td><a @click="showItem(item)" class="btn btn-warning">Chi tiết</a></td>
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
                <div >
                    <legend class="text-primary">Chi tiết hóa đơn (ID: @{{ itemDetail.id }})</legend>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Tên người mua</label>
                                <div class="form-control">@{{ itemDetail.user_name }} (ID: @{{ itemDetail.user_id }})</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Email người mua</label>
                                 <div class="form-control">@{{ itemDetail.user_email }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Số tiền mua chương</label>
                                <div class="form-control">@{{ itemDetail.money }} LT</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Tên truyện</label>
                                <div class="form-control">
                                     <a :href="itemDetail.url_story" target="_blank">@{{ itemDetail.story_title }} (ID: @{{ itemDetail.story_id }})</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Tên chương</label>
                                <div class="form-control">
                                    <a :href="itemDetail.url_chapter" target="_blank">@{{ itemDetail.chapter_title }} (ID: @{{ itemDetail.chapter_id }})</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Thời gian tạo giao dịch</label>
                                <div class="form-control">@{{ displayDate(itemDetail.created_at, true) }}</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button @click="closeItem" class="btn btn-danger">Đóng</button>
                        </div>
                    </div>
                </div>

            </div>
        </template>

    </div>

    <script src="{{ asset('backend/js/manager_order_chapter.js?version=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection


@section('scripts')
@endsection
