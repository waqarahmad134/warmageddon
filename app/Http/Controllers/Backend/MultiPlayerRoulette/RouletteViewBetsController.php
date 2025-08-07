<?php

namespace App\Http\Controllers\Backend\MultiPlayerRoulette;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\RouletteViewBet;
use Illuminate\Http\Request;

class RouletteViewBetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-player-roulette.roulette-view-bets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-player-roulette.roulette-view-bets.create');
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
        
        RouletteViewBet::create($requestData);

        return redirect('roulette-view-bets')->with('flash_message', 'RouletteViewBet added!');
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
        $rouletteviewbet = RouletteViewBet::findOrFail($id);

        return view('backend.multi-player-roulette.roulette-view-bets.show', compact('rouletteviewbet'));
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
        $rouletteviewbet = RouletteViewBet::findOrFail($id);

        return view('backend.multi-player-roulette.roulette-view-bets.edit', compact('rouletteviewbet'));
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
        
        $rouletteviewbet = RouletteViewBet::findOrFail($id);
        $rouletteviewbet->update($requestData);

        return redirect('roulette-view-bets')->with('flash_message', 'RouletteViewBet updated!');
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
        RouletteViewBet::destroy($id);

        return redirect('roulette-view-bets')->with('flash_message', 'RouletteViewBet deleted!');
    }
}
