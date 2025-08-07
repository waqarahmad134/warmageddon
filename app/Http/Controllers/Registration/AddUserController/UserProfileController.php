<?php

namespace App\Http\Controllers\Registration\AddUserController;

use App\AddGame;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\UserProfile;
use Illuminate\Http\Request;
use Auth;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.user-profile.user-profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.user-profile.user-profile.create');
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

        $requestData = $request->all();

        UserProfile::create($requestData);

        return redirect('user-profile')->with('flash_message', 'UserProfile added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $userprofile = UserProfile::findOrFail($id);

        return view('backend.user-profile.user-profile.show', compact('userprofile'));
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
        $userprofile = UserProfile::findOrFail($id);

        return view('backend.user-profile.user-profile.edit', compact('userprofile'));
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
        $request->validate([
            'username' => 'required',
            'email' => 'required|string|email|max:255',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ]);
          $user             = User::where('id',$id)->first();
        $user->first_name   = $request->first_name;
        $user->last_name    = $request->last_name;
        $user->user_name     = $request->username;
        $user->email         = $request->email;
        $user->save();

       // $users = \App\Admin::findOrFail($id);
        $user_info = UserProfile::where('user_id', $id)->first();

        if (isset($user_info))
        {

            // create user profile

            //$user_info->update($requestProfile);
            $user_profile = UserProfile::where('user_id', $id)->first();
            $user_profile->first_name= $request->first_name;
            $user_profile->last_name= $request->last_name;
            $user_profile->username = $request->username;

            $user_profile->date_of_birth = $request->date_of_birth;
            $user_profile->secret_question= $request->secret_question;
            $user_profile->country = $request->country;
            $user_profile->state = $request->city;
            $user_profile->secret_answer = $request->secret_answer;
            $user_profile->phone_number = $request->phone_number;
            $user_profile->address = $request->address;
            $image=$request->base_image;
            if($image){
                $imageName=time().'.'.$image->getClientOriginalName();
                $image->move('backend/profile', $imageName);
                $requestProfile['base_image']=$imageName;
                $user_profile->base_image = $requestProfile['base_image'];
            }
             $user_profile->save();

        }else {

            $users = \App\Admin::findOrFail($id);

            //if user profile is not set
            $requestProfile = $request->except(['base_image', 'email']);

            // create user profile
            $image=$request->base_image;
            if($image){
                $imageName=time().'.'.$image->getClientOriginalName();
                $image->move('backend/profile', $imageName);
                $requestProfile['base_image']=$imageName;
            }

            $requestProfile['user_id']= $id;

            UserProfile::create($requestProfile);

            // update user table
            $requestUsers = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ];
            $users->update($requestUsers);
        }


        $request->session()->flash('alert-success', 'Successfully Update!');
        return redirect()->back();
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
        UserProfile::destroy($id);

        return redirect('user-profile')->with('flash_message', 'UserProfile deleted!');
    }
    public function game_title(Request $request)
    {
        $addgame = AddGame::where('game_title', $request->id)->first();

        if ($addgame){
            echo '<span style="color: red;">The game title is not available</span>';
        }else {
            echo '<span style="color: #2979ff;">The game title is available</span>';
        }
    }
    public function user_logout()
    {

        Auth::logout();
        return redirect('/login');
    }
}
