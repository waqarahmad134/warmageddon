<?php

namespace App\Http\Controllers\Backend\Maintenance;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ClearStaffLog;
use Illuminate\Http\Request;

class ClearStaffLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('backend.maintenance.clear-staff-logs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.maintenance.clear-staff-logs.create');
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

        ClearStaffLog::create($requestData);

        return redirect('clear-staff-logs')->with('flash_message', 'ClearStaffLog added!');
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
        $clearstafflog = ClearStaffLog::findOrFail($id);

        return view('backend.maintenance.clear-staff-logs.show', compact('clearstafflog'));
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
        $clearstafflog = ClearStaffLog::findOrFail($id);

        return view('backend.maintenance.clear-staff-logs.edit', compact('clearstafflog'));
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

        $clearstafflog = ClearStaffLog::findOrFail($id);
        $clearstafflog->update($requestData);

        return redirect('clear-staff-logs')->with('flash_message', 'ClearStaffLog updated!');
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
        ClearStaffLog::destroy($id);

        return redirect('clear-staff-logs')->with('flash_message', 'ClearStaffLog deleted!');
    }
}
