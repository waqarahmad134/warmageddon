<?php

namespace App\Http\Controllers\Backend\casinoSetting;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\EnvironmentSetting;
use Illuminate\Http\Request;

class EnvironmentSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {


        return view('backend.casino-setting.environment-settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\casino-setting.environment-settings.create');
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

        EnvironmentSetting::create($requestData);

        return redirect('environment-settings')->with('flash_message', 'EnvironmentSetting added!');
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
        $environmentsetting = EnvironmentSetting::findOrFail($id);

        return view('backend\casino-setting.environment-settings.show', compact('environmentsetting'));
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
        $environmentsetting = EnvironmentSetting::findOrFail($id);

        return view('backend\casino-setting.environment-settings.edit', compact('environmentsetting'));
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

        $environmentsetting = EnvironmentSetting::findOrFail($id);
        $environmentsetting->update($requestData);

        return redirect('environment-settings')->with('flash_message', 'EnvironmentSetting updated!');
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
        EnvironmentSetting::destroy($id);

        return redirect('environment-settings')->with('flash_message', 'EnvironmentSetting deleted!');
    }
}
