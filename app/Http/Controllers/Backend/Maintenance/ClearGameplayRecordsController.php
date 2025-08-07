<?php

namespace App\Http\Controllers\Backend\Maintenance;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ClearGameplayRecord;
use Illuminate\Http\Request;

class ClearGameplayRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.maintenance.clear-gameplay-records.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.maintenance.clear-gameplay-records.create');
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

        ClearGameplayRecord::create($requestData);

        return redirect('clear-gameplay-records')->with('flash_message', 'ClearGameplayRecord added!');
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
        $cleargameplayrecord = ClearGameplayRecord::findOrFail($id);

        return view('backend.maintenance.clear-gameplay-records.show', compact('cleargameplayrecord'));
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
        $cleargameplayrecord = ClearGameplayRecord::findOrFail($id);

        return view('backend.maintenance.clear-gameplay-records.edit', compact('cleargameplayrecord'));
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

        $cleargameplayrecord = ClearGameplayRecord::findOrFail($id);
        $cleargameplayrecord->update($requestData);

        return redirect('clear-gameplay-records')->with('flash_message', 'ClearGameplayRecord updated!');
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
        ClearGameplayRecord::destroy($id);

        return redirect('clear-gameplay-records')->with('flash_message', 'ClearGameplayRecord deleted!');
    }
}
