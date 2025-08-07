<?php

namespace App\Http\Controllers\Backend\Statistics;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CasinoActivity;
use Illuminate\Http\Request;

class CasinoActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.statistics.casino-activity.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.statistics.casino-activity.create');
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
        
        CasinoActivity::create($requestData);

        return redirect('casino-activity')->with('flash_message', 'CasinoActivity added!');
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
        $casinoactivity = CasinoActivity::findOrFail($id);

        return view('backend.statistics.casino-activity.show', compact('casinoactivity'));
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
        $casinoactivity = CasinoActivity::findOrFail($id);

        return view('backend.statistics.casino-activity.edit', compact('casinoactivity'));
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
        
        $casinoactivity = CasinoActivity::findOrFail($id);
        $casinoactivity->update($requestData);

        return redirect('casino-activity')->with('flash_message', 'CasinoActivity updated!');
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
        CasinoActivity::destroy($id);

        return redirect('casino-activity')->with('flash_message', 'CasinoActivity deleted!');
    }
}
