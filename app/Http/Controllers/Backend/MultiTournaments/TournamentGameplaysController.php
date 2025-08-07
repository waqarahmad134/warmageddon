<?php

namespace App\Http\Controllers\Backend\MultiTournaments;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TournamentGameplay;
use Illuminate\Http\Request;

class TournamentGameplaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-tournaments.tournament-gameplays.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-tournaments.tournament-gameplays.create');
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

        TournamentGameplay::create($requestData);

        return redirect('tournament-gameplays')->with('flash_message', 'TournamentGameplay added!');
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
        return view('backend.multi-tournaments.tournament-gameplays.show');
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
        $tournamentgameplay = TournamentGameplay::findOrFail($id);

        return view('backend.multi-tournaments.tournament-gameplays.edit', compact('tournamentgameplay'));
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

        $tournamentgameplay = TournamentGameplay::findOrFail($id);
        $tournamentgameplay->update($requestData);

        return redirect('tournament-gameplays')->with('flash_message', 'TournamentGameplay updated!');
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
        TournamentGameplay::destroy($id);

        return redirect('tournament-gameplays')->with('flash_message', 'TournamentGameplay deleted!');
    }
}
