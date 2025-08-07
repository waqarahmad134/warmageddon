<?php

namespace App\Http\Middleware;

use App\User;
use App\Country;
use Closure;
use Illuminate\Support\Facades\Auth;

class CountryRestrict
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*$ip = $request->ip();
        $url = "https://api.ipstack.com/".$ip."?access_key=d7885935fa278cb5c8d9d28ccb975f97&format=1&fields=country_code";
        $json = file_get_contents($url);

        $json = json_decode($json, true);

        $cn = Country::where('iso2' , $json['country_code'])->where('active_status','0')->get();

        if($cn->count()){
            abort(403);
        }*/
        
        return $next($request);
    }
}
