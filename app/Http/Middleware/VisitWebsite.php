<?php

namespace App\Http\Middleware;

use App\Models\ClientVisitWebsite;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
