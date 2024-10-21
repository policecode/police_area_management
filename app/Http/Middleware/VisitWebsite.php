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
            $result = ClientVisitWebsite::getByKey(get_key_by_day())->getByIpAdress($request->ip())->first();
            if ($result) {
                if (Auth::user()) {
                    $result->user_id = Auth::user()->id;
                }
                $result->count += 1;
                $result->save();
            } else {
                $insertData = [
                    'ip_address' => $request->ip(),
                    'key' => get_key_by_day(),
                    'count' => 1
                ];
                // dd($insertData);
                if (Auth::user()) {
                    $insertData['user_id'] = Auth::user()->id;
                }
                $client = ClientVisitWebsite::create($insertData);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        return $next($request);
    }
}
