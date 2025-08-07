<?php

namespace App\Http\Controllers\Backend\SportsBook;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ReevaluateTicket;
use Illuminate\Http\Request;

class ReevaluateTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.sports-book.reevaluate-tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.sports-book.reevaluate-tickets.create');
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
        
        ReevaluateTicket::create($requestData);

        return redirect('reevaluate-tickets')->with('flash_message', 'ReevaluateTicket added!');
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
        $reevaluateticket = ReevaluateTicket::findOrFail($id);

        return view('backend.sports-book.reevaluate-tickets.show', compact('reevaluateticket'));
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
        $reevaluateticket = ReevaluateTicket::findOrFail($id);

        return view('backend.sports-book.reevaluate-tickets.edit', compact('reevaluateticket'));
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
        
        $reevaluateticket = ReevaluateTicket::findOrFail($id);
        $reevaluateticket->update($requestData);

        return redirect('reevaluate-tickets')->with('flash_message', 'ReevaluateTicket updated!');
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
        ReevaluateTicket::destroy($id);

        return redirect('reevaluate-tickets')->with('flash_message', 'ReevaluateTicket deleted!');
    }
}
