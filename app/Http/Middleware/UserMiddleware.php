<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
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
            if (Auth::user()==null){
                return redirect('/');
                abort('401');
            }
            if (Auth::user()->hasRole(['User'])) //If user does //not have this permission
            {
                return redirect('/');
                abort('401');
            }
        }

        return $next($request);
    }
}
