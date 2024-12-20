<?php

?>
@extends('layouts.backend')
@section('content')
    <script src="{{ asset('assets_global/js/vue.js') }}"></script>
    <script src="{{ asset('assets_global/js/routeapi.js') }}"></script>
    <script src="{{ asset('assets_global/js/vue-input.js') }}"></script>
    @include('parts.template.importQuilleditor')
    <script>
        var options = {{ Illuminate\Support\Js::from($options) }};

    </script>
    <div id="app">
        <div>
            <form @submit="save($event, 'page-one')">
                <legend class="text-primary">{{ $page_title }}</legend>
                <table class="table table-success table-bordered">
                    <tbody>
                        <tr>
                            <th width="20%">Shortcut Icon</th>
                            <td>
                                <div class="row">
                                    <div class="input-group col-9">
                                        <input type="file" @change="uploadFile($event, 'fvn_shortcut_icon')" class="form-control"
                                        accept=".ico">
                                    </div>
                                    <div class="col-3">
                                        <img v-if="images.fvn_shortcut_icon" :src="images.fvn_shortcut_icon" class="rounded mx-auto d-block w-25" alt="Image Shortcut icon" />
                                        <img v-else-if="itemDetail.fvn_shortcut_icon" :src="getUrlUmages(itemDetail.fvn_shortcut_icon)" class="rounded mx-auto d-block w-25" alt="Image Shortcut icon" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th width="20%">Logo</th>
                            <td>
                                <div class="row">
                                    <div class="input-group col-9">
                                        <input type="file" @change="uploadFile($event, 'fvn_logo')" class="form-control"
                                        accept=".png">
                                    </div>
                                    <div class="col-3">
                                        <img v-if="images.fvn_logo" :src="images.fvn_logo" class="rounded mx-auto d-block w-25" alt="Logo page" />
                                        <img v-else-if="itemDetail.fvn_logo" :src="getUrlUmages(itemDetail.fvn_logo)" class="rounded mx-auto d-block w-25" alt="Logo page" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Web title</th>
                            <td>
                                <input type="text" v-model="itemDetail.fvn_web_title" class="form-control"
                                    :class={'is-invalid':errors.title} placeholder="Nội dung title cuar trang web...">
                            </td>
                        </tr>
                        <tr>
                            <th>Content top</th>
                            <td>
                                <fvn-text-editor v-model="itemDetail.fvn_content_top" label="Nội dung giới thiệu trên header..." class="bg-light"></fvn-text-editor>
                            </td>
                        </tr>
                        <tr>
                            <th>Content bottom</th>
                            <td>
                                <fvn-text-editor v-model="itemDetail.fvn_content_bottom" label="Nội dung giới thiệu ở cuối trang web..." class="bg-light"></fvn-text-editor>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <td colspan="2">
                            <button type="submit" class="btn btn-success">Lưu lại</button>
                        </td>
                    </tfoot>
                </table>
       
            </form>

        </div>
        <div v-if="loading"
            class="position-fixed top-0 start-0 end-0 bottom-0 d-flex justify-content-center align-items-center"
            style="z-index: 9999; background-color: rgb(0 0 0 / 50%);">
            <div class="spinner-border text-success" role="status" style="width: 5rem; height: 5rem;">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

    </div>

    <script src="{{ asset('backend/js/manager_settings.js?version=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection


@section('scripts')
@endsection
