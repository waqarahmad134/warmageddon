<?php

namespace App\Http\Controllers\Backend\SportsBook;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ConfigureLeague;
use Illuminate\Http\Request;

class ConfigureLeaguesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.sports-book.configure-leagues.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.sports-book.configure-leagues.create');
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
        
        ConfigureLeague::create($requestData);

        return redirect('configure-leagues')->with('flash_message', 'ConfigureLeague added!');
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
        $configureleague = ConfigureLeague::findOrFail($id);

        return view('backend.sports-book.configure-leagues.show', compact('configureleague'));
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
        $configureleague = ConfigureLeague::findOrFail($id);

        return view('backend.sports-book.configure-leagues.edit', compact('configureleague'));
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
        
        $configureleague = ConfigureLeague::findOrFail($id);
        $configureleague->update($requestData);

        return redirect('configure-leagues')->with('flash_message', 'ConfigureLeague updated!');
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
        ConfigureLeague::destroy($id);

        return redirect('configure-leagues')->with('flash_message', 'ConfigureLeague deleted!');
    }
}
