<?php

namespace App\Http\Controllers\Backend\MultiPlayerCard;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CardViewResult;
use Illuminate\Http\Request;

class CardViewResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-player-card.card-view-results.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-player-card.card-view-results.create');
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
        
        CardViewResult::create($requestData);

        return redirect('card-view-results')->with('flash_message', 'CardViewResult added!');
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
        $cardviewresult = CardViewResult::findOrFail($id);

        return view('backend.multi-player-card.card-view-results.show', compact('cardviewresult'));
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
        $cardviewresult = CardViewResult::findOrFail($id);

        return view('backend.multi-player-card.card-view-results.edit', compact('cardviewresult'));
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
        
        $cardviewresult = CardViewResult::findOrFail($id);
        $cardviewresult->update($requestData);

        return redirect('card-view-results')->with('flash_message', 'CardViewResult updated!');
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
        CardViewResult::destroy($id);

        return redirect('card-view-results')->with('flash_message', 'CardViewResult deleted!');
    }
}
