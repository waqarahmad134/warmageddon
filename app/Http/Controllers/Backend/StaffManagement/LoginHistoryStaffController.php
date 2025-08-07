<?php

namespace App\Http\Controllers\Backend\StaffManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\LoginHistoryStaff;
use Illuminate\Http\Request;

class LoginHistoryStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $loginHistoryStaff=LoginHistoryStaff::latest()->get();
        return view('backend.staff-management.login-history-staff.index',compact('loginHistoryStaff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.staff-management.login-history-staff.create');
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
        
        LoginHistoryStaff::create($requestData);

        return redirect('login-history-staff')->with('flash_message', 'LoginHistoryStaff added!');
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
        $loginhistorystaff = LoginHistoryStaff::findOrFail($id);

        return view('backend.staff-management.login-history-staff.show', compact('loginhistorystaff'));
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
        $loginhistorystaff = LoginHistoryStaff::findOrFail($id);

        return view('backend.staff-management.login-history-staff.edit', compact('loginhistorystaff'));
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
        
        $loginhistorystaff = LoginHistoryStaff::findOrFail($id);
        $loginhistorystaff->update($requestData);

        return redirect('login-history-staff')->with('flash_message', 'LoginHistoryStaff updated!');
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
        LoginHistoryStaff::destroy($id);

        return redirect('login-history-staff')->with('flash_message', 'LoginHistoryStaff deleted!');
    }
}
