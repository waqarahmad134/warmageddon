<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AccountExclusionsReport;
use Illuminate\Http\Request;

class AccountExclusionsReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.reports.account-exclusions-report.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.reports.account-exclusions-report.create');
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
        
        AccountExclusionsReport::create($requestData);

        return redirect('account-exclusions-report')->with('flash_message', 'AccountExclusionsReport added!');
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
        $accountexclusionsreport = AccountExclusionsReport::findOrFail($id);

        return view('backend.reports.account-exclusions-report.show', compact('accountexclusionsreport'));
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
        $accountexclusionsreport = AccountExclusionsReport::findOrFail($id);

        return view('backend.reports.account-exclusions-report.edit', compact('accountexclusionsreport'));
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
        
        $accountexclusionsreport = AccountExclusionsReport::findOrFail($id);
        $accountexclusionsreport->update($requestData);

        return redirect('account-exclusions-report')->with('flash_message', 'AccountExclusionsReport updated!');
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
        AccountExclusionsReport::destroy($id);

        return redirect('account-exclusions-report')->with('flash_message', 'AccountExclusionsReport deleted!');
    }
}
