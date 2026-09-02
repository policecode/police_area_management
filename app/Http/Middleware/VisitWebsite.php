<?php

namespace App\Http\Middleware;

use App\Models\ClientVisitWebsite;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class VisitWebsite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next,  ...$guards)
    {
        try {
            if (Auth::id()) {
                $result = ClientVisitWebsite::getByKey(get_key_by_day())->getByIpAdress($request->ip())->GetByUser(Auth::id())->first();
                if ($result) {
                    $result->count += 1;
                    $result->save();
                } else {
                    $insertData = [
                        'ip_address' => $request->ip(),
                        'key' => get_key_by_day(),
                        'count' => 1,
                        'user_id' => Auth::id()
                    ];
                    // dd($insertData);
                    $client = ClientVisitWebsite::create($insertData);
                }
                if ($result->count > 350) {
                    $request->merge(array_merge(['is_lock_chapter' => true], $request->query()));
                }

                // Hạn chế việc gửi nhiều request
                $key = 'user-call-' . Auth::id();
                // Kiểm tra nếu thực hiện quá 5 request trong vòng 60 giây
                if (RateLimiter::tooManyAttempts($key, 7)) {
                    $request->merge(array_merge(['is_lock_chapter' => true], $request->query()));
                }
                // Ghi nhận một request mới (timeout sau 60 giây)
                RateLimiter::hit($key, 60);
            } else {
                // $result = ClientVisitWebsite::getByKey(get_key_by_day())->getByIpAdress($request->ip())->whereNull('user_id')->first();
                // if ($result) {
                //     $result->count += 1;
                //     $result->save();
                // } else {
                //     $insertData = [
                //         'ip_address' => $request->ip(),
                //         'key' => get_key_by_day(),
                //         'count' => 1
                //     ];
                //     $client = ClientVisitWebsite::create($insertData);
                // }
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
        return $next($request);
    }
}
