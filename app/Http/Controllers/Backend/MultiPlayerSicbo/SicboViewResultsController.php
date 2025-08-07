<?php

namespace App\Http\Controllers\Backend\MultiPlayerSicbo;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SicboViewResult;
use Illuminate\Http\Request;

class SicboViewResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multi-player-sicbo.sicbo-view-results.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multi-player-sicbo.sicbo-view-results.create');
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
        
        SicboViewResult::create($requestData);

        return redirect('sicbo-view-results')->with('flash_message', 'SicboViewResult added!');
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
        $sicboviewresult = SicboViewResult::findOrFail($id);

        return view('backend.multi-player-sicbo.sicbo-view-results.show', compact('sicboviewresult'));
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
        $sicboviewresult = SicboViewResult::findOrFail($id);

        return view('backend.multi-player-sicbo.sicbo-view-results.edit', compact('sicboviewresult'));
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
        
        $sicboviewresult = SicboViewResult::findOrFail($id);
        $sicboviewresult->update($requestData);

        return redirect('sicbo-view-results')->with('flash_message', 'SicboViewResult updated!');
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
        SicboViewResult::destroy($id);

        return redirect('sicbo-view-results')->with('flash_message', 'SicboViewResult deleted!');
    }
}
