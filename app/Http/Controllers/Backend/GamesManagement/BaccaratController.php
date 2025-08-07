<?php

namespace App\Http\Controllers\Backend\GamesManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Baccarat;
use Illuminate\Http\Request;

class BaccaratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.games-management.baccarat.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.games-management.baccarat.create');
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
        
        Baccarat::create($requestData);

        return redirect('baccarat')->with('flash_message', 'Baccarat added!');
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
        $baccarat = Baccarat::findOrFail($id);

        return view('backend.games-management.baccarat.show', compact('baccarat'));
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
        $baccarat = Baccarat::findOrFail($id);

        return view('backend.games-management.baccarat.edit', compact('baccarat'));
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
        
        $baccarat = Baccarat::findOrFail($id);
        $baccarat->update($requestData);

        return redirect('baccarat')->with('flash_message', 'Baccarat updated!');
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
        Baccarat::destroy($id);

        return redirect('baccarat')->with('flash_message', 'Baccarat deleted!');
    }
}
