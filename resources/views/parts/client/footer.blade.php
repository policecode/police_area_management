<?php
use App\Http\Helpers\SettingHelpers;
$option = SettingHelpers::getInstance();
$all_categories = get_all_categories();
?>
<div id="footer" class="footer border-top pt-2">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-5">
                <a title="Đọc truyện online" class="text-dark text-decoration-none" href="{{ route('index') }}"><strong>{{$option->getOptionValue('fvn_web_title')}}</strong></a> - {{$option->getOptionValue('fvn_content_bottom')}}
            </div>
            <ul class="col-12 col-md-7 list-unstyled d-flex flex-wrap list-tag">
                @foreach ($all_categories as $key => $cat)
                    <li class="me-1">
                        <span class="badge text-bg-light">
                            <a class="text-dark text-decoration-none" href="{{ route('client.tag', ['tag_slug' => $cat['slug']]) }}" title="{{ $cat['name'] }}">{{ $cat['name'] }}</a>
                        </span>
                    </li>
                @endforeach
            </ul>

            <div class="col-12"> <a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img
                        alt="Creative Commons License" style="border-width:0;margin-bottom: 10px"
                        src="{{ asset('assets/images/88x31.png') }}"></a><br>
                <p>Website hoạt động dưới Giấy phép truy cập mở <a rel="license"
                        class="text-decoration-none text-dark hover-title"
                        href="http://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0
                        International License</a></p>
            </div>
        </div>
    </div>
</div>
