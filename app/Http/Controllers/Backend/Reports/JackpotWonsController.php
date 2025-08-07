<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\JackpotWon;
use Illuminate\Http\Request;

class JackpotWonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.reports.jackpot-wons.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.reports.jackpot-wons.create');
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
        
        JackpotWon::create($requestData);

        return redirect('jackpot-wons')->with('flash_message', 'JackpotWon added!');
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
        $jackpotwon = JackpotWon::findOrFail($id);

        return view('backend.reports.jackpot-wons.show', compact('jackpotwon'));
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
        $jackpotwon = JackpotWon::findOrFail($id);

        return view('backend.reports.jackpot-wons.edit', compact('jackpotwon'));
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
        
        $jackpotwon = JackpotWon::findOrFail($id);
        $jackpotwon->update($requestData);

        return redirect('jackpot-wons')->with('flash_message', 'JackpotWon updated!');
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
        JackpotWon::destroy($id);

        return redirect('jackpot-wons')->with('flash_message', 'JackpotWon deleted!');
    }
}
