<?php

namespace App\Http\Controllers\Backend\MultiPlayerRoulette;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\RouletteViewResult;
use Illuminate\Http\Request;

class RouletteViewResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-player-roulette.roulette-view-results.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-player-roulette.roulette-view-results.create');
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
        
        RouletteViewResult::create($requestData);

        return redirect('roulette-view-results')->with('flash_message', 'RouletteViewResult added!');
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
        $rouletteviewresult = RouletteViewResult::findOrFail($id);

        return view('backend.multi-player-roulette.roulette-view-results.show', compact('rouletteviewresult'));
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
        $rouletteviewresult = RouletteViewResult::findOrFail($id);

        return view('backend.multi-player-roulette.roulette-view-results.edit', compact('rouletteviewresult'));
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
        
        $rouletteviewresult = RouletteViewResult::findOrFail($id);
        $rouletteviewresult->update($requestData);

        return redirect('roulette-view-results')->with('flash_message', 'RouletteViewResult updated!');
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
        RouletteViewResult::destroy($id);

        return redirect('roulette-view-results')->with('flash_message', 'RouletteViewResult deleted!');
    }
}
