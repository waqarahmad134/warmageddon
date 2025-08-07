<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckUserMiddleware
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
        if(@Auth::user()){
            if (Auth::user()->hasRole(['Admin'])) {
                return redirect('dash-panel');
            }
            if(@Auth::user()->hasRole(['User'])){
                return $next($request);
            }
        }        
        return $next($request);
    }
}
