@extends('layouts.profile')
<?php
use Illuminate\Support\Facades\Auth;
use App\Enums\Gender;
$user = Auth::user();
$genderoptions = Gender::getValues();

?>
@section('head')
    <meta name="robots" content="none" />
    <meta name="googlebot" content="none">
@endsection
@section('content')
    <div id="member_profile_detail_app" class="main-content py-2">
        <div class="my-2 bg-white shadow-[0_0_1px_rgba(0,0,0,.13)] min-h-[83vh]">
            <div class="flex flex-wrap">
                <div class="basis-full xl:basis-1/2 xl:order-2">
                    <div
                        class="box-upload-image-cover bg-cover relative h-[245px] overflow-hidden img-h-full img_full img-cover">
                        <img class="image-cover-preview" :src="user.banner_url" alt="Ảnh bìa người dùng">
                        <div class="edit-user-cover-image text-center">
                            <label class="btn-change-image-cover" for="ip-upload-image-cover">
                                <i class="fa-solid fa-camera-retro"></i>
                            </label>
                            <button @click="saveImage($event, 'banner')" class="btn-upload-image-cover"
                                :class="{ 'show': files.banner }" data-action="upload-image-cover">Xác nhận</button>
                            <input @change="uploadFile($event, 'banner')" type="file" id="ip-upload-image-cover"
                                class="hidden ip-upload-image-cover" accept="image/*">
                        </div>
                    </div>
                    <div class="box-upload-image-wapper w-[148px] xl:w-[200px] xl:-mt-[100px] -mt-[74px] mx-auto">
                        <div class="box-upload-image">
                            <label
                                class="box-preview-image rounded-full w-full mx-auto overflow-hidden border border-solid border-[#ccc]"
                                for="upload-avatar">
                                <div class="c-img pt-[100%]">
                                    <img class="image-preview" :src="user.avatar_url">
                                </div>
                            </label>
                            <button @click="saveImage($event, 'avatar')" class="btn-upload-image"
                                :class="{ 'show': files.avatar }">Lưu ảnh</button>
                            <label class="btn-change-image" for="upload-avatar">
                                <i class="fa-solid fa-camera-retro"></i>
                            </label>
                            <input @change="uploadFile($event, 'avatar')" type="file" id="upload-avatar"
                                class="ip-image-upload" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="basis-full xl:basis-1/2 p-2">
                    <p class="card-head py-2 px-4 text-[0.875rem] border-b-[1px] border-solid border-[rgba(0,0,0,.125)]">
                        <i class="fa-solid fa-user mr-1"></i> Lai lịch
                    </p>
                    <form method="POST" class="form-edit formValidation p-4" accept-charset="utf8" absolute>
                        <p class="font-bold mb-3 text-[0.875rem]">User ID: @{{ user.id }}</p>
                        <p class="font-bold mb-3 text-[0.875rem]">Danh tính: @{{ user.name }}</p>
                        <p class="font-bold mb-3 text-[0.875rem]">Chân nguyên: @{{ user.exp }}/@{{ user.level_info.next_exp }}</p>
                        <p class="font-bold mb-3 text-[0.875rem]">Tu vi: @{{ user.level_info.name }}</p>

                        {{-- <div class="flex items-center">
                            <span class="icon w-16 shrink-0 mr-2">
                                <img src="{{ asset('assets/images/linhthach-end.png') }}" alt="Linh Thạch">
                            </span>
                            <div class="block">
                                <span class="text-[0.875rem] font-bold block mb-3">Số dư: 0.00 Linh Thạch</span>
                                <span class="text-[0.875rem] font-bold block">Số dư : 0.00 Linh Thạch KM</span>
                            </div>
                        </div>
                        <div class="flex mb-2">
                            <span class="icon w-14 shrink-0 mr-2">
                                <img src="{{ asset('assets/images/5start-100x67.png') }}" alt="Linh Phiếu">
                            </span>
                            <span class="text-[0.875rem] font-bold">Linh Phiếu : 0</span>
                        </div>
                        <a href="javascript:void(0)" title="Chưa xây dựng tính năng này" class="btn btn-green !rounded mb-3">Thêm Linh Thạch</a> --}}

                        <p class="font-bold text-[0.875rem] mb-2">Email</p>
                        <input type="text" v-model="user.email" class="form-control w-full border border-solid border-[#ced4da] rounded mb-3 bg-[#ebebeb]" disabled>
                        <p class="font-bold text-[0.875rem] mb-2">Danh tính</p>
                        <input type="text" v-model="user.name" name="fullname" placeholder="Họ và tên" class="form-control w-full border border-solid border-[#ced4da] rounded mb-3">
                        <p v-if="errors.name" class="font-bold text-[0.875rem] text-[#dc3545] mb-4">@{{ errors.name[0] }}</p>

                        <p class="font-bold text-[0.875rem] mb-2">Âm Dương</p>
                        <select v-model="user.gender" class="form-control w-full border border-solid border-[#ced4da] rounded mb-3 py-[6px] px-3">
                            @foreach ($genderoptions as $item)
                                <option value="{{ $item['key'] }}">{{ $item['value'] }}</option>
                            @endforeach
                        </select>

                        <p class="font-bold text-[0.875rem] mb-2">Sinh thần</p>
                        <input v-model="user.date_of_birth" type="date" class="form-control w-full border border-solid border-[#ced4da] rounded mb-3">

                        <div class="bg-[rgba(0,0,0,.03)] py-3 px-5 rounded flex items-center change-pass text-[#4497f8] text-[0.875rem] mb-2">Đổi mật khẩu</div>
                        <p class="font-bold text-[0.875rem] mb-2">Mật khẩu mới</p>
                        <input type="password" v-model="user.password" placeholder="Mật khẩu" class="form-control w-full border border-solid border-[#ced4da] rounded mb-3">
                        <p v-if="errors.password" class="font-bold text-[0.875rem] text-[#dc3545] mb-4">@{{ errors.password[0] }}</p>

                        <p class="font-bold text-[0.875rem] mb-2">Nhập lại Mật khẩu mới</p>
                        <input type="password" v-model="user.password_confirmation" placeholder="Mật khẩu" class="form-control w-full border border-solid border-[#ced4da] rounded mb-3">
                        <p v-if="errors.password_confirmation" class="font-bold text-[0.875rem] text-[#dc3545] mb-4">@{{ errors.password_confirmation[0] }}</p>

                        <div class="bg-[rgba(0,0,0,.03)] py-3 px-5 rounded flex items-center">
                            <button @click="save" type="button" class="btn btn-border-green !rounded">Lưu lại</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var vue_member_profile_detail_app = {
            loading: false,
            show_navbar: false,
            user: {{ Illuminate\Support\Js::from($user) }},
            files: {
                avatar: null,
                banner: null,
            },
            errors: {},
            apiUrl: FVN_LARAVEL_HOME + '/api/member',
        };
        var appMemberProfileDetail = new Vue({
            el: '#member_profile_detail_app',
            data: vue_member_profile_detail_app,
            mounted: function() {
                // this.changeThemes();

            },
            computed: {},
            methods: {
                async uploadFile(e, name) {

                    let files = e.target.files || e.dataTransfer.files;
                    if (!files.length) return;
                    let file = files[0];
                    if (file.size > 1 * 1024 * 1024) {
                        jAlertCLient('File không được lớn hơn 1MB', 'danger');
                        return;
                    }

                    let reader = new FileReader();
                    if (name == 'banner') {
                        this.files.banner = file;

                        await reader.readAsDataURL(file);
                        reader.onload = function() {
                            // console.log(reader.result);
                            appMemberProfileDetail.user.banner_url = reader.result;
                        }
                    }
                    if (name == 'avatar') {
                        this.files.avatar = file;

                        await reader.readAsDataURL(file);
                        reader.onload = function() {
                            appMemberProfileDetail.user.avatar_url = reader.result;
                        }
                    }
                },

                async saveImage(e, action) {
                    e.preventDefault()
                    var data = new FormData();
                    if (action == 'avatar') {
                        data.append('avatar', this.files.avatar);
                    }
                    if (action == 'banner') {
                        data.append('banner', this.files.banner);
                    }
                    this.loading = true;
                    let jsonData = await new RouteApi().post(`${this.apiUrl}/upload-action/${action}`,
                        data, 'form')

                    this.loading = false;

                    if (jsonData.status) {
                        jAlertCLient(jsonData.message, 'success');
                        this.files = {
                            avatar: null,
                            banner: null,
                        };
                    } else {
                        jAlertCLient(jsonData.message, 'danger');
                    }
                },

                async save() {
                    this.loading = true;
                    let jsonData = await new RouteApi().post(`${this.apiUrl}/update-profile`, this.user)
                    this.loading = false;
                    if (jsonData.status) {
                        this.errors = {};
                        this.user.password = '';
                        this.user.password_confirmation = '';
                        jAlertCLient(jsonData.message, 'success');
                    } else {
                        this.errors = jsonData.errors || {};
                        jAlertCLient(jsonData.message, 'danger');
                    }
                },
            },
            watch: {
                'show_navbar'(newVal) {
                    const element = document.querySelector('.main-content__admin');
                    if (newVal) {
                        element.classList.add('hidden_');
                    } else {
                        element.classList.remove('hidden_');
                    }
                }
            },
        });
    </script>
@endsection

@section('scripts')
@endsection
