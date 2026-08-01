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
                            <th width="20%" rowspan="3">Link in Chapter</th>
                            <td>
                                <input type="text" v-model="itemDetail.fvn_telegram_link" class="form-control"
                                    :class={'is-invalid':errors.fvn_telegram_link} placeholder="Link affiliate...">
                          
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="row">
                            
                                    <div class="input-group col-9">
                                        <input type="file" @change="uploadFile($event, 'fvn_logo')" class="form-control"
                                            accept=".png">
                                    </div>
                                    <div class="col-3">
                                        <img v-if="images.fvn_logo" :src="images.fvn_logo"
                                            class="rounded mx-auto d-block w-25" alt="Logo page" />
                                        <img v-else-if="itemDetail.fvn_logo" :src="getUrlUmages(itemDetail.fvn_logo)"
                                            class="rounded mx-auto d-block w-25" alt="Logo page" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <fvn-text-editor v-model="itemDetail.fvn_content_top" label="Giới thiệu về sản phẩm..." class="bg-light"></fvn-text-editor>
                            </td>
                        </tr>

                        {{-- <tr>
                            <th>Web title</th>
                            <td>
                                <input type="text" v-model="itemDetail.fvn_web_title" class="form-control"
                                    :class={'is-invalid':errors.fvn_web_title}
                                    placeholder="Nội dung title cuar trang web...">
                            </td>
                        </tr> --}}


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

    <script src="{{ asset('backend/js/manager_setting_affiliate.js?version=' . FVN_VERSION_LARAVEL) }}"></script>
@endsection


@section('scripts')
@endsection
