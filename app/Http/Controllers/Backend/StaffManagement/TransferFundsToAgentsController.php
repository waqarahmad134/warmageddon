<?php

namespace App\Http\Controllers\Backend\StaffManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TransferFundsToAgent;
use Illuminate\Http\Request;

class TransferFundsToAgentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.staff-management.transfer-funds-to-agents.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.staff-management.transfer-funds-to-agents.create');
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
        
        TransferFundsToAgent::create($requestData);

        return redirect('transfer-funds-to-agents')->with('flash_message', 'TransferFundsToAgent added!');
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
        $transferfundstoagent = TransferFundsToAgent::findOrFail($id);

        return view('backend.staff-management.transfer-funds-to-agents.show', compact('transferfundstoagent'));
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
        $transferfundstoagent = TransferFundsToAgent::findOrFail($id);

        return view('backend.staff-management.transfer-funds-to-agents.edit', compact('transferfundstoagent'));
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
        
        $transferfundstoagent = TransferFundsToAgent::findOrFail($id);
        $transferfundstoagent->update($requestData);

        return redirect('transfer-funds-to-agents')->with('flash_message', 'TransferFundsToAgent updated!');
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
        TransferFundsToAgent::destroy($id);

        return redirect('transfer-funds-to-agents')->with('flash_message', 'TransferFundsToAgent deleted!');
    }
}
