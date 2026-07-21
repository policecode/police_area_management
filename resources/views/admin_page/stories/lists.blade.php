<?php
use App\Enums\StatusStory;
use App\Enums\LockStories;
use App\Enums\ProposeStatus;


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
        var statusStory = {{ Illuminate\Support\Js::from(StatusStory::getValues()) }};
        var lockStories = {{ Illuminate\Support\Js::from(LockStories::getValues()) }};
        var proposeStatus = {{ Illuminate\Support\Js::from(ProposeStatus::getValues()) }};
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
                <div class="col-2">
                    <select v-model="querySearch.category_id" class="form-select">
                        <option value="">Thể loại</option>
                        <option v-for="(item, index) in categories" :value="item.id">@{{ item.name }}</option>
                    </select>
                </div>
                <div class="col-2">
                    <select v-model="querySearch.is_lock" class="form-select">
                        <option value="">Truyện bản quyền</option>
                        <option v-for="item in lockStories" :value="item.key">@{{ item.value }}</option>
                    </select>
                </div>
                <div class="col-2">
                    <select v-model="querySearch.propose" class="form-select">
                        <option value="">Đề xuất truyện</option>
                        <option v-for="item in proposeStatus" :value="item.key">@{{ item.value }}</option>
                    </select>
                </div>
                <div class="col-3">
                    <input v-model="querySearch.keyword" type="text" class="form-control" placeholder="Search...">
                </div>
                <div class="col-3">
                    <button @click="searchItem" class="btn btn-success">Fillter</button>
                    <button @click="clearFilter" class="btn btn-danger">Clear fillter</button>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-3">
                    <select v-model="actionList" class="form-select">
                        <option value="">Thực hiện hành động</option>
                        <option value="delete">Xóa</option>
                    </select>
                </div>
                <div class="col-3">
                    <button @click="handleActionList" class="btn btn-success">Action</button>
                </div>
            </div>
            <div class="card shadow mb-4 mt-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quản lý các bộ truyện</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- <div class="alert alert-success">Message</div> --}}
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" v-model="checkAll" value="1" />
                                    </th>
                                    <th>ID</th>
                                    <th>Ảnh bìa</th>
                                    <th>
                                        <a @click="orderBy('title')" class="link-offset-1">
                                            Tên truyện
                                            <i v-if="isOrder('title', 'ASC')" class="fa-solid fa-sort-up"></i>
                                            <i v-if="isOrder('title', 'DESC')" class="fa-solid fa-sort-down"></i>
                                        </a>

                                    </th>
                                    <th>Thể loại</th>
                                    <th>Tổng số chương</th>
                                    <th>
                                        <a @click="orderBy('view_count')" class="link-offset-1">
                                            Số lượt xem
                                            <i v-if="isOrder('view_count', 'ASC')" class="fa-solid fa-sort-up"></i>
                                            <i v-if="isOrder('view_count', 'DESC')" class="fa-solid fa-sort-down"></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a @click="orderBy('last_chapers')" class="link-offset-1">
                                            Chương cập nhật mới nhất
                                            <i v-if="isOrder('last_chapers', 'ASC')" class="fa-solid fa-sort-up"></i>
                                            <i v-if="isOrder('last_chapers', 'DESC')" class="fa-solid fa-sort-down"></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a @click="orderBy('updated_at')" class="link-offset-1">
                                            Cập nhật gần đây nhất
                                            <i v-if="isOrder('updated_at', 'ASC')" class="fa-solid fa-sort-up"></i>
                                            <i v-if="isOrder('updated_at', 'DESC')" class="fa-solid fa-sort-down"></i>
                                        </a>
                                    </th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th width="10%">Ảnh bìa</th>
                                    <th>Tên truyện</th>
                                    <th>Thể loại</th>
                                    <th>Tổng số chương</th>
                                    <th>Số lượt xem</th>
                                    <th>Chương cập nhật mới nhất</th>
                                    <th>Cập nhật gần đây nhất</th>
                                    <th>Hành động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(item, index) in items">
                                    <td>
                                        <input type="checkbox" v-model="listId" :value="item.id" />
                                    </td>
                                    <td>@{{ item.id }}</td>
                                    <td><img :src="item.thumbnail" class="img-thumbnail w-100" /></td>
                                    <td>
                                        <a :href="item.url" :title="item.url" target="_blank">@{{ item.title }}</a>
                                            <a :href="item.dev_url" target="_blank" title="Lấy text làm audio" style="font-size: 30px;">
                                                <i class="fa-brands fa-dev"></i>
                                            </a>
                                    </td>
                                    <td>
                                        <button v-for="(cat, t) in item.category_obj"
                                            class="btn btn-info btn-sm mr-2 mb-2">@{{ cat.name }}</button>
                                    </td>
                                    <td>@{{ item.total_chapter }}</td>
                                    <td>@{{ item.view_count }}</td>
                                    <td>@{{ displayDate(item.last_chapers) }}</td>
                                    <td>@{{ displayDate(item.updated_at) }}</td>
                                    <td>
                                        <a class="btn btn-primary mb-1"
                                            :title="item.is_lock == 2 ? 'Mở khóa truyện' : 'Khóa truyện'"
                                            @click="toggleLockStory($event, item)">
                                            <i v-if="item.is_lock == 2" class="fa-solid fa-lock"></i>
                                            <i v-else class="fa-solid fa-lock-open"></i>
                                        </a>
                                        <a :href="item.admin_chapter_url" class="btn btn-success mb-1"
                                            title="Danh sách các chương">
                                            <i class="fa-solid fa-book"></i>
                                        </a>
                                        <a :href="item.admin_chapter_audio_url" class="btn btn-info mb-1"
                                            title="Danh sách audio các chương">
                                            <i class="fa-solid fa-music"></i>
                                        </a>
                                        <a @click="showItem(item)" class="btn btn-warning mb-1" title="Sửa">
                                            <i class="fa-solid fa-wrench"></i>
                                        </a>
                                        <a @click="deleteItem(item)" class="btn btn-danger mb-1" title="Xóa">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </a>
                                        <a v-if="item.is_lock == 2" @click="showCoppyrightUser(item)"
                                            class="btn btn-secondary mb-1" title="Bản quyền">
                                            <i class="fa-regular fa-copyright"></i>
                                        </a>
                                        <a @click="togglePropose($event, item)"
                                            class="btn mb-1" :class="item.propose == 2 ? 'btn-info' : 'btn-outline-info'" :title="item.propose == 2 ? 'Đề Xuất' : 'Không Đề Xuất'">
                                            <i v-if="item.propose == 2" class="fa-solid fa-file-circle-check"></i>
                                            <i v-else class="fa-solid fa-file-circle-xmark"></i>
                                        </a>
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
        {{-- Form Thêm và sửa truyện Start --}}
        <template v-if="screen=='detail'">
            <div>
                <form @submit="save">
                    <legend v-if="itemDetail.id" class="text-primary">Cập nhật thông tin bộ truyện</legend>
                    <legend v-else class="text-primary">Thêm bộ truyện mới</legend>
                    <div class="row">
                        <template v-if="itemDetail.id">
                            <div class="col-6">
                               <div class="mb-3">
                                   <label for="">Số lượt xem:</label>
                                   <span>@{{itemDetail.view_count}}</span>
                                 
                               </div>
                           </div>
                           <div class="col-6">
                               <div class="mb-3">
                                   <label for="">Tổng số chương:</label>
                                   <span>@{{itemDetail.total_chapter}}</span>
                               </div>
                           </div>
                           <div class="col-6">
                               <div class="mb-3">
                                   <label for="">Số lượng comments:</label>
                                   <span>@{{itemDetail.total_comment}}</span>
                               </div>
                           </div>
                           <div class="col-6">
                               <div class="mb-3">
                                   <label for="">Số lượng comments:</label>
                                   <span>@{{itemDetail.total_comment}}</span>
                               </div>
                           </div>
                           <div class="col-6">
                               <div class="mb-3">
                                   <label for="">Số lượng người yêu thích:</label>
                                   <span>@{{itemDetail.total_favorite}}</span>
                               </div>
                           </div>
                           <div class="col-6">
                               <div class="mb-3">
                                   <label for="">Số tiền bộ truyện kiếm được:</label>
                                   <span>@{{itemDetail.total_money}}</span>
                               </div>
                           </div>

                        </template>
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
                            <div class="row mb-3">
                                <div class="col-8">
                                    <label for="">Ảnh đại diện</label>
                                    <div class="input-group mb-3">
                                        <input type="file" @change="uploadFile($event, 'thumbnail')"
                                            class="form-control" id="inputUploadThumbnail">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <img v-if="itemDetail.thumbnail" :src="itemDetail.thumbnail"
                                        class="rounded mx-auto d-block w-100" alt="Image thumbnail">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Trạng thái truyện</label>
                                <select v-model="itemDetail.status" class="form-control"
                                    :class={'is-invalid':errors.status}>
                                    <option value="">Trạng thái truyện</option>
                                    <option v-for="item in statusStory" :value="item.key">@{{ item.value }}
                                    </option>
                                </select>
                                <div v-if="errors.status" class="invalid-feedback">@{{ errors.status[0] }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Tác giả</label>
                                <multiselect v-model="selectedAuthor" :class={'is-invalid':errors.author_id}
                                    @search-change="getAuthors" :options="authors" :multiple="false"
                                    :close-on-select="true" :searchable="true" placeholder="Tìm kiếm tác giả"
                                    label="name" track-by="id" class="alignleft actions" :show-labels="false"
                                    :allow-empty="true"></multiselect>
                                <div v-if="errors.author_id" class="invalid-feedback">@{{ errors.author_id[0] }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Thể loại</label>
                                <multiselect v-model="selectedCat" :options="categories" :multiple="true"
                                    :close-on-select="true" :searchable="true" placeholder="Thể loại" label="name"
                                    track-by="id" class="alignleft actions" :show-labels="false"
                                    :allow-empty="true"></multiselect>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Mở Khóa Truyện</label>
                                <select v-model="itemDetail.is_lock" class="form-control"
                                    :class={'is-invalid':errors.is_lock}>
                                    <option v-for="item in lockStories" :value="item.key">@{{ item.value }}
                                    </option>
                                </select>
                                <div v-if="errors.is_lock" class="invalid-feedback">@{{ errors.is_lock[0] }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Đề xuất truyện</label>
                                <select v-model="itemDetail.propose" class="form-control"
                                    :class={'is-invalid':errors.propose}>
                                    <option v-for="item in proposeStatus" :value="item.key">@{{ item.value }}
                                    </option>
                                </select>
                                <div v-if="errors.propose" class="invalid-feedback">@{{ errors.propose[0] }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Số tiền mỗi chương truyện (Áp dụng dùng tool upload)</label>
                                <input type="number" v-model="itemDetail.buy_money" class="form-control" min="0"
                                    :class={'is-invalid':errors.buy_money} placeholder="Số tiền mỗi chương truyện...">
                                <div v-if="errors.buy_money" class="invalid-feedback">@{{ errors.buy_money[0] }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Vị trí bắt đầu khóa chương truyện (Áp dụng dùng tool upload)</label>
                                <input type="number" v-model="itemDetail.buy_position" class="form-control" min="0"
                                    :class={'is-invalid':errors.buy_position} placeholder="Vị trí bắt đầu khóa chương truyện...">
                                <div v-if="errors.buy_position" class="invalid-feedback">@{{ errors.buy_position[0] }}</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="">Giới thiệu truyện</label>
                                <fvn-text-editor v-model="itemDetail.description"
                                    label="Giới thiệu truyện"></fvn-text-editor>
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
        {{-- Form Thêm và sửa truyện End --}}

        {{-- Form phân quyền các bộ truyện bị khóa Start --}}
        <template v-if="screen=='role'">
 
            <div class="card shadow mb-4 mt-2">
                <div class="card-header py-3 d-flex justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Phân quyền đọc bộ truyện: @{{capitalizeFirstLetter(itemDetail.title)}}</h6>
                    <button @click="screen = 'list'" type="button" class="btn-close bg-danger" ></button>
                </div>
                <div class="card-body mb-4">
                    <div class="card-header py-3 bg-gradient-light d-flex align-items-center">
                        <div class="col-6">
                            <input v-model="keySearhUser" type="text" class="form-control" placeholder="Email hoặc biệt danh cần tìm kiếm">
                        </div>
                        <div class="col-6">
                            <h6 class="m-0 font-weight-bold text-center text-success">Kết quả tìm kiếm các tài khoản</h6>
                        </div>
                    </div>
                    <div v-if="loadingSearchUser" class="spinner-border text-success" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <div v-if="searchUserItems.length > 0" class="table-responsive">
                        {{-- <div class="alert alert-success">Message</div> --}}
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Danh tính</th>
                                    <th>Avatar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in searchUserItems">
                                    <td>@{{item.id}}</td>
                                    <td>@{{item.email}}</td>
                                    <td>@{{ item.name }}</td>
                                    <td width="10%"><img :src="item.avatar_url" class="img-thumbnail w-100" /></td>
                                    <td>
                                         <a @click="handleCoppyrightUser(item, 'add')" class="btn btn-success mb-1" title="Thêm">
                                            <i class="fa-solid fa-plus"></i>
                                        </a>
                                    </td>
                         
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-header py-3 bg-gradient-light d-flex align-items-center">
                        <h6 class="m-0 font-weight-bold text-center text-success">Các tài khoản có quyền truy cập bộ truyện</h6>
                    </div>
              
                    <div v-if="userItems.length > 0" class="table-responsive">
                        {{-- <div class="alert alert-success">Message</div> --}}
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Email</th>
                                    <th>Danh tính</th>
                                    <th>Avatar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in userItems">
                                    <td>@{{item.id}}</td>
                                    <td>@{{item.email}}</td>
                                    <td>@{{ item.name }}</td>
                                    <td width="10%"><img :src="item.avatar_url" class="img-thumbnail w-100" /></td>
                                    <td>
                                         <a @click="handleCoppyrightUser(item, 'remove')" class="btn btn-danger mb-1" title="Thêm">
                                            <i class="fa-regular fa-circle-xmark"></i>
                                        </a>
                                    </td>
                         
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <fvn-paging :page="getCoppyrightPaging.page" :per_page="getCoppyrightPaging.per_page" :total="getCoppyrightPaging.total"
                    @change-limit="changeCoppyrightLimit" @change-page="(page) => nextCoppyrightPage(page)"></fvn-paging>
            </div>
        </template>
        {{-- Form phân quyền các bộ truyện bị khóa End --}}

    </div>

    <script src="{{ asset('backend/js/manager_stories.js?version=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection


@section('scripts')
@endsection
