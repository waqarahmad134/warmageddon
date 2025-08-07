<?php

namespace App\Http\Controllers\Backend\Maintenance;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ServicesHealthMonitor;
use Illuminate\Http\Request;

class ServicesHealthMonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.maintenance.services-health-monitor.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.maintenance.services-health-monitor.create');
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

        ServicesHealthMonitor::create($requestData);

        return redirect('services-health-monitor')->with('flash_message', 'ServicesHealthMonitor added!');
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
        $serviceshealthmonitor = ServicesHealthMonitor::findOrFail($id);

        return view('backend.maintenance.services-health-monitor.show', compact('serviceshealthmonitor'));
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
        $serviceshealthmonitor = ServicesHealthMonitor::findOrFail($id);

        return view('backend.maintenance.services-health-monitor.edit', compact('serviceshealthmonitor'));
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

        $serviceshealthmonitor = ServicesHealthMonitor::findOrFail($id);
        $serviceshealthmonitor->update($requestData);

        return redirect('services-health-monitor')->with('flash_message', 'ServicesHealthMonitor updated!');
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
        ServicesHealthMonitor::destroy($id);

        return redirect('services-health-monitor')->with('flash_message', 'ServicesHealthMonitor deleted!');
    }
}
