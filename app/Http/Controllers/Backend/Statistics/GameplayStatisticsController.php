<?php

namespace App\Http\Controllers\Backend\Statistics;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GameplayStatistic;
use Illuminate\Http\Request;

class GameplayStatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.statistics.gameplay-statistics.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.statistics.gameplay-statistics.create');
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
        
        GameplayStatistic::create($requestData);

        return redirect('gameplay-statistics')->with('flash_message', 'GameplayStatistic added!');
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
        $gameplaystatistic = GameplayStatistic::findOrFail($id);

        return view('backend.statistics.gameplay-statistics.show', compact('gameplaystatistic'));
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
        $gameplaystatistic = GameplayStatistic::findOrFail($id);

        return view('backend.statistics.gameplay-statistics.edit', compact('gameplaystatistic'));
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
        
        $gameplaystatistic = GameplayStatistic::findOrFail($id);
        $gameplaystatistic->update($requestData);

        return redirect('gameplay-statistics')->with('flash_message', 'GameplayStatistic updated!');
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
        GameplayStatistic::destroy($id);

        return redirect('gameplay-statistics')->with('flash_message', 'GameplayStatistic deleted!');
    }
}
