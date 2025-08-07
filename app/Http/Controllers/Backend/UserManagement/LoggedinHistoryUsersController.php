<?php

namespace App\Http\Controllers\Backend\UserManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\LoggedinHistoryUser;
use Illuminate\Http\Request;

class LoggedinHistoryUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $login_history=\App\User::all();
        
        return view('backend.user-management.loggedin-history-users.index',compact('login_history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.user-management.loggedin-history-users.create');
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
        
        LoggedinHistoryUser::create($requestData);

        return redirect('loggedin-history-users')->with('flash_message', 'LoggedinHistoryUser added!');
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
        $loggedinhistoryuser = LoggedinHistoryUser::findOrFail($id);

        return view('backend.user-management.loggedin-history-users.show', compact('loggedinhistoryuser'));
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
        $loggedinhistoryuser = LoggedinHistoryUser::findOrFail($id);

        return view('backend.user-management.loggedin-history-users.edit', compact('loggedinhistoryuser'));
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
        
        $loggedinhistoryuser = LoggedinHistoryUser::findOrFail($id);
        $loggedinhistoryuser->update($requestData);

        return redirect('loggedin-history-users')->with('flash_message', 'LoggedinHistoryUser updated!');
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
        LoggedinHistoryUser::destroy($id);

        return redirect('loggedin-history-users')->with('flash_message', 'LoggedinHistoryUser deleted!');
    }
}
