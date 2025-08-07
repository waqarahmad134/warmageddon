<?php

namespace App\Http\Middleware;
use Closure;
use DB;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$permission_name)
    {
        //first check that name in your db
        $permission = DB::table('permissions')->where('name',$permission_name)->first();
            if($permission){
                //here you have to get logged in user role
                $role_id = Auth::user()->role;
                ## so now check permission
                $check_permission = DB::table('role_has_permissions')->where('role_id',$role_id)->where('permission_id',$permission->id)->first();
                if($check_permission){
                    return $next($request);
                }
                //if Permission not assigned for this user role show what you need
            }
            // if Permission name not in table then do what you need
            ## Ex1 : return 'Permission not in Database';
            ## Ex2 : return redirect()->back();

        }
}
