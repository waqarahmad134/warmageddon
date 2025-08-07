<?php

namespace App\Http\Controllers\Backend\StaffManagement;

use App\User;
use App\Account;
use App\CreateAgent;
use App\UserProfile;
use App\Activity;
use App\Http\Requests;
use App\LoginHistoryStaff;
use Illuminate\Http\Request;
use App\Notifications\UserAdmin;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use DB;
class CreateAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.staff-management.create-agent.index');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'username'=>'required|string|max:120|unique:user_profiles',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',
            'first_name'=>'required|string|max:120',
            'last_name'=>'required|string|max:120',
            'roles_id' =>'required|integer',
        ]);
        DB::beginTransaction();
        try {
            $user = new User;
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;
            $user->user_name=$request->username;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->verified=1;
		    $user->phone_verification=1;
            $user->save();

            $user_profile = UserProfile::create([
                'user_id' => $user->id,
                'username' => $request['username'],
                'first_name'=> $request['first_name'],
                'last_name' => $request['last_name'],
            ]);
            $createAgent=new CreateAgent;
            $createAgent->user_id = $user->id;
            $createAgent->save();

            $LoginHistoryStaff=new LoginHistoryStaff;
            $LoginHistoryStaff->user_id = $user->id;
            $LoginHistoryStaff->save();
            /*$account=new Account;
            $account->user_id=$user->id;
            $account->save();*/
            Toastr::success($request->username.' registered successfully','Success');
//            Notification::send($user, new UserAdmin($user));
//            $role = $request['roles_id'];
//            $role_r = Role::where('id', '=', $role)->firstOrFail();
//            $user->assignRole($role_r);
//            $type = 'Agent create';
//            $user=[
//                'ip'=>$request->getClientIp(),
//                'user_id'=>$user->id,
//                'user_name'=>$user->user_name,
//            ];
            $type = 'Agent create';
            logCreatedActivity($createAgent->id,$createAgent,$type,$user);
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
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
         $user = User::role('Agent')->get();
        return view('backend.staff-management.create-agent.user_list', compact('user'));
    }


    function logs(){
        try {
             $user = Activity::where(['description'=>'Agent create','status'=>1])->get();
            return view('backend.staff-management.create-agent.agent_logs', compact('user'));

        } catch (\Exception $e) {
            Toastr::error('Something went wrong try again!','Error');
            return redirect()->back();
        }
    }


    public function edit($id)
    {
        $createagent = CreateAgent::findOrFail($id);

        return view('backend.staff-management.create-agent.edit', compact('createagent'));
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

        $createagent = CreateAgent::findOrFail($id);
        $createagent->update($requestData);

        return redirect('create-agent')->with('flash_message', 'CreateAgent updated!');
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
        CreateAgent::destroy($id);

        return redirect('create-agent')->with('flash_message', 'CreateAgent deleted!');
    }
}
