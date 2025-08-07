<?php

namespace App\Http\Controllers\Backend\bonus1;

use App\Bonus;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\PropersixBonus;
use App\ListBonus;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ListBonusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $bonus_code=PropersixBonus::where('status','!=',2)->orderByDesc('created_at')->get();
        return view('backend.bonus.list-bonuses.index',compact('bonus_code'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user =  User::role('User')->get();
        $games =  AddGame::where('status','on')->orderBy('order','desc')->get();
        $deposit_bonus = PropersixBonus::where('type','deposit')->latest()->get();
        return view('backend.bonus.list-bonuses.create', compact('user','games','deposit_bonus'));

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

        ListBonus::create($requestData);

        return redirect('list-bonuses')->with('flash_message', 'ListBonus added!');
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
        $bonus_code=AddBonus::findOrFail($id);
        return view('backend.bonus.list-bonuses.show',compact('bonus_code'));
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
        $listbonus = PropersixBonus::findOrFail($id);

        return view('backend.bonus.list-bonuses.edit', compact('listbonus'));
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

        $listbonus = ListBonus::findOrFail($id);
        $listbonus->update($requestData);

        return redirect('list-bonuses')->with('flash_message', 'ListBonus updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function bonus_list()
    {
        $bonus_list            = Bonus::where('add_bonus_id','!=',null)->with('add_bonus','user')->get();
        return view('backend.bonus.list-bonuses.bonusList',compact('bonus_list'));
    }
}
