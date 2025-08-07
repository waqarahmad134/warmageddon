<?php

namespace App\Http\Controllers\Backend\Maintenance;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ClearTournament;
use Illuminate\Http\Request;

class ClearTournamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.maintenance.clear-tournaments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.maintenance.clear-tournaments.create');
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

        ClearTournament::create($requestData);

        return redirect('clear-tournaments')->with('flash_message', 'ClearTournament added!');
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
        $cleartournament = ClearTournament::findOrFail($id);

        return view('backend.maintenance.clear-tournaments.show', compact('cleartournament'));
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
        $cleartournament = ClearTournament::findOrFail($id);

        return view('backend.maintenance.clear-tournaments.edit', compact('cleartournament'));
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

        $cleartournament = ClearTournament::findOrFail($id);
        $cleartournament->update($requestData);

        return redirect('clear-tournaments')->with('flash_message', 'ClearTournament updated!');
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
        ClearTournament::destroy($id);

        return redirect('clear-tournaments')->with('flash_message', 'ClearTournament deleted!');
    }
}
