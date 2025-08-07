<?php

namespace App\Http\Controllers\Backend\Maintenance;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ClearLogin;
use Illuminate\Http\Request;

class ClearLoginsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('backend.maintenance.clear-logins.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.maintenance.clear-logins.create');
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

        ClearLogin::create($requestData);

        return redirect('clear-logins')->with('flash_message', 'ClearLogin added!');
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
        $clearlogin = ClearLogin::findOrFail($id);

        return view('backend.maintenance.clear-logins.show', compact('clearlogin'));
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
        $clearlogin = ClearLogin::findOrFail($id);

        return view('backend.maintenance.clear-logins.edit', compact('clearlogin'));
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

        $clearlogin = ClearLogin::findOrFail($id);
        $clearlogin->update($requestData);

        return redirect('clear-logins')->with('flash_message', 'ClearLogin updated!');
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
        ClearLogin::destroy($id);

        return redirect('clear-logins')->with('flash_message', 'ClearLogin deleted!');
    }
}
