<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PerformancePayout;
use Illuminate\Http\Request;

class PerformancePayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.reports.performance-payout.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.reports.performance-payout.create');
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
        
        PerformancePayout::create($requestData);

        return redirect('performance-payout')->with('flash_message', 'PerformancePayout added!');
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
        $performancepayout = PerformancePayout::findOrFail($id);

        return view('backend.reports.performance-payout.show', compact('performancepayout'));
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
        $performancepayout = PerformancePayout::findOrFail($id);

        return view('backend.reports.performance-payout.edit', compact('performancepayout'));
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
        
        $performancepayout = PerformancePayout::findOrFail($id);
        $performancepayout->update($requestData);

        return redirect('performance-payout')->with('flash_message', 'PerformancePayout updated!');
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
        PerformancePayout::destroy($id);

        return redirect('performance-payout')->with('flash_message', 'PerformancePayout deleted!');
    }
}
