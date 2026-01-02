@extends('layouts.profile')
@section('head')
    <meta name="robots" content="none" />
    <meta name="googlebot" content="none">
@endsection
@section('content')
    <div class="main-content py-2 ">
        <div class="my-2 shadow-[0_0_1px_rgba(0,0,0,.13)] min-h-[83vh]">
            <div class="px-4">
                @include('member_profile.parts.profile_breadcrumb')

                <div class="bg-white shadow-[0_3px_8px_rgba(0,0,0,.15)] p-3 min-h-[76vh]">
                    <form action="" method="post"
                        class="flex justify-center pt-2 formValidation" accept-charset="utf8">
                        <input type="hidden" name="_token" value="IZ9J35NScIBOBv8Tn189M76IV9CJ1JYL376MQVyR"> <input
                            type="text" name="code" rules="required"
                            class="border border-[#ced4da] w-[200px] rounded h-[38px] !text-[16px]"
                            placeholder="Nhập Giftcode" m-required="Vui lòng Nhập Giftcode">
                        <button type="submit" class="btn btn-green !rounded ml-1 h-[38px] font-medium !text-[16px]">Áp
                            dụng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var vue_member_gilf_code_app = {
            showStar: false,

            apiMemberUrl: FVN_LARAVEL_HOME + '/api/member',
        };
        var appMemberGilfCode = new Vue({
            el: '#app_member_gilf_code',
            data: vue_member_gilf_code_app,
            mounted: function() {
                // console.log(this.itemDetail);

            },
            computed: {

            },
            methods: {

                async saveFavoriteStory(e, story_id) {
                    let jsonData = await new RouteApi().post(`${this.apiMemberUrl}/save-favorite-story`, {
                        story_id: story_id
                    });
                    if (jsonData.status) {
                        jAlertCLient(jsonData.message, 'success');
                        document.querySelector(`.item-favotite-story-${story_id}`).remove();
                    } else {
                        jAlertCLient(jsonData.message, 'danger');
                    }
                }
            },
            watch: {

            },
        });
    </script>
@endsection

@section('scripts')
@endsection
