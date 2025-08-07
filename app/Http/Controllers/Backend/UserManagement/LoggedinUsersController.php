<?php

namespace App\Http\Controllers\Backend\UserManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\LoggedinUser;
use Illuminate\Http\Request;

class LoggedinUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $loggedin=LoggedinUser::latest()->get();
        return view('backend.user-management.loggedin-users.index',compact('loggedin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.user-management.loggedin-users.create');
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
        
        LoggedinUser::create($requestData);

        return redirect('loggedin-users')->with('flash_message', 'LoggedinUser added!');
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
        $loggedinuser = LoggedinUser::findOrFail($id);

        return view('backend.user-management.loggedin-users.show', compact('loggedinuser'));
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
        $loggedinuser = LoggedinUser::findOrFail($id);

        return view('backend.user-management.loggedin-users.edit', compact('loggedinuser'));
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
        
        $loggedinuser = LoggedinUser::findOrFail($id);
        $loggedinuser->update($requestData);

        return redirect('loggedin-users')->with('flash_message', 'LoggedinUser updated!');
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
        LoggedinUser::destroy($id);

        return redirect('loggedin-users')->with('flash_message', 'LoggedinUser deleted!');
    }
}
