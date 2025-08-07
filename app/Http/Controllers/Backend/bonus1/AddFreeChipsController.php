<?php

namespace App\Http\Controllers\Backend\bonus1;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AddFreeChip;
use Illuminate\Http\Request;

class AddFreeChipsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.bonus.add-free-chips.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\bonus.add-free-chips.create');
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
            'user_name' => 'required',
            'bonus_amount' => 'required|integer',
            'unlock_bonus_time' => 'required|integer',
            'total_amount' => 'required|integer',
            'bonus_mode' => 'required',
            'status' => 'sometimes|nullable|string',
        ]);
        $add_bonuses=new AddFreeChip();
        $add_bonuses->user_name=$request->user_name;
        $add_bonuses->bonus_amount=$request->bonus_amount;
        $add_bonuses->unlock_bonus_time=$request->unlock_bonus_time;
        $add_bonuses->total_amount=$request->total_amount;
        $add_bonuses->bonus_mode=$request->bonus_mode;
        $add_bonuses->status=$request->status;
        $add_bonuses->save();
        Toastr::success('Free tokens transferred successfully','Success');
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
        $addfreechip = AddFreeChip::findOrFail($id);

        return view('backend\bonus.add-free-chips.show', compact('addfreechip'));
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
        $addfreechip = AddFreeChip::findOrFail($id);

        return view('backend\bonus.add-free-chips.edit', compact('addfreechip'));
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

        $addfreechip = AddFreeChip::findOrFail($id);
        $addfreechip->update($requestData);

        return redirect('add-free-chips')->with('flash_message', 'AddFreeChip updated!');
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
        AddFreeChip::destroy($id);

        return redirect('add-free-chips')->with('flash_message', 'AddFreeChip deleted!');
    }
}
