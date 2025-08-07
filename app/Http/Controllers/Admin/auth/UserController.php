<?php

namespace App\Http\Controllers\admin\auth;

use App\ProsixUserWallet;
use File;
use Illuminate\Support\Facades\Input;
use Session;
use App\User;
use App\Account;
use Carbon\Carbon;
use App\UserProfile;
use App\LoginHistoryStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use App\Notifications\UserAdmin;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','desc')->get();
        $roles = Role::get();
        return view('backend.auth.users.index',compact('roles','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);
        DB::beginTransaction();
        try{
            dd($request['user_name']);
        $user = User::create([
            'user_name' => $request['user_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $user->verified=1;
        $user->phone_verification=1;
        $user->save();
        $user_profile = UserProfile::create([
            'user_id' => $user->id,
            'username' => $request['user_name'],
        ]);
        $LoginHistoryStaff=new LoginHistoryStaff;
        $LoginHistoryStaff->user_id = $user->id;
        $LoginHistoryStaff->save();
        /*$account=new Account;
        $account->user_id=$user->id;
        $account->save();*/

        $wallet=new ProsixUserWallet();
        $wallet->user_id=$user->id;
        $wallet->save();

        Toastr::success('Admin '.$request->name.' added successfully','Success');
//        Notification::send($user, new UserAdmin($user));

        $roles = $request['roles'];

        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r);
            }
        }
        $type = 'User create';
        $user=[
            'ip'=>$request->getClientIp(),
            'user_id'=>$user->id,
            'user_name'=>$user->user_name,
        ];
        logCreatedActivity($user->id,$user_profile,$type,$user);

        DB::commit();
        return redirect()->back();
    } catch (\Exception $e) {
        Toastr::error('Something went wrong try again!','Error');
        return redirect()->back();
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::findOrFail($id);
        $roles = Role::get();

        return view('backend.auth.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request, [
            'user_name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            'password' => ['required', 'string', 'min:8', 'confirmed','regex:/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/'],
        ]);
        if ($user->pro_parent!=$request->pro_parent)
        {
            $this->validate($request,[
                'pro_parent' => 'unique:users',
            ]);
        }
        $user->user_name=$request->user_name;
        $user->email=$request->email;
        $user->password=($request->password!=null?bcrypt($request['password']):$user->password);
        $user->pro_parent=Input::has('pro_parent')?$request->pro_parent:'Null';
        $user->pro_payout_percentage=Input::has('pro_payout_percentage')?$request->pro_payout_percentage:'Null';
        $roles = $request['roles'];
        $user->status = $request->status;
        $user->save();
        if ($request->aff_status=="1")
        {
            $pro_wallet                = new ProsixUserWallet();
            $pro_wallet->user_id       = $user->id;
            $pro_wallet->save();
        }
        $user_profile=UserProfile::where('user_id',$id)->first();
        $user_profile->username=$request->user_name;
        $user_profile->user_id=$user->id;
        $user_profile->address=$request->address;
        $user_profile->date_of_birth=$request->date_of_birth;
        $user_profile->country=$request->country;
        $user_profile->state=$request->city;
        $user_profile->phone_number=$request->phone_number;
        $user_profile->secret_question=$request->secret_question;
        $user_profile->secret_answer=$request->secret_answer;
        $user_profile->status=$request->status;
        $user_profile->save();
        if (isset($roles)) {

//           foreach ($roles as $role) {
            $user->roles()->detach();
            $role_r = Role::where('id', '=', $roles)->firstOrFail();
            $user->assignRole($role_r);
//            }
            Toastr::success($request->user_name.' ('.$role_r->name.') updated successfully','Success');
        }
        else
        {
            $user->roles()->detach();
            Toastr::success($request->user_name.' updated successfully','Success');
        }
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Toastr::success($user->name.' deleted successfully','Success');


        return redirect()->route('users.index');
    }

}
