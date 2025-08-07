<?php

namespace App\Http\Controllers\Backend\MultiPlayerBingo;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\BingoSetting;
use Illuminate\Http\Request;

class BingoSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multiplayer-bingo-live.bingo-settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multiplayer-bingo-live.bingo-settings.create');
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
        
        BingoSetting::create($requestData);

        return redirect('bingo-settings')->with('flash_message', 'BingoSetting added!');
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
        $bingosetting = BingoSetting::findOrFail($id);

        return view('backend.multiplayer-bingo-live.bingo-settings.show', compact('bingosetting'));
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
        $bingosetting = BingoSetting::findOrFail($id);

        return view('backend.multiplayer-bingo-live.bingo-settings.edit', compact('bingosetting'));
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
        
        $bingosetting = BingoSetting::findOrFail($id);
        $bingosetting->update($requestData);

        return redirect('bingo-settings')->with('flash_message', 'BingoSetting updated!');
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
        BingoSetting::destroy($id);

        return redirect('bingo-settings')->with('flash_message', 'BingoSetting deleted!');
    }
}
