<?php

namespace App\Http\Controllers\Backend\MultiPlayerCard;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ViewBet;
use Illuminate\Http\Request;

class ViewBetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-player-card.view-bets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-player-card.view-bets.create');
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
        
        ViewBet::create($requestData);

        return redirect('view-bets')->with('flash_message', 'ViewBet added!');
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
        $viewbet = ViewBet::findOrFail($id);

        return view('backend.multi-player-card.view-bets.show', compact('viewbet'));
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
        $viewbet = ViewBet::findOrFail($id);

        return view('backend.multi-player-card.view-bets.edit', compact('viewbet'));
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
        
        $viewbet = ViewBet::findOrFail($id);
        $viewbet->update($requestData);

        return redirect('view-bets')->with('flash_message', 'ViewBet updated!');
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
        ViewBet::destroy($id);

        return redirect('view-bets')->with('flash_message', 'ViewBet deleted!');
    }
}
