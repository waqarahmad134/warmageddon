<?php

namespace App\Http\Controllers\Backend\Statistics;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\StatisticsDashboard;
use Illuminate\Http\Request;

class StatisticsDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.statistics.statistics-dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.statistics.statistics-dashboard.create');
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
        
        StatisticsDashboard::create($requestData);

        return redirect('statistics-dashboard')->with('flash_message', 'StatisticsDashboard added!');
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
        $statisticsdashboard = StatisticsDashboard::findOrFail($id);

        return view('backend.statistics.statistics-dashboard.show', compact('statisticsdashboard'));
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
        $statisticsdashboard = StatisticsDashboard::findOrFail($id);

        return view('backend.statistics.statistics-dashboard.edit', compact('statisticsdashboard'));
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
        
        $statisticsdashboard = StatisticsDashboard::findOrFail($id);
        $statisticsdashboard->update($requestData);

        return redirect('statistics-dashboard')->with('flash_message', 'StatisticsDashboard updated!');
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
        StatisticsDashboard::destroy($id);

        return redirect('statistics-dashboard')->with('flash_message', 'StatisticsDashboard deleted!');
    }
}
