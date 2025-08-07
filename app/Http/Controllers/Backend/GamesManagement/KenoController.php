<?php

namespace App\Http\Controllers\Backend\GamesManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Keno;
use Illuminate\Http\Request;

class KenoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.games-management.keno.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.games-management.keno.create');
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
        
        Keno::create($requestData);

        return redirect('keno')->with('flash_message', 'Keno added!');
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
        $keno = Keno::findOrFail($id);

        return view('backend.games-management.keno.show', compact('keno'));
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
        $keno = Keno::findOrFail($id);

        return view('backend.games-management.keno.edit', compact('keno'));
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
        
        $keno = Keno::findOrFail($id);
        $keno->update($requestData);

        return redirect('keno')->with('flash_message', 'Keno updated!');
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
        Keno::destroy($id);

        return redirect('keno')->with('flash_message', 'Keno deleted!');
    }
}
