<?php

namespace App\Http\Controllers\Backend;

use App\Role;
use App\User;
use App\UserInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.all-user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('is_active', 'on')->get();

        return view('admin.users.create-user', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $requestData = $request->except(['password', 'email', 'role_id']);

        $requestUser['name'] = $request->first_name .' '. $request->last_name;
        $requestUser['email'] = $request->email;
        $requestUser['password'] = Hash::make($request->password);

        User::create($requestUser);

        //Roles array to string convert
        if ($request->role_id)
        {
            $requestData['role_id'] = implode('|', $request->role_id);
        }

        $requestData['user_id'] = User::latest()->first()->id;

        UserInfo::create($requestData);

        $request->session()->flash('alert-success', 'Successfully created!');
        return redirect()->route('get_user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $roles = Role::where('is_active', 'on')->get();

        // Product Categories String to array convert
        $user_roles = explode('|', $user->user_info->role_id);
        $user_roles = array_combine(range(1, count($user_roles)), $user_roles);

        return view('admin.users.edit-user', compact('user', 'roles', 'user_roles'));
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
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'role_id' => 'required',
        ]);

        $user = User::findOrFail($id);

        $requestData = $request->except(['email', 'role_id']);

        $requestUser['name'] = $request->first_name .' '. $request->last_name;
        $requestUser['email'] = $request->email;

        $user->update($requestUser);

        //Roles array to string convert
        if ($request->role_id)
        {
            $requestData['role_id'] = implode('|', $request->role_id);
        }
        if ($request->is_active) {
            $requestData['is_active'] = 'on';
        }else {
            $requestData['is_active'] = 'off';
        }

        $user_info = UserInfo::where('user_id', $user->id)->first();
        $user_info->update($requestData);

        $request->session()->flash('alert-success', 'Successfully updated !');
        return redirect()->route('get_user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user->user_info)
        {
            $user->user_info->delete();
        }

        $user->delete();

        $request->session()->flash('alert-danger', 'Successfully deleted!');
        return redirect()->route('get_user');
    }
}
