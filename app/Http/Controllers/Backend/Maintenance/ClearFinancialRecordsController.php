<?php

namespace App\Http\Controllers\Backend\Maintenance;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ClearFinancialRecord;
use Illuminate\Http\Request;

class ClearFinancialRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('backend.maintenance.clear-financial-records.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.maintenance.clear-financial-records.create');
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

        ClearFinancialRecord::create($requestData);

        return redirect('clear-financial-records')->with('flash_message', 'ClearFinancialRecord added!');
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
        $clearfinancialrecord = ClearFinancialRecord::findOrFail($id);

        return view('backend.maintenance.clear-financial-records.show', compact('clearfinancialrecord'));
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
        $clearfinancialrecord = ClearFinancialRecord::findOrFail($id);

        return view('backend.maintenance.clear-financial-records.edit', compact('clearfinancialrecord'));
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

        $clearfinancialrecord = ClearFinancialRecord::findOrFail($id);
        $clearfinancialrecord->update($requestData);

        return redirect('clear-financial-records')->with('flash_message', 'ClearFinancialRecord updated!');
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
        ClearFinancialRecord::destroy($id);

        return redirect('clear-financial-records')->with('flash_message', 'ClearFinancialRecord deleted!');
    }
}
