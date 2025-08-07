<?php

namespace App\Http\Controllers\Backend\casinoSetting;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StaffAccess;
use Illuminate\Http\Request;

class StaffAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {


        return view('backend.casino-setting.staff-access.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\casino-setting.staff-access.create');
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

        StaffAccess::create($requestData);

        return redirect('staff-access')->with('flash_message', 'StaffAccess added!');
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
        $staffaccess = StaffAccess::findOrFail($id);

        return view('backend\casino-setting.staff-access.show', compact('staffaccess'));
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
        $staffaccess = StaffAccess::findOrFail($id);

        return view('backend\casino-setting.staff-access.edit', compact('staffaccess'));
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

        $staffaccess = StaffAccess::findOrFail($id);
        $staffaccess->update($requestData);

        return redirect('staff-access')->with('flash_message', 'StaffAccess updated!');
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
        StaffAccess::destroy($id);

        return redirect('staff-access')->with('flash_message', 'StaffAccess deleted!');
    }
}
