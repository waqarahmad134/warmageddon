<?php

namespace App\Http\Controllers\Backend\Maintenance;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ClearMultiplayer;
use Illuminate\Http\Request;

class ClearMultiplayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.maintenance.clear-multiplayers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.maintenance.clear-multiplayers.create');
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

        ClearMultiplayer::create($requestData);

        return redirect('clear-multiplayers')->with('flash_message', 'ClearMultiplayer added!');
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
        $clearmultiplayer = ClearMultiplayer::findOrFail($id);

        return view('backend.maintenance.clear-multiplayers.show', compact('clearmultiplayer'));
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
        $clearmultiplayer = ClearMultiplayer::findOrFail($id);

        return view('backend.maintenance.clear-multiplayers.edit', compact('clearmultiplayer'));
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

        $clearmultiplayer = ClearMultiplayer::findOrFail($id);
        $clearmultiplayer->update($requestData);

        return redirect('clear-multiplayers')->with('flash_message', 'ClearMultiplayer updated!');
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
        ClearMultiplayer::destroy($id);

        return redirect('clear-multiplayers')->with('flash_message', 'ClearMultiplayer deleted!');
    }
}
