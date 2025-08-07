<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TaxedGamePlay;
use Illuminate\Http\Request;

class TaxedGamePlaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.reports.taxed-game-plays.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.reports.taxed-game-plays.create');
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
        
        TaxedGamePlay::create($requestData);

        return redirect('taxed-game-plays')->with('flash_message', 'TaxedGamePlay added!');
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
        $taxedgameplay = TaxedGamePlay::findOrFail($id);

        return view('backend.reports.taxed-game-plays.show', compact('taxedgameplay'));
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
        $taxedgameplay = TaxedGamePlay::findOrFail($id);

        return view('backend.reports.taxed-game-plays.edit', compact('taxedgameplay'));
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
        
        $taxedgameplay = TaxedGamePlay::findOrFail($id);
        $taxedgameplay->update($requestData);

        return redirect('taxed-game-plays')->with('flash_message', 'TaxedGamePlay updated!');
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
        TaxedGamePlay::destroy($id);

        return redirect('taxed-game-plays')->with('flash_message', 'TaxedGamePlay deleted!');
    }
}
