@extends('layouts.profile')
<?php
use Illuminate\Support\Facades\Auth;
use App\Enums\Gender;
use App\Enums\MoneyToCoint;

$user = Auth::user();
$moneyToCoint = MoneyToCoint::getValues();

?>
@section('head')
    <meta name="robots" content="none" />
    <meta name="googlebot" content="none">
@endsection
@section('content')
    <div id="member_profile_payment_app" class="main-content py-2 ">
        <div class="my-2 shadow-[0_0_1px_rgba(0,0,0,.13)] min-h-[83vh]">
            <div class="bg-white p-2 shadow-[0_0_1px_rgba(0,0,0,.13)] border border-solid border-[rgba(0,0,0,.125)]">
                <p class="head p-2 border-b-[1px] border-solid border-[rgba(0,0,0,.125)] mb-2">
                    Nạp LT qua Chuyển Khoản Ngân Hàng
                </p>
                {{-- Chọn mệnh giá nạp Start --}}
                <div v-if="show_navbar== 'step1'" class="box-payment-content-result">
                    <form @submit="getQrcode" class="form-send-payment-request" method="post" accept-charset="utf8">
                       
                        <p class="text-[1.25rem] font-semibold text-center mb-2">Chọn gói LT</p>
                        <ul class="value-card flex justify-center flex-wrap">
                            @foreach ($moneyToCoint as $item)
                                <li class="mr-2 mb-2">
                                    <label>
                                        <div
                                            class="block text-center w-[200px] p-3 !pb-1 rounded-lg border border-solid border-[#7c7c7c] text-[#46494f] hover:text-[#128c7e] hover:border-[#128c7e] cursor-pointer">
                                            <p class="font-bold text-[1.125rem]">
                                                {{ $item['display'] }}
                                            </p>
                                            <hr class="h-[1px] w-[80%] bg-[#46494f] my-1 mx-auto">
                                            <p class="text-center text-[0.875rem] mb-2">Giá quy đổi:
                                                {{ currency_format($item['money']) }}</p>
                                            <input v-model="payments.amount_key" type="radio" name="point_package" class="cursor-pointer"
                                                value="{{ $item['key'] }}">
                                        </div>
                                    </label>
                                </li>
                            @endforeach

                        </ul>

                        <div class="text-center my-4">
                            <button type="submit" class="btn btn-border-green !rounded bg-white">Thêm Linh Thạch</button>
                        </div>
                    </form>
                </div>
                {{-- Chọn mệnh giá nạp Start --}}

                {{-- Chuyển khoản chờ hoàn thành giao dịch Start --}}
                <div v-if="show_navbar== 'step2'" class="box-payment-content-result">
                    <div class="shadow-[2px_2px_9px_2px_rgba(0,0,0,.13)] p-3 rounded max-w-[800px] mx-auto mb-4">
                        <p class="mb-2 text-[1.25rem] font-semibold">Bước 1: Thực hiện chuyển tiền</p>
                        <div class="main-table-horizontal">
                            <table class="w-full text-left">
                                <tbody>
                                    <tr>
                                        <th>Ngân Hàng</th>
                                        <td>@{{payment_data?.bank}}</td>
                                    </tr>
                                    <tr>
                                        <th>Chủ tài khoản</th>
                                        <td>@{{payment_data?.acc_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Số tài khoản</th>
                                        <td>
                                            <div class="btn-copy-text-info cursor-pointer text-[1.125rem] hover:text-[#128c7e]">
                                                <span class="text-[#128c7e] font-semibold">@{{payment_data?.acc_number}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Số tiền</th>
                                        <td>
                                            <div class="btn-copy-text-info cursor-pointer text-[1.125rem] hover:text-[#128c7e]">
                                                <span class="text-[#128c7e] font-semibold">@{{payment_data?.amount}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Mã giao dịch</th>
                                        <td>
                                            <div class="btn-copy-text-info cursor-pointer text-[1.125rem] hover:text-[#128c7e]">
                                                <span class="text-[#128c7e] font-semibold">@{{payment_data?.code}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <p class="">
                            <img class="max-w-[300px] mx-auto"
                                :src="payment_data?.qr_code"
                                alt="VietQR Bank transfer">
                        </p>
                        <p class="text-center text-[0.875rem] text-[#6b7280]">
                            Thời gian còn lại: <span class="font-bold">@{{ Math.floor(countdown / 60) }}:@{{ countdown % 60 < 10 ? '0' + countdown % 60 : countdown % 60 }}</span>
                        </p>

                        <p class="mb-2 mt-4 text-[1.25rem] font-semibold">Bước 2: Chờ hệ thống cộng LT</p>
                        <div class="s-content">
                            <p>Xin nhập đúng mã giao dịch để được cộng Linh Thạch nhanh nhất có thể, bạn không cần nhập bất
                                cứ thứ gì khác ngoài mã giao dịch. Khi nạp xong hệ thống sẽ thông báo đến bạn trong vòng ít
                                phút.</p>
                            <p>Cảm ơn bạn rất nhiều!</p>
                        </div>
                    </div>
                </div>
                {{-- Chuyển khoản chờ hoàn thành giao dịch End --}}

                {{-- Trang thái giao dịch thành công Start --}}
                <div v-if="show_navbar== 'step3'" class="box-payment-content-result">
                    <div class="shadow-[2px_2px_9px_2px_rgba(0,0,0,.13)] p-3 rounded max-w-[800px] mx-auto mb-4">
                        <p class="mb-2 text-[1.25rem] font-semibold">Giao Dịch Thành Công</p>
                        <div class="main-table-horizontal">
                            <table class="w-full text-left">
                                <tbody>
                                    <tr>
                                        <th>Ngân Hàng</th>
                                        <td>@{{payment_data?.bank}}</td>
                                    </tr>
                                    <tr>
                                        <th>Chủ tài khoản</th>
                                        <td>@{{payment_data?.acc_name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Số tài khoản</th>
                                        <td>
                                            <div class="btn-copy-text-info cursor-pointer text-[1.125rem] hover:text-[#128c7e]">
                                                <span class="text-[#128c7e] font-semibold">@{{payment_data?.acc_number}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Số tiền</th>
                                        <td>
                                            <div class="btn-copy-text-info cursor-pointer text-[1.125rem] hover:text-[#128c7e]">
                                                <span class="text-[#128c7e] font-semibold">@{{payment_data?.amount}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Mã giao dịch</th>
                                        <td>
                                            <div class="btn-copy-text-info cursor-pointer text-[1.125rem] hover:text-[#128c7e]">
                                                <span class="text-[#128c7e] font-semibold">@{{payment_data?.code}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                     <tr>
                                        <th>Linh thạch nhận được</th>
                                        <td>
                                            <div class="btn-copy-text-info cursor-pointer text-[1.125rem] hover:text-[#128c7e]">
                                                <span class="text-[#128c7e] font-semibold">@{{payment_data?.money_web}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center my-4">
                            <button @click="show_navbar = 'step1'" type="button" class="btn btn-border-green !rounded bg-white">Thực hiện giao dịch khác</button>
                        </div>
                        
                    </div>
                </div>
                {{-- Trang thái giao dịch thành công End --}}
            </div>
        </div>
    </div>

    <script>
        var vue_member_payment_sepay = {
            loading: false,
            show_navbar: 'step1',
            user: {{ Illuminate\Support\Js::from($user) }},
            payments: {
                amount_key: 0,  
            },
            payment_data:{},
            errors: {},
            countdown: 900,
            intervalCountdown: null,
            pointInTime: null,
            apiUrl: FVN_LARAVEL_HOME + '/api/member',
        };
        var appMemberPaymentSePay = new Vue({
            el: '#member_profile_payment_app',
            data: vue_member_payment_sepay,
            mounted: function() {
                // this.changeThemes();

            },
            computed: {},
            methods: {
                async getQrcode(e) {
                    e.preventDefault();
                    this.loading = true;
                    let jsonData = await new RouteApi().post(`${this.apiUrl}/payment/qrcode`, this.payments)
                    this.loading = false;
                    if (jsonData.status) {
                        this.errors = {};
                        this.payment_data = jsonData;
                        this.show_navbar = 'step2';
                        // console.log(this.payment_data);
                        // jAlertCLient(jsonData.message, 'success');
                    } else {
                        this.errors = jsonData.errors || {};
                        jAlertCLient(jsonData.message, 'danger');
                    }
                },
            },
            watch: {
                'show_navbar'(newVal) {
                    if (newVal == 'step2') {
                        this.intervalCountdown = setInterval(() => {
                            if (this.countdown > 0) {
                                this.countdown--;
                            } else {
                                clearInterval(this.intervalCountdown);
                                clearInterval(this.pointInTime);
                                jAlertCLient('Giao dịch đã hết hạn, vui lòng thực hiện lại', 'danger');
                                this.show_navbar = 'step1';
                            }
                        }, 1000);
                        this.pointInTime = setInterval(async () => {
                            let jsonData = await new RouteApi().post(`${this.apiUrl}/payment/check-status`, {
                                code: this.payment_data.code,
                            });
                            // console.log(jsonData);
                            if (jsonData.status) {
                                if (jsonData.result.status == 2) {
                                    clearInterval(this.intervalCountdown);
                                    clearInterval(this.pointInTime);
                                    jAlertCLient('Giao dịch đã được xác nhận, LT đã được cộng vào tài khoản của bạn', 'success');
                                    this.show_navbar = 'step3';
                                    // setTimeout(() => {
                                    //     location.reload();
                                    // }, 2000);
                                }
    
                                if (jsonData.result.status == 3) {
                                    clearInterval(this.pointInTime);
                                    jAlertCLient('Giao dịch thất bại', 'danger');
                                    this.show_navbar = 'step1';
                                }
    
                                if (jsonData.result.status == 4) {
                                    clearInterval(this.pointInTime);
                                    jAlertCLient('Hủy giao dịch', 'danger');
                                    this.show_navbar = 'step1';
                                }
                                
                            } else {
                                    clearInterval(this.pointInTime);
                                    jAlertCLient('Hủy giao dịch', 'danger');
                                    jAlertCLient('Giao dịch không tồn tại', 'danger');
                                    this.show_navbar = 'step1';
                            }
                            
                        }, 5000);
                    } else {
                        clearInterval(this.pointInTime);   
                        
                    }
                },
                'payments.amount_key' (newVal) {
                    
                }
            },
        });
    </script>
@endsection

@section('scripts')
@endsection
