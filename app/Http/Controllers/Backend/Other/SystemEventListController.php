<?php

namespace App\Http\Controllers\Backend\Other;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SystemEventList;
use Illuminate\Http\Request;

class SystemEventListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.other.system-event-list.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.other.system-event-list.create');
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
        
        SystemEventList::create($requestData);

        return redirect('system-event-list')->with('flash_message', 'SystemEventList added!');
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
        $systemeventlist = SystemEventList::findOrFail($id);

        return view('backend.other.system-event-list.show', compact('systemeventlist'));
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
        $systemeventlist = SystemEventList::findOrFail($id);

        return view('backend.other.system-event-list.edit', compact('systemeventlist'));
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
        
        $systemeventlist = SystemEventList::findOrFail($id);
        $systemeventlist->update($requestData);

        return redirect('system-event-list')->with('flash_message', 'SystemEventList updated!');
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
        SystemEventList::destroy($id);

        return redirect('system-event-list')->with('flash_message', 'SystemEventList deleted!');
    }
}
