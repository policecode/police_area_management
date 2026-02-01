<?php
use App\Http\Controllers\Client\AdSecurityController;
?>
@if (AdSecurityController::shouldShowAds())
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8382233036922182"
        crossorigin="anonymous"></script>
@endif
