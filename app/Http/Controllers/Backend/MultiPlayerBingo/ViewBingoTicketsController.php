<?php

namespace App\Http\Controllers\Backend\MultiPlayerBingo;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ViewBingoTicket;
use Illuminate\Http\Request;

class ViewBingoTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multiplayer-bingo-live.view-bingo-tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multiplayer-bingo-live.view-bingo-tickets.create');
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
        
        ViewBingoTicket::create($requestData);

        return redirect('view-bingo-tickets')->with('flash_message', 'ViewBingoTicket added!');
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
        $viewbingoticket = ViewBingoTicket::findOrFail($id);

        return view('backend.multiplayer-bingo-live.view-bingo-tickets.show', compact('viewbingoticket'));
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
        $viewbingoticket = ViewBingoTicket::findOrFail($id);

        return view('backend.multiplayer-bingo-live.view-bingo-tickets.edit', compact('viewbingoticket'));
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
        
        $viewbingoticket = ViewBingoTicket::findOrFail($id);
        $viewbingoticket->update($requestData);

        return redirect('view-bingo-tickets')->with('flash_message', 'ViewBingoTicket updated!');
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
        ViewBingoTicket::destroy($id);

        return redirect('view-bingo-tickets')->with('flash_message', 'ViewBingoTicket deleted!');
    }
}
