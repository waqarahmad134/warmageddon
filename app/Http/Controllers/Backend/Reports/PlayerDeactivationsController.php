<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PlayerDeactivation;
use Illuminate\Http\Request;

class PlayerDeactivationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.reports.player-deactivations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.reports.player-deactivations.create');
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
        
        PlayerDeactivation::create($requestData);

        return redirect('player-deactivations')->with('flash_message', 'PlayerDeactivation added!');
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
        $playerdeactivation = PlayerDeactivation::findOrFail($id);

        return view('backend.reports.player-deactivations.show', compact('playerdeactivation'));
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
        $playerdeactivation = PlayerDeactivation::findOrFail($id);

        return view('backend.reports.player-deactivations.edit', compact('playerdeactivation'));
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
        
        $playerdeactivation = PlayerDeactivation::findOrFail($id);
        $playerdeactivation->update($requestData);

        return redirect('player-deactivations')->with('flash_message', 'PlayerDeactivation updated!');
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
        PlayerDeactivation::destroy($id);

        return redirect('player-deactivations')->with('flash_message', 'PlayerDeactivation deleted!');
    }
}
