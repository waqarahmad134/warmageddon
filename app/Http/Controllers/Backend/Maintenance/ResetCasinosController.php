<?php

namespace App\Http\Controllers\Backend\Maintenance;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ResetCasino;
use Illuminate\Http\Request;

class ResetCasinosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('backend.maintenance.reset-casinos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.maintenance.reset-casinos.create');
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

        ResetCasino::create($requestData);

        return redirect('reset-casinos')->with('flash_message', 'ResetCasino added!');
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
        $resetcasino = ResetCasino::findOrFail($id);

        return view('backend.maintenance.reset-casinos.show', compact('resetcasino'));
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
        $resetcasino = ResetCasino::findOrFail($id);

        return view('backend.maintenance.reset-casinos.edit', compact('resetcasino'));
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

        $resetcasino = ResetCasino::findOrFail($id);
        $resetcasino->update($requestData);

        return redirect('reset-casinos')->with('flash_message', 'ResetCasino updated!');
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
        ResetCasino::destroy($id);

        return redirect('reset-casinos')->with('flash_message', 'ResetCasino deleted!');
    }
}
