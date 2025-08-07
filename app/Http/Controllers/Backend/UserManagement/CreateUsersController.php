<?php

namespace App\Http\Controllers\Backend\UserManagement;

use App\Http\Controllers\Controller;
use App\CreateUser;
use App\ProsixUserWallet;
use App\User;
use App\UserProfile;
use App\Notifications\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Brian2694\Toastr\Facades\Toastr;
use Validator;
class CreateUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $roles = Role::where('name','!=','User')->get();
        return view('backend.user-management.create-users.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::all();
        return view('backend.user-management.create-users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $request->validate([
            'username' => 'required|unique:user_profiles',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'string', 'min:8','regex:/^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/'],
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address' => 'sometimes|nullable',
            'date_of_birth' => 'sometimes|nullable',
            'country' => 'sometimes|nullable|string',
            'city' => 'sometimes|nullable|string',
            'phone_number' => 'sometimes|nullable',
            'secret_question' => 'sometimes|nullable|string',
            'secret_answer' => 'sometimes|nullable|string',
            'roles' => 'sometimes|nullable',
            'status' => 'sometimes|nullable|string',
        ]);
        if ($request->aff_status=="1")
        {
            $request->validate([
                'pro_parent' => 'required|unique:users',
                ]);
        }
        /* $requestProfile = $request->except(['password', 'email']); */

        /* $requestUser = User::create([
          'first_name'  => $request->first_name,
          'last_name'  => $request->last_name,
          'email'  => $request->email,
          'password'  => Hash::make($request->password),
        ]); */
        $user = new User;
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->user_name=$request->username;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->pusher_token    = $this->generatePusherToken();
        $user->verified=1;
        $user->pro_parent=Input::has('pro_parent')?$request->pro_parent:'Null';
        $user->pro_payout_percentage=Input::has('pro_payout_percentage')?$request->pro_payout_percentage:'Null';
        $user->save();
          if ($request->aff_status=="1")
          {
              $pro_wallet                = new ProsixUserWallet();
              $pro_wallet->user_id       = $user->id;
              $pro_wallet->save();
          }
        $user_profile=new UserProfile();
        $user_profile->username=$request->username;
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

        $roles = $request['roles'];
        if (isset($roles)) {

//           foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $roles)->firstOrFail();
                $user->assignRole($role_r);
//            }
            Toastr::success($role_r->name.$request->name.' added successfully','Success');
        }
        else
        {
            Toastr::success('Admin'.$request->name.' added successfully','Success');
        }
        Notification::send($user, new UserAdmin($user));
        return redirect()->route('create-users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    function generatePusherToken()
    {
        $number              = str_random(10);
        if(\Illuminate\Support\Facades\DB::table('users')->where('pusher_token',$number)->exists())
        {
            return $this->generatePusherToken();
        }
        else
        {
            return $number;
        }
    }
    public function show($id)
    {
        $createuser = CreateUser::findOrFail($id);

        return view('backend.user-management.create-users.show', compact('createuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {

        $createuser = CreateUser::findOrFail($id);

        return view('backend.user-management.create-users.edit', compact('createuser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $createuser = CreateUser::findOrFail($id);
        $createuser->update($requestData);

        return redirect('create-users')->with('flash_message', 'CreateUser updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        CreateUser::destroy($id);

        return redirect('create-users')->with('flash_message', 'CreateUser deleted!');
    }

    public function get_city(Request $request)
    {

        $country = $request->id;
        $city = DB::table('states')->where('country_id', $country)->orderBy('name', 'asc')->get();
         return response()->json($city);
    }
    public function check_pro_parent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pro_parent' => 'unique:users',
        ]);
        if ($validator->fails())
        {
            return response()->json("not ok");
        }
        else {
            return response()->json("ok");
        }
    }
}
