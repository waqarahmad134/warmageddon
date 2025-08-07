<?php

namespace App\Http\Controllers\Backend\bonus1;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AddBonus;
use App\User;
use Illuminate\Http\Request;

class ActivatedBonusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
       $bonus=User::latest()->get();
       /* dd($bonus->bonus->first()->add_bonus); */
        return view('backend.bonus.activated-bonuses.index',compact('bonus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.bonus.activated-bonuses.create');
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

        ActivatedBonus::create($requestData);

        return redirect('activated-bonuses')->with('flash_message', 'ActivatedBonus added!');
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
        return view('backend.bonus.activated-bonuses.show');
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
        $activatedbonus = ActivatedBonus::findOrFail($id);

        return view('backend.bonus.activated-bonuses.edit', compact('activatedbonus'));
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

        $activatedbonus = ActivatedBonus::findOrFail($id);
        $activatedbonus->update($requestData);

        return redirect('activated-bonuses')->with('flash_message', 'ActivatedBonus updated!');
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
        ActivatedBonus::destroy($id);

        return redirect('activated-bonuses')->with('flash_message', 'ActivatedBonus deleted!');
    }
}
