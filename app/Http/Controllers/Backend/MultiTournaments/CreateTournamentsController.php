<?php

namespace App\Http\Controllers\Backend\MultiTournaments;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CreateTournament;
use Illuminate\Http\Request;

class CreateTournamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-tournaments.create-tournaments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-tournaments.create-tournaments.create');
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

        CreateTournament::create($requestData);

        return redirect('create-tournaments')->with('flash_message', 'CreateTournament added!');
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
        $createtournament = CreateTournament::findOrFail($id);

        return view('backend.multi-tournaments.create-tournaments.show', compact('createtournament'));
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
        $createtournament = CreateTournament::findOrFail($id);

        return view('backend.multi-tournaments.create-tournaments.edit', compact('createtournament'));
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

        $createtournament = CreateTournament::findOrFail($id);
        $createtournament->update($requestData);

        return redirect('create-tournaments')->with('flash_message', 'CreateTournament updated!');
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
        CreateTournament::destroy($id);

        return redirect('create-tournaments')->with('flash_message', 'CreateTournament deleted!');
    }
}
