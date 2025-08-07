<?php

namespace App\Http\Controllers\Backend\SportsBook;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SportsViewTicket;
use Illuminate\Http\Request;

class SportsViewTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.sports-book.sports-view-tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.sports-book.sports-view-tickets.create');
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
        
        SportsViewTicket::create($requestData);

        return redirect('sports-view-tickets')->with('flash_message', 'SportsViewTicket added!');
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
        $sportsviewticket = SportsViewTicket::findOrFail($id);

        return view('backend.sports-book.sports-view-tickets.show', compact('sportsviewticket'));
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
        $sportsviewticket = SportsViewTicket::findOrFail($id);

        return view('backend.sports-book.sports-view-tickets.edit', compact('sportsviewticket'));
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
        
        $sportsviewticket = SportsViewTicket::findOrFail($id);
        $sportsviewticket->update($requestData);

        return redirect('sports-view-tickets')->with('flash_message', 'SportsViewTicket updated!');
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
        SportsViewTicket::destroy($id);

        return redirect('sports-view-tickets')->with('flash_message', 'SportsViewTicket deleted!');
    }
}
