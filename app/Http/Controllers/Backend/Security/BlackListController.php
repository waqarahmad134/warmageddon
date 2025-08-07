<?php

namespace App\Http\Controllers\Backend\Security;

use App\User;
use App\Country;
//use phpDocumentor\Reflection\Types\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class BlackListController extends Controller
{
    public function index(Request $request)
    {
        try {
                $blacklist=User::role('User')->where('status' ,'!=', 0)->get();
                $countries=Country::all();
                return view('backend.security.black-list.index',compact('blacklist' ,'countries'));
            } catch (\Exception $e) {
                Toastr::error('Something went wrong please try again!');
                return redirect()->back();
            }
    }

    public function block($id)
    {
        try {
            $user = Country::find($id);
            if($user->active_status== 1){
                $user->active_status = 0;
                $msg = 'Country blocked successfully !';
            }else{
                $user->active_status = 1;
                $msg = 'Country unblocked successfully !';
            }
            $user->save();
            Toastr::success($msg,'Success');
            return redirect()->back();
        } catch (\Exception $e) {
            Toastr::error('Something went wrong please try again!');
            return redirect()->back();
        }
    }
    public function similar_accounts()
    {
        $users                               = collect();
        foreach(User::with('Country')->get() as $user)
        {
            $email = explode('@',$user->name);
//            $ads->where(function ($q) use ($title) {
//                foreach ($title as $value) {
//                    $q->orWhere('title', 'like', "%{$value}%");
//                }
//            });
            if ($user->first_name!=null)
            {
                $entry           = User::where('id','!=',$user->id)
                                        ->where('first_name','like',"%{$user->first_name}%")
                                        ->orwhere('last_name','like',"%{$user->last_name}%")
                                        ->orwhere('user_name','like',"%{$user->user_name}%")
                                        ->get();
                if (count($entry)>0)
                {
                    $users->push($user);
                }

            }

        }
      return view('backend.security.accounts_detectors.index',compact('users'));
    }
    public function view_accounts($id)
    {
        $users                               = collect();

        $user                                = User::where('id','=',$id)->first();
            if ($user->first_name!=null)
            {
                $users           = User::where('id','!=',$user->id)
                    ->where('first_name','like',"%{$user->first_name}%")
                    ->orwhere('last_name','like',"%{$user->last_name}%")
                    ->orwhere('user_name','like',"%{$user->user_name}%")
                    ->with('Country')
                    ->get();
            }

        return view('backend.security.accounts_detectors.show',compact('users','user'));
    }

    public function similar_ips()
    {
        $users                               = User::whereIn('id', function ( $query ) {
            $query->select('id')->from('users')->groupBy('ip_address')->havingRaw('count(*) > 1');
        })->with('Country')->get();

        return view('backend.security.ip_detectors.index',compact('users'));
    }
    public function view_ips($id)
    {
        $users                               = collect();

        $user                                = User::where('id','=',$id)->with('Country')->first();
        if ($user->ip_address!=null)
        {
            $users           = User::where('id','!=',$user->id)
                ->where('ip_address','like',"%{$user->ip_address}%")
                ->get();
        }

        return view('backend.security.ip_detectors.show',compact('users','user'));
    }
}
