<?php

namespace App\Http\Controllers\Backend\MultiPlayerRoulette;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\RouletteSetting;
use Illuminate\Http\Request;

class RouletteSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-player-roulette.roulette-settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-player-roulette.roulette-settings.create');
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
        
        RouletteSetting::create($requestData);

        return redirect('roulette-settings')->with('flash_message', 'RouletteSetting added!');
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
        $roulettesetting = RouletteSetting::findOrFail($id);

        return view('backend.multi-player-roulette.roulette-settings.show', compact('roulettesetting'));
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
        $roulettesetting = RouletteSetting::findOrFail($id);

        return view('backend.multi-player-roulette.roulette-settings.edit', compact('roulettesetting'));
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
        
        $roulettesetting = RouletteSetting::findOrFail($id);
        $roulettesetting->update($requestData);

        return redirect('roulette-settings')->with('flash_message', 'RouletteSetting updated!');
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
        RouletteSetting::destroy($id);

        return redirect('roulette-settings')->with('flash_message', 'RouletteSetting deleted!');
    }
}
