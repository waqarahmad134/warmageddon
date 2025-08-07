<?php

namespace App\Http\Controllers\Backend\MultiPlayerSicbo;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SicboSetting;
use Illuminate\Http\Request;

class SicboSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-player-sicbo.sicbo-settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-player-sicbo.sicbo-settings.create');
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
        
        SicboSetting::create($requestData);

        return redirect('sicbo-settings')->with('flash_message', 'SicboSetting added!');
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
        $sicbosetting = SicboSetting::findOrFail($id);

        return view('backend.multi-player-sicbo.sicbo-settings.show', compact('sicbosetting'));
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
        $sicbosetting = SicboSetting::findOrFail($id);

        return view('backend.multi-player-sicbo.sicbo-settings.edit', compact('sicbosetting'));
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
        
        $sicbosetting = SicboSetting::findOrFail($id);
        $sicbosetting->update($requestData);

        return redirect('sicbo-settings')->with('flash_message', 'SicboSetting updated!');
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
        SicboSetting::destroy($id);

        return redirect('sicbo-settings')->with('flash_message', 'SicboSetting deleted!');
    }
}
