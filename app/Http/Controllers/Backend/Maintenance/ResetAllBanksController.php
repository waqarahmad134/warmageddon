<?php

namespace App\Http\Controllers\Backend\Maintenance;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ResetAllBank;
use Illuminate\Http\Request;

class ResetAllBanksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.maintenance.reset-all-banks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.maintenance.reset-all-banks.create');
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

        ResetAllBank::create($requestData);

        return redirect('reset-all-banks')->with('flash_message', 'ResetAllBank added!');
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
        $resetallbank = ResetAllBank::findOrFail($id);

        return view('backend.maintenance.reset-all-banks.show', compact('resetallbank'));
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
        $resetallbank = ResetAllBank::findOrFail($id);

        return view('backend.maintenance.reset-all-banks.edit', compact('resetallbank'));
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

        $resetallbank = ResetAllBank::findOrFail($id);
        $resetallbank->update($requestData);

        return redirect('reset-all-banks')->with('flash_message', 'ResetAllBank updated!');
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
        ResetAllBank::destroy($id);

        return redirect('reset-all-banks')->with('flash_message', 'ResetAllBank deleted!');
    }
}
