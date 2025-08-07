<?php

namespace App\Http\Controllers\Backend\MultiPlayerRaces;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\RacesSetting;
use Illuminate\Http\Request;

class RacesSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-player-races.races-settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-player-races.races-settings.create');
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
        
        RacesSetting::create($requestData);

        return redirect('races-settings')->with('flash_message', 'RacesSetting added!');
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
        $racessetting = RacesSetting::findOrFail($id);

        return view('backend.multi-player-races.races-settings.show', compact('racessetting'));
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
        $racessetting = RacesSetting::findOrFail($id);

        return view('backend.multi-player-races.races-settings.edit', compact('racessetting'));
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
        
        $racessetting = RacesSetting::findOrFail($id);
        $racessetting->update($requestData);

        return redirect('races-settings')->with('flash_message', 'RacesSetting updated!');
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
        RacesSetting::destroy($id);

        return redirect('races-settings')->with('flash_message', 'RacesSetting deleted!');
    }
}
