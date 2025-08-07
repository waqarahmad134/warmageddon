<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AccountSummary;
use Illuminate\Http\Request;

class AccountSummaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.reports.account-summary.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.reports.account-summary.create');
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
        
        AccountSummary::create($requestData);

        return redirect('account-summary')->with('flash_message', 'AccountSummary added!');
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
        $accountsummary = AccountSummary::findOrFail($id);

        return view('backend.reports.account-summary.show', compact('accountsummary'));
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
        $accountsummary = AccountSummary::findOrFail($id);

        return view('backend.reports.account-summary.edit', compact('accountsummary'));
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
        
        $accountsummary = AccountSummary::findOrFail($id);
        $accountsummary->update($requestData);

        return redirect('account-summary')->with('flash_message', 'AccountSummary updated!');
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
        AccountSummary::destroy($id);

        return redirect('account-summary')->with('flash_message', 'AccountSummary deleted!');
    }
}
