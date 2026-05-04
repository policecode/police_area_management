@extends('layouts.backend')
@section('content')
<script>
    var groups = {{ Illuminate\Support\Js::from($groups) }};
</script>
    <script src="{{ asset('assets_global/js/vue.js') }}"></script>
    <script src="{{ asset('assets_global/js/routeapi.js') }}"></script>
    <script src="{{ asset('assets_global/js/vue-input.js') }}"></script>
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
                                    <th>
                                        <a  @click="orderBy('name')" class="link-offset-1">
                                            Tên
                                            <i v-if="isOrder('name', 'ASC')" class="fa-solid fa-sort-up"></i>
                                            <i v-if="isOrder('name', 'DESC')" class="fa-solid fa-sort-down"></i>
                                        </a>
                                    </th>
                                    <th>Email</th>
                                    <th>Nhóm</th>
                                    <th>
                                        <a  @click="orderBy('money')" class="link-offset-1">
                                            Linh Thạch
                                            <i v-if="isOrder('money', 'ASC')" class="fa-solid fa-sort-up"></i>
                                            <i v-if="isOrder('money', 'DESC')" class="fa-solid fa-sort-down"></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a  @click="orderBy('created_at')" class="link-offset-1">
                                            Ngày tạo
                                            <i v-if="isOrder('created_at', 'ASC')" class="fa-solid fa-sort-up"></i>
                                            <i v-if="isOrder('created_at', 'DESC')" class="fa-solid fa-sort-down"></i>
                                        </a>
                                    </th>
                                    <th>
                                        <a  @click="orderBy('email_verified_at')" class="link-offset-1">
                                            Verified
                                            <i v-if="isOrder('email_verified_at', 'ASC')" class="fa-solid fa-sort-up"></i>
                                            <i v-if="isOrder('email_verified_at', 'DESC')" class="fa-solid fa-sort-down"></i>
                                        </a>
                                    </th>
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
                                    <th>Linh thạch</th>
                                    <th>Ngày tạo</th>
                                    <th>Verified</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(item, index) in items">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ item.name }}</td>
                                    <td>@{{ item.email }}</td>
                                    <td>@{{ item.group.name }}</td>
                                    <td>@{{ item.money }}</td>
                                    <td>@{{ displayDate(item.created_at) }}</td>
                                    <td>@{{ item.email_verified_at ? displayDate(item.email_verified_at) : 'Chưa xác thực' }}</td>
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
                    <legend v-if="itemDetail.id" v-else class="text-primary">Thêm người dùng mới</legend>
                    <legend v-else class="text-primary">Thêm người dùng mới</legend>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3 text-center">
                               <img :src="itemDetail.avatar_url" alt="Avatar" style=" max-height: 100px;">
                            </div>
                        </div>

                        <div class="col-6 text-center">
                            <div class="mb-3">
                               <img :src="itemDetail.banner_url" alt="Banner" style="max-height: 100px;">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Tên</label>
                                <input type="text" v-model="itemDetail.name" class="form-control"
                                    :class={'is-invalid':errors.name} placeholder="Tên...">
                                <div v-if="errors.name" class="invalid-feedback">@{{ errors.name[0] }}</div>
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Email</label>
                                <input type="text" v-model="itemDetail.email" class="form-control"
                                    :class={'is-invalid':errors.email} placeholder="Email...">
                                <div v-if="errors.name" class="invalid-feedback">@{{ errors.email[0] }}</div>
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Nhóm</label>
                                <select v-model="itemDetail.group_id" class="form-control"
                                    :class={'is-invalid':errors.group_id}>
                                    <option value="">Chọn nhóm</option>
                                    @foreach ($groups as $item)
                                        <option value="{{$item['id']}}">{{$item['name']}}</option>
                                    @endforeach
                                </select>
                                <div v-if="errors.name" class="invalid-feedback">@{{ errors.group_id[0] }}</div>
                            </div>
                        </div>
    
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Mật khẩu</label>
                                <input type="password" v-model="itemDetail.password" class="form-control"
                                    :class={'is-invalid':errors.password} placeholder="Mật khẩu...">
                                <div v-if="errors.password" class="invalid-feedback">@{{ errors.group_id[0] }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label>Ngày tạo</label>
                                <div class="alert alert-primary">@{{ displayDate(itemDetail.created_at, true) }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label>Email Verified</label>
                                <div class="alert alert-primary">@{{ displayDate(itemDetail.email_verified_at, true) }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label>Cảnh giới</label>
                                <div class="alert alert-primary">@{{ itemDetail.level_info.name }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label>Linh lực</label>
                                <div class="alert alert-primary">@{{ itemDetail.exp }}/@{{ itemDetail.level_info.next_exp }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label>Số bộ truyện đang đọc</label>
                                <div class="alert alert-primary">@{{ itemDetail.total_story }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label>Số chương truyện đã đọc</label>
                                <div class="alert alert-primary">@{{ itemDetail.total_chapter }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label>Linh thạch</label>
                                <div class="alert alert-primary">@{{ itemDetail.money }}</div>
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
    
    <script src="{{ asset('backend/js/manager_users.js?version=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection


@section('scripts')
@endsection
