<?php

namespace App\Http\Controllers\Backend\MultiPlayerRaces;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\RacesViewResult;
use Illuminate\Http\Request;

class RacesViewResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-player-races.races-view-results.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-player-races.races-view-results.create');
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
        
        RacesViewResult::create($requestData);

        return redirect('races-view-results')->with('flash_message', 'RacesViewResult added!');
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
        $racesviewresult = RacesViewResult::findOrFail($id);

        return view('backend.multi-player-races.races-view-results.show', compact('racesviewresult'));
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
        $racesviewresult = RacesViewResult::findOrFail($id);

        return view('backend.multi-player-races.races-view-results.edit', compact('racesviewresult'));
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
        
        $racesviewresult = RacesViewResult::findOrFail($id);
        $racesviewresult->update($requestData);

        return redirect('races-view-results')->with('flash_message', 'RacesViewResult updated!');
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
        RacesViewResult::destroy($id);

        return redirect('races-view-results')->with('flash_message', 'RacesViewResult deleted!');
    }
}
