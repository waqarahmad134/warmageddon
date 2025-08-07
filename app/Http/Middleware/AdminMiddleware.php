<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        $user = User::all()->count();
        if (!($user == 1)) {
           // dd(Auth::user()->hasPermissionTo);
            if (!Auth::user()->hasRole('Super Admin')) //If user does //not have this permission
            {
                return redirect()->back();
                abort('401');
            }
        }

        return $next($request);
    }
}
