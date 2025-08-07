<?php

namespace App\Http\Controllers\Backend\MultiPlayerSicbo;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SicboViewBet;
use Illuminate\Http\Request;

class SicboViewBetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-player-sicbo.sicbo-view-bets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-player-sicbo.sicbo-view-bets.create');
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
        
        SicboViewBet::create($requestData);

        return redirect('sicbo-view-bets')->with('flash_message', 'SicboViewBet added!');
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
        $sicboviewbet = SicboViewBet::findOrFail($id);

        return view('backend.multi-player-sicbo.sicbo-view-bets.show', compact('sicboviewbet'));
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
        $sicboviewbet = SicboViewBet::findOrFail($id);

        return view('backend.multi-player-sicbo.sicbo-view-bets.edit', compact('sicboviewbet'));
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
        
        $sicboviewbet = SicboViewBet::findOrFail($id);
        $sicboviewbet->update($requestData);

        return redirect('sicbo-view-bets')->with('flash_message', 'SicboViewBet updated!');
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
        SicboViewBet::destroy($id);

        return redirect('sicbo-view-bets')->with('flash_message', 'SicboViewBet deleted!');
    }
}
