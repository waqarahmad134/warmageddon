<?php

namespace App\Http\Controllers\Backend\GamesManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\BlackJack;
use Illuminate\Http\Request;

class BlackJackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.games-management.black-jack.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.games-management.black-jack.create');
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
        
        BlackJack::create($requestData);

        return redirect('black-jack')->with('flash_message', 'BlackJack added!');
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
        $blackjack = BlackJack::findOrFail($id);

        return view('backend.games-management.black-jack.show', compact('blackjack'));
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
        $blackjack = BlackJack::findOrFail($id);

        return view('backend.games-management.black-jack.edit', compact('blackjack'));
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
        
        $blackjack = BlackJack::findOrFail($id);
        $blackjack->update($requestData);

        return redirect('black-jack')->with('flash_message', 'BlackJack updated!');
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
        BlackJack::destroy($id);

        return redirect('black-jack')->with('flash_message', 'BlackJack deleted!');
    }
}
