<?php

namespace App\Http\Controllers\Backend\MultiPlayerBingo;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ViewBingoResult;
use Illuminate\Http\Request;

class ViewBingoResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.multiplayer-bingo-live.view-bingo-results.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.multiplayer-bingo-live.view-bingo-results.create');
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
        
        ViewBingoResult::create($requestData);

        return redirect('view-bingo-results')->with('flash_message', 'ViewBingoResult added!');
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
        $viewbingoresult = ViewBingoResult::findOrFail($id);

        return view('backend.multiplayer-bingo-live.view-bingo-results.show', compact('viewbingoresult'));
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
        $viewbingoresult = ViewBingoResult::findOrFail($id);

        return view('backend.multiplayer-bingo-live.view-bingo-results.edit', compact('viewbingoresult'));
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
        
        $viewbingoresult = ViewBingoResult::findOrFail($id);
        $viewbingoresult->update($requestData);

        return redirect('view-bingo-results')->with('flash_message', 'ViewBingoResult updated!');
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
        ViewBingoResult::destroy($id);

        return redirect('view-bingo-results')->with('flash_message', 'ViewBingoResult deleted!');
    }
}
