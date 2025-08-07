<?php

namespace App\Http\Controllers\Backend\GamesManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Crap;
use Illuminate\Http\Request;

class CrapsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.games-management.craps.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.games-management.craps.create');
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
        
        Crap::create($requestData);

        return redirect('craps')->with('flash_message', 'Crap added!');
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
        $crap = Crap::findOrFail($id);

        return view('backend.games-management.craps.show', compact('crap'));
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
        $crap = Crap::findOrFail($id);

        return view('backend.games-management.craps.edit', compact('crap'));
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
        
        $crap = Crap::findOrFail($id);
        $crap->update($requestData);

        return redirect('craps')->with('flash_message', 'Crap updated!');
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
        Crap::destroy($id);

        return redirect('craps')->with('flash_message', 'Crap deleted!');
    }
}
