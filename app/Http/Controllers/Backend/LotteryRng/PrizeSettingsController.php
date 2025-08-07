<?php

namespace App\Http\Controllers\Backend\LotteryRng;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PrizeSetting;
use Illuminate\Http\Request;

class PrizeSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('backend.Lottery-rng.prize-settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\Lottery-rng.prize-settings.create');
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

        PrizeSetting::create($requestData);

        return redirect('prize-settings')->with('flash_message', 'PrizeSetting added!');
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
        $prizesetting = PrizeSetting::findOrFail($id);

        return view('backend\Lottery-rng.prize-settings.show', compact('prizesetting'));
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
        $prizesetting = PrizeSetting::findOrFail($id);

        return view('backend\Lottery-rng.prize-settings.edit', compact('prizesetting'));
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

        $prizesetting = PrizeSetting::findOrFail($id);
        $prizesetting->update($requestData);

        return redirect('prize-settings')->with('flash_message', 'PrizeSetting updated!');
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
        PrizeSetting::destroy($id);

        return redirect('prize-settings')->with('flash_message', 'PrizeSetting deleted!');
    }
}
