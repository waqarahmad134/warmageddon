<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\JackpotConfig;
use Illuminate\Http\Request;

class JackpotConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.reports.jackpot-config.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.reports.jackpot-config.create');
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
        
        JackpotConfig::create($requestData);

        return redirect('jackpot-config')->with('flash_message', 'JackpotConfig added!');
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
        $jackpotconfig = JackpotConfig::findOrFail($id);

        return view('backend.reports.jackpot-config.show', compact('jackpotconfig'));
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
        $jackpotconfig = JackpotConfig::findOrFail($id);

        return view('backend.reports.jackpot-config.edit', compact('jackpotconfig'));
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
        
        $jackpotconfig = JackpotConfig::findOrFail($id);
        $jackpotconfig->update($requestData);

        return redirect('jackpot-config')->with('flash_message', 'JackpotConfig updated!');
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
        JackpotConfig::destroy($id);

        return redirect('jackpot-config')->with('flash_message', 'JackpotConfig deleted!');
    }
}
