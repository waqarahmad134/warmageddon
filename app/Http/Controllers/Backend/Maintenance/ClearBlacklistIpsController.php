<?php

namespace App\Http\Controllers\Backend\Maintenance;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ClearBlacklistIp;
use Illuminate\Http\Request;

class ClearBlacklistIpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.maintenance.clear-blacklist-ips.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.maintenance.clear-blacklist-ips.create');
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

        ClearBlacklistIp::create($requestData);

        return redirect('clear-blacklist-ips')->with('flash_message', 'ClearBlacklistIp added!');
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
        $clearblacklistip = ClearBlacklistIp::findOrFail($id);

        return view('backend.maintenance.clear-blacklist-ips.show', compact('clearblacklistip'));
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
        $clearblacklistip = ClearBlacklistIp::findOrFail($id);

        return view('backend.maintenance.clear-blacklist-ips.edit', compact('clearblacklistip'));
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

        $clearblacklistip = ClearBlacklistIp::findOrFail($id);
        $clearblacklistip->update($requestData);

        return redirect('clear-blacklist-ips')->with('flash_message', 'ClearBlacklistIp updated!');
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
        ClearBlacklistIp::destroy($id);

        return redirect('clear-blacklist-ips')->with('flash_message', 'ClearBlacklistIp deleted!');
    }
}
