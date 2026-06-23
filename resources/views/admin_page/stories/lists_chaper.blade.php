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
            <a @click="changeScreen('detail')" class="btn btn-primary">Thêm mới</a>
            <a @click="changeScreen('destroy')" class="btn btn-danger">
                <span v-if="position.screen">Đóng chức năng</span>
                <span v-else>Xóa theo vị trí</span>
            </a>
            <a @click="changeScreen('import')" class="btn btn-success" title="Thêm các chương truyện bằng file word">Import Chapter</a>
            <a @click="handleContentLength" class="btn btn-success" title="tính toán lại số lượng từ trong mỗi chương truyện">Content Length</a>
            <a @click="changeScreen('replace')" class="btn btn-success" title="Thay thế nội dung trong các chương truyện">Replace Content</a>
            <a @click="handleFreeFullChapter" class="btn btn-success" title="Tự động tạo chương truyện miễn phí">Free Full Chapter</a>
            
           <template v-if="position.screen">
            <div>
                <legend class="text-danger">Xóa theo vị trí</legend>
                <div class="row">
                    <div class="col-3">
                        <label for="">Từ (để 0 là vị trí thứ 1)</label>
                        <input v-model="position.start" type="number" class="form-control" min="0" />
                    </div>
                    <div class="col-3">
                        <label for="">Đến (dể 0 là vị trí cuối cùng)</label>
                        <input v-model="position.end" type="number" class="form-control" min="0" />
                    </div>
                    <div class="col-6 d-flex align-items-end">
                        <button type="submit" @click="deleteAllItem" class="btn btn-danger">Xóa</button>
                    </div>
                </div>
            </div>
        </template>
            <div class="row mt-4">
           
                <div class="col-2">
                    <input v-model="querySearch.id" type="number" min="1" class="form-control" placeholder="ID...">
                </div>
                <div class="col-2">
                    <input v-model="querySearch.keyword" type="text" class="form-control" placeholder="Search...">
                </div>
                <div class="col-2">
                    <input v-model="querySearch.content" type="text" class="form-control" placeholder="Nội dung chương truyện...">
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
                        Số lượt xem: @{{story.view_count}}


                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- <div class="alert alert-success">Message</div> --}}
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
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
                                        <a  @click="orderBy('view')" class="link-offset-1">
                                            Số lượt xem
                                            <i v-if="isOrder('view', 'ASC')" class="fa-solid fa-sort-up"></i>
                                            <i v-if="isOrder('view', 'DESC')" class="fa-solid fa-sort-down"></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a  @click="orderBy('updated_at')" class="link-offset-1">
                                            Cập nhật gần đây nhất
                                            <i v-if="isOrder('updated_at', 'ASC')" class="fa-solid fa-sort-up"></i>
                                            <i v-if="isOrder('updated_at', 'DESC')" class="fa-solid fa-sort-down"></i>
                                        </a>
                                    </th>
                                    <th>Giá bán</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>Chương</th>
                                    <th>Số từ trong chương</th>
                                    <th>Vị trí</th>
                                    <th>Số lượt xem</th>
                                    <th>Cập nhật gần đây nhất</th>
                                    <th>Giá bán</th>
                                    <th>Hành động</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(item, index) in items">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ item.id }}</td>
                                    <td>@{{ item.name }}</td>
                                    <td>@{{ item.content_length }}</td>
                                    <td>@{{ item.position }}</td>
                                    <td>@{{ item.view }}</td>
                                    <td>@{{ displayDate(item.updated_at) }}</td>
                                    <td>@{{ item.money }}</td>
                                    <td>
                                        <a @click="showItem(item)" class="btn btn-warning">Sửa</a>
                                        <a @click="deleteItem(item)" class="btn btn-danger mt-1">Xóa</a>
                                        <a @click="handlePositionPlusChapter($event, item)" class="btn btn-success mt-1">Position</a>

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
                    <legend v-if="itemDetail.id" class="text-primary">Cập nhật chương mới</legend>
                    <legend v-else class="text-primary">Thêm chương mới</legend>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Thông tin chương</label>
                                <input type="text" v-model="itemDetail.name" class="form-control"
                                    :class={'is-invalid':errors.name} placeholder="Thông tin chương truyện...">
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
                                <label for="">Vị trí chương truyện</label>
                                <input type="number" min="1" v-model="itemDetail.position" class="form-control"
                                    :class={'is-invalid':errors.position} placeholder="Vị trí...">
                                <div v-if="errors.position" class="invalid-feedback">@{{ errors.position[0] }}</div>
                            </div>
                        </div>

                         <div class="col-6">
                            <div class="mb-3">
                                <label for="">Giá bán (linh thạch)</label>
                                <input type="number" min="0" v-model="itemDetail.money" class="form-control"
                                    :class={'is-invalid':errors.money} placeholder="Giá bán...">
                                <div v-if="errors.money" class="invalid-feedback">@{{ errors.money[0] }}</div>
                            </div>
                        </div>
    
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="">Nội dung chương truyện - Số ký tự: @{{countContent}}</label>
                                <fvn-text-editor v-model="itemDetail.content" label="Nội dung chương truyện" :class={'is-invalid':errors.content} ></fvn-text-editor>
                                <div v-if="errors.content" class="invalid-feedback">@{{ errors.content[0] }}</div>
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

        <template v-if="screen=='import'">
            <div>
                <form @submit="handleUploadChapter">
                    <legend class="text-primary">Import chương mới</legend>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <input type="file" class="form-control" @change="uploadFile($event, 'fvn_file_word')" accept=".doc, .docx" multiple />
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Upload</button>
                            <button @click="screen = 'list'" class="btn btn-danger">Quay lại</button>
                        </div>
                    </div>
                </form>
            </div>
        </template>



        <template v-if="screen=='replace'">
            <div>
                <form @submit="addReplaceContent">
                    <legend class="text-primary">Thêm từ khóa (Cẩn thận việc lựa chọn từ khóa thay thế không dẫn đến tình trạng thay thế những từ khóa không mong muốn)</legend>
                    <div class="row">
                 
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Nội dung cũ</label>
                                <input type="text" v-model="replaceContentDetail.old_content" class="form-control"
                                    :class={'is-invalid':errors.old_content} placeholder="Nội dung cũ...">
                                <div v-if="errors.old_content" class="invalid-feedback">@{{ errors.old_content[0] }}</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Nội dung mới</label>
                                <input type="text" v-model="replaceContentDetail.new_content" class="form-control"
                                    :class={'is-invalid':errors.new_content} placeholder="Nội dung mới...">
                                <div v-if="errors.new_content" class="invalid-feedback">@{{ errors.new_content[0] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Thêm Mới</button>
                        <button @click="screen = 'list'" class="btn btn-danger">Quay lại</button>
                    </div>
                </form>

                <div class="card-body">
                    <div class="table-responsive">
                        <h3 class="m-0 font-weight-bold text-primary">Truyện: @{{story.title}}</h3>
                        <button type="button" class="btn btn-success m-4" @click="handleReplaceContent">Thực hiện chức năng thay đổi nội dung toàn bộ các chương truyện</button>
                        <div v-if="resultReplaceContent.total_affected > 0" class="mb-2 text-bg-success p-4">Có @{{ resultReplaceContent.total_affected }} chương bị thay đổi ID: @{{ resultReplaceContent.affected_chapters.join(', ') }}</div>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>ID</th>
                                    <th>
                                        Từ khóa cũ
                                    </th>
                                    <th>
                                       Từ khóa mới
                                    </th>
                                   
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in replaceContentItems">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ item.id }}</td>
                                    <td>"@{{ item.old_content }}"</td>
                                    <td>"@{{ item.new_content }}"</td>
                                    <td>
                                        <a @click="deleteReplaceContent(item)" class="btn btn-danger mt-1">Xóa</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </template>

    </div>
    
    <script src="{{ asset('backend/js/manager_chapers.js?version=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection


@section('scripts')
@endsection
