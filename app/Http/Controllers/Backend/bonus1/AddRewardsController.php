<?php

namespace App\Http\Controllers\Backend\bonus1;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AddReward;
use Illuminate\Http\Request;

class AddRewardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.bonus.add-rewards.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\bonus.add-rewards.create');
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
        $request->validate([
            'code' => 'required',
            'bonus_amount' => 'required|integer',
            'expire_date' => 'required',
            'type' => 'required',
            'status' => 'sometimes|nullable|string',
        ]);
        $add_bonuses=new AddReward();
        $add_bonuses->code=$request->code;
        $add_bonuses->bonus_amount=$request->bonus_amount;
        $add_bonuses->expire_date=$request->expire_date;
        $add_bonuses->type=$request->type;
        $add_bonuses->status=$request->status;
        $add_bonuses->save();
        Toastr::success('Reward added successfully','Success');
        return redirect()->back();
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
        $addreward = AddReward::findOrFail($id);

        return view('backend\bonus.add-rewards.show', compact('addreward'));
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
        $addreward = AddReward::findOrFail($id);
        return view('backend\bonus.add-rewards.edit', compact('addreward'));
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
        $request->validate([
            'code' => 'required',
            'bonus_amount' => 'required|integer',
            'expire_date' => 'required',
            'type' => 'required',
            'status' => 'sometimes|nullable|string',
        ]);
        $addreward = AddReward::findOrFail($id);
        $addreward->code=$request->code;
        $addreward->bonus_amount=$request->bonus_amount;
        $addreward->expire_date=$request->expire_date;
        $addreward->type=$request->type;
        $addreward->status=$request->status;
        $addreward->save();
        Toastr::success('Reward updated successfully','Success');
        return redirect()->back();
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
        AddReward::destroy($id);

        return redirect('add-rewards')->with('flash_message', 'AddReward deleted!');
    }
}
