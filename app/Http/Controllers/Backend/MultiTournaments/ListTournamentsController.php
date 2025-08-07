<?php

namespace App\Http\Controllers\Backend\MultiTournaments;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ListTournament;
use Illuminate\Http\Request;

class ListTournamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('backend.multi-tournaments.list-tournaments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-tournaments.list-tournaments.create');
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

        ListTournament::create($requestData);

        return redirect('list-tournaments')->with('flash_message', 'ListTournament added!');
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

        return view('backend.multi-tournaments.list-tournaments.show');
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
        $listtournament = ListTournament::findOrFail($id);

        return view('backend.multi-tournaments.list-tournaments.edit', compact('listtournament'));
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

        $listtournament = ListTournament::findOrFail($id);
        $listtournament->update($requestData);

        return redirect('list-tournaments')->with('flash_message', 'ListTournament updated!');
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
        ListTournament::destroy($id);

        return redirect('list-tournaments')->with('flash_message', 'ListTournament deleted!');
    }
}
