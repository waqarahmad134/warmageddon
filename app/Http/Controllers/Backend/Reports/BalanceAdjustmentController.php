<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\BalanceAdjustment;
use Illuminate\Http\Request;

class BalanceAdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.reports.balance-adjustment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.reports.balance-adjustment.create');
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
        
        BalanceAdjustment::create($requestData);

        return redirect('balance-adjustment')->with('flash_message', 'BalanceAdjustment added!');
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
        $balanceadjustment = BalanceAdjustment::findOrFail($id);

        return view('backend.reports.balance-adjustment.show', compact('balanceadjustment'));
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
        $balanceadjustment = BalanceAdjustment::findOrFail($id);

        return view('backend.reports.balance-adjustment.edit', compact('balanceadjustment'));
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
        
        $balanceadjustment = BalanceAdjustment::findOrFail($id);
        $balanceadjustment->update($requestData);

        return redirect('balance-adjustment')->with('flash_message', 'BalanceAdjustment updated!');
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
        BalanceAdjustment::destroy($id);

        return redirect('balance-adjustment')->with('flash_message', 'BalanceAdjustment deleted!');
    }
}
