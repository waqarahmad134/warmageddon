<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AccountLock;
use Illuminate\Http\Request;

class AccountLockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.reports.account-lock.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.reports.account-lock.create');
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
        
        AccountLock::create($requestData);

        return redirect('account-lock')->with('flash_message', 'AccountLock added!');
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
        $accountlock = AccountLock::findOrFail($id);

        return view('backend.reports.account-lock.show', compact('accountlock'));
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
        $accountlock = AccountLock::findOrFail($id);

        return view('backend.reports.account-lock.edit', compact('accountlock'));
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
        
        $accountlock = AccountLock::findOrFail($id);
        $accountlock->update($requestData);

        return redirect('account-lock')->with('flash_message', 'AccountLock updated!');
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
        AccountLock::destroy($id);

        return redirect('account-lock')->with('flash_message', 'AccountLock deleted!');
    }
}
