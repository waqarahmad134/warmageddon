<?php

namespace App\Http\Controllers\Backend\StaffManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ListAgent;
use Illuminate\Http\Request;

class ListAgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $listagent=\App\CreateAgent::latest()->get();
        return view('backend.staff-management.list-agents.index',compact('listagent'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.staff-management.list-agents.create');
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
        
        ListAgent::create($requestData);

        return redirect('list-agents')->with('flash_message', 'ListAgent added!');
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
        $listagent = ListAgent::findOrFail($id);

        return view('backend.staff-management.list-agents.show', compact('listagent'));
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
        $listagent = ListAgent::findOrFail($id);

        return view('backend.staff-management.list-agents.edit', compact('listagent'));
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
        
        $listagent = ListAgent::findOrFail($id);
        $listagent->update($requestData);

        return redirect('list-agents')->with('flash_message', 'ListAgent updated!');
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
        ListAgent::destroy($id);

        return redirect('list-agents')->with('flash_message', 'ListAgent deleted!');
    }
}
