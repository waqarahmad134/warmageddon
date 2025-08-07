<?php

namespace App\Http\Controllers\Backend\MultiTournaments;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ViewAllTicket;
use Illuminate\Http\Request;

class ViewAllTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-tournaments.view-all-tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-tournaments.view-all-tickets.create');
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

        ViewAllTicket::create($requestData);

        return redirect('view-all-tickets')->with('flash_message', 'ViewAllTicket added!');
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
        $viewallticket = ViewAllTicket::findOrFail($id);

        return view('backend.multi-tournaments.view-all-tickets.show', compact('viewallticket'));
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
        $viewallticket = ViewAllTicket::findOrFail($id);

        return view('backend.multi-tournaments.view-all-tickets.edit', compact('viewallticket'));
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

        $viewallticket = ViewAllTicket::findOrFail($id);
        $viewallticket->update($requestData);

        return redirect('view-all-tickets')->with('flash_message', 'ViewAllTicket updated!');
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
        ViewAllTicket::destroy($id);

        return redirect('view-all-tickets')->with('flash_message', 'ViewAllTicket deleted!');
    }
}
