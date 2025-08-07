<?php

namespace App\Http\Controllers\Backend\MultiPlayerCard;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CardSetting;
use Illuminate\Http\Request;

class CardSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-player-card.card-settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-player-card.card-settings.create');
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
        
        CardSetting::create($requestData);

        return redirect('card-settings')->with('flash_message', 'CardSetting added!');
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
        $cardsetting = CardSetting::findOrFail($id);

        return view('backend.multi-player-card.card-settings.show', compact('cardsetting'));
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
        $cardsetting = CardSetting::findOrFail($id);

        return view('backend.multi-player-card.card-settings.edit', compact('cardsetting'));
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
        
        $cardsetting = CardSetting::findOrFail($id);
        $cardsetting->update($requestData);

        return redirect('card-settings')->with('flash_message', 'CardSetting updated!');
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
        CardSetting::destroy($id);

        return redirect('card-settings')->with('flash_message', 'CardSetting deleted!');
    }
}
