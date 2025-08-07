<?php

namespace App\Http\Controllers\Backend\Other;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SystemEventAdd;
use Illuminate\Http\Request;

class SystemEventAddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.other.system-event-add.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.other.system-event-add.create');
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
        
        SystemEventAdd::create($requestData);

        return redirect('system-event-add')->with('flash_message', 'SystemEventAdd added!');
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
        $systemeventadd = SystemEventAdd::findOrFail($id);

        return view('backend.other.system-event-add.show', compact('systemeventadd'));
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
        $systemeventadd = SystemEventAdd::findOrFail($id);

        return view('backend.other.system-event-add.edit', compact('systemeventadd'));
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
        
        $systemeventadd = SystemEventAdd::findOrFail($id);
        $systemeventadd->update($requestData);

        return redirect('system-event-add')->with('flash_message', 'SystemEventAdd updated!');
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
        SystemEventAdd::destroy($id);

        return redirect('system-event-add')->with('flash_message', 'SystemEventAdd deleted!');
    }
}
