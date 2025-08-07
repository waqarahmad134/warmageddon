<?php

namespace App\Http\Controllers\Backend\Other;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ListSupportTicket;
use Illuminate\Http\Request;

class ListSupportTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.other.list-support-tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.other.list-support-tickets.create');
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
        
        ListSupportTicket::create($requestData);

        return redirect('list-support-tickets')->with('flash_message', 'ListSupportTicket added!');
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
        $listsupportticket = ListSupportTicket::findOrFail($id);

        return view('backend.other.list-support-tickets.show', compact('listsupportticket'));
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
        $listsupportticket = ListSupportTicket::findOrFail($id);

        return view('backend.other.list-support-tickets.edit', compact('listsupportticket'));
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
        
        $listsupportticket = ListSupportTicket::findOrFail($id);
        $listsupportticket->update($requestData);

        return redirect('list-support-tickets')->with('flash_message', 'ListSupportTicket updated!');
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
        ListSupportTicket::destroy($id);

        return redirect('list-support-tickets')->with('flash_message', 'ListSupportTicket deleted!');
    }
}
