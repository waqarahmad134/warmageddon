<?php

namespace App\Http\Controllers\Backend\MultiTournaments;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FreeTicket;
use Illuminate\Http\Request;

class FreeTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-tournaments.free-tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-tournaments.free-tickets.create');
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

        FreeTicket::create($requestData);

        return redirect('free-tickets')->with('flash_message', 'FreeTicket added!');
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
        $freeticket = FreeTicket::findOrFail($id);

        return view('backend.multi-tournaments.free-tickets.show', compact('freeticket'));
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
        $freeticket = FreeTicket::findOrFail($id);

        return view('backend.multi-tournaments.free-tickets.edit', compact('freeticket'));
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

        $freeticket = FreeTicket::findOrFail($id);
        $freeticket->update($requestData);

        return redirect('free-tickets')->with('flash_message', 'FreeTicket updated!');
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
        FreeTicket::destroy($id);

        return redirect('free-tickets')->with('flash_message', 'FreeTicket deleted!');
    }
}
