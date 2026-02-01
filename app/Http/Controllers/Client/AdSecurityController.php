<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class AdSecurityController extends Controller
{
    // Ngưỡng giới hạn: 3 click trong vòng 1 giờ
    protected $maxClicks = 3;
    protected $decayMinutes = 720; // 12 hours

    public function logClick(Request $request)
    {
        $ip = $request->ip();
        $cacheKey = 'ad_clicks_' . $ip;

        // Tăng biến đếm trong cache
        $currentClicks = Cache::get($cacheKey, 0);
        Cache::put($cacheKey, $currentClicks + 1, now()->addMinutes($this->decayMinutes));

        return response()->json(['status' => 'success']);
    }

    /**
     * Helper function để kiểm tra xem có nên hiển thị quảng cáo không
     * Bạn có thể gọi hàm này trực tiếp trong Blade hoặc qua Service Provider
     */
    public static function shouldShowAds()
    {
        $ip = request()->ip();
        $clickCount = Cache::get('ad_clicks_' . $ip, 0);

        return $clickCount < 3; // Trả về true nếu click chưa quá 3 lần
    }
}
