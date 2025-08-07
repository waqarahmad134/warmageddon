<?php

namespace App\Http\Controllers\Backend\MultiPlayerRaces;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\RacesViewBet;
use Illuminate\Http\Request;

class RacesViewBetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('backend.multi-player-races.races-view-bets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-player-races.races-view-bets.create');
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
        
        RacesViewBet::create($requestData);

        return redirect('races-view-bets')->with('flash_message', 'RacesViewBet added!');
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
        $racesviewbet = RacesViewBet::findOrFail($id);

        return view('backend.multi-player-races.races-view-bets.show', compact('racesviewbet'));
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
        $racesviewbet = RacesViewBet::findOrFail($id);

        return view('backend.multi-player-races.races-view-bets.edit', compact('racesviewbet'));
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
        
        $racesviewbet = RacesViewBet::findOrFail($id);
        $racesviewbet->update($requestData);

        return redirect('races-view-bets')->with('flash_message', 'RacesViewBet updated!');
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
        RacesViewBet::destroy($id);

        return redirect('races-view-bets')->with('flash_message', 'RacesViewBet deleted!');
    }
}
