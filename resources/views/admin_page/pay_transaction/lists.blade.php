<?php
use App\Enums\PaymentTransactionStatus;
$paymentTransactionStatus = PaymentTransactionStatus::asArray();

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
              
            </div>
            <div class="row mt-4">
                
                <div class="col-2">
                    <input v-model="querySearch.keyword" type="text" class="form-control" placeholder="Search...">
                </div>
                <div class="col-2">
                    <input v-model="querySearch.user_id" type="number" class="form-control" placeholder="user ID...">
                </div>
                <div class="col-2">
                    <select  v-model="querySearch.status" class="form-select">
                        <option value="" selected>Trạng thái</option>
                        @foreach ($paymentTransactionStatus as $key => $value)
                            <option value="{{ $value['key'] }}">{{ $value['display'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2">
                    <button @click="searchItem" class="btn btn-success">Fillter</button>
                    <button @click="clearFilter" class="btn btn-danger">Clear</button>
                </div>
            </div>
            <div class="card shadow mb-4 mt-2">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quản lý dòng tiền nạp vào trang web</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        {{-- <div class="alert alert-success">Message</div> --}}
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Tên người dùng</th>
                                    <th>Số tiền nạp</th>
                                    <th>Mã code</th>
                                    <th>Trạng thái</th>
                                    <th>
                                        <a  @click="orderBy('transaction_date')" class="link-offset-1">
                                            Thời gian giao dịch
                                            <i v-if="isOrder('transaction_date', 'ASC')" class="fa-solid fa-sort-up"></i>
                                            <i v-if="isOrder('transaction_date', 'DESC')" class="fa-solid fa-sort-down"></i>
                                        </a>
                                    </th>
                                    <th>Chi tiết</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Tên người dùng</th>
                                    <th>Số tiền nạp</th>
                                    <th>Mã code</th>
                                    <th>Trạng thái</th>
                                    <th>Thời gian giao dịch</th>
                                    <th>Chi tiết</th>
                                    <th>Xóa</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr v-for="(item, index) in items">
                                    <td>@{{ index + 1 }}</td>
                                    <td>@{{ item.name }} (ID: @{{ item.user_id }})</td>
                                    <td>@{{ formatMoney(item.amount) }}</td>
                                    <td>@{{ item.code }}</td>
                                    <td>@{{ item.status_name }}</td>
                                    <td>@{{ displayDate(item.transaction_date, true) }}</td>
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
                                <label for="">Tên người dùng</label>
                                <div class="form-control">@{{ itemDetail.name }} (ID: @{{ itemDetail.user_id }})</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Email người dùng</label>
                                 <div class="form-control">@{{ itemDetail.email }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Số tiền nạp</label>
                                <div class="form-control">@{{ formatMoney(itemDetail.amount) }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Code giao dịch</label>
                                <div class="form-control">@{{ itemDetail.code }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Số tiền nhận được trên web</label>
                                <div class="form-control">@{{ itemDetail.money_web }} LT</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Tài khoản nhận tiền</label>
                                <div class="form-control">@{{ itemDetail.account_number }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Tài khoản phụ</label>
                                <div class="form-control">@{{ itemDetail.sub_account }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Ngân hàng</label>
                                <div class="form-control">@{{ itemDetail.getway }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Trạng thái giao dịch</label>
                                <div class="form-control">@{{ itemDetail.status_name }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Mã giao dịch Sepay</label>
                                <div class="form-control">@{{ itemDetail.transactions_code }}</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="">Thời gian thực hiện giao dịch</label>
                                <div class="form-control">@{{ displayDate(itemDetail.transaction_date, true) }}</div>
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

    <script src="{{ asset('backend/js/manager_pay_transaction.js?version=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection


@section('scripts')
@endsection
