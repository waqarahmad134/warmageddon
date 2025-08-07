<?php

namespace App\Http\Controllers\Backend\Maintenance;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ResetAllJackpot;
use Illuminate\Http\Request;

class ResetAllJackpotsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('backend.maintenance.reset-all-jackpots.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.maintenance.reset-all-jackpots.create');
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

        ResetAllJackpot::create($requestData);

        return redirect('reset-all-jackpots')->with('flash_message', 'ResetAllJackpot added!');
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
        $resetalljackpot = ResetAllJackpot::findOrFail($id);

        return view('backend.maintenance.reset-all-jackpots.show', compact('resetalljackpot'));
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
        $resetalljackpot = ResetAllJackpot::findOrFail($id);

        return view('backend.maintenance.reset-all-jackpots.edit', compact('resetalljackpot'));
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

        $resetalljackpot = ResetAllJackpot::findOrFail($id);
        $resetalljackpot->update($requestData);

        return redirect('reset-all-jackpots')->with('flash_message', 'ResetAllJackpot updated!');
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
        ResetAllJackpot::destroy($id);

        return redirect('reset-all-jackpots')->with('flash_message', 'ResetAllJackpot deleted!');
    }
}
