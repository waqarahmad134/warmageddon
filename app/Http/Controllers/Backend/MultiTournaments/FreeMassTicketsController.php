<?php

namespace App\Http\Controllers\Backend\MultiTournaments;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FreeMassTicket;
use Illuminate\Http\Request;

class FreeMassTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-tournaments.free-mass-tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-tournaments.free-mass-tickets.create');
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

        FreeMassTicket::create($requestData);

        return redirect('free-mass-tickets')->with('flash_message', 'FreeMassTicket added!');
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
        $freemassticket = FreeMassTicket::findOrFail($id);

        return view('backend.multi-tournaments.free-mass-tickets.show', compact('freemassticket'));
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
        $freemassticket = FreeMassTicket::findOrFail($id);

        return view('backend.multi-tournaments.free-mass-tickets.edit', compact('freemassticket'));
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

        $freemassticket = FreeMassTicket::findOrFail($id);
        $freemassticket->update($requestData);

        return redirect('free-mass-tickets')->with('flash_message', 'FreeMassTicket updated!');
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
        FreeMassTicket::destroy($id);

        return redirect('free-mass-tickets')->with('flash_message', 'FreeMassTicket deleted!');
    }
}
