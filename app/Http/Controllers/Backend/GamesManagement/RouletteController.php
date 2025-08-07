<?php

namespace App\Http\Controllers\Backend\GamesManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Roulette;
use Illuminate\Http\Request;

class RouletteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.games-management.roulette.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.games-management.roulette.create');
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
        
        Roulette::create($requestData);

        return redirect('roulette')->with('flash_message', 'Roulette added!');
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
        $roulette = Roulette::findOrFail($id);

        return view('backend.games-management.roulette.show', compact('roulette'));
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
        $roulette = Roulette::findOrFail($id);

        return view('backend.games-management.roulette.edit', compact('roulette'));
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
        
        $roulette = Roulette::findOrFail($id);
        $roulette->update($requestData);

        return redirect('roulette')->with('flash_message', 'Roulette updated!');
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
        Roulette::destroy($id);

        return redirect('roulette')->with('flash_message', 'Roulette deleted!');
    }
}
