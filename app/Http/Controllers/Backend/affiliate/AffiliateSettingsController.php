<?php

namespace App\Http\Controllers\Backend\affiliate;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AffiliateSetting;
use Illuminate\Http\Request;

class AffiliateSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.affiliate.affiliate-settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\affiliate.affiliate-settings.create');
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
            'mrp_players' => 'required',
            'mrp_month' => 'required|integer',
            'mrp_deposit' => 'required|integer',
            'affiliate_revenue' => 'required|integer',
            'affiliate_player_bonus' => 'required|integer',
            'affiliate_player_bonus_rollover' => 'required',
            'is_filterable' => 'sometimes|nullable|string',
        ]);
        $add_shop =new  AffiliateSetting();
        $add_shop->mrp_players=$request->mrp_players;
        $add_shop->mrp_month=$request->mrp_month;
        $add_shop->mrp_deposit=$request->mrp_deposit;
        $add_shop->affiliate_revenue=$request->affiliate_revenue;
        $add_shop->affiliate_player_bonus=$request->affiliate_player_bonus;
        $add_shop->affiliate_player_bonus_rollover=$request->affiliate_player_bonus_rollover;
        $add_shop->is_filterable=$request->is_filterable;
        $add_shop->save();
        Toastr::success('AffiliateSetting  added successfully','Success');
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
        $affiliatesetting = AffiliateSetting::findOrFail($id);

        return view('backend\affiliate.affiliate-settings.show', compact('affiliatesetting'));
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
        $affiliatesetting = AffiliateSetting::findOrFail($id);

        return view('backend\affiliate.affiliate-settings.edit', compact('affiliatesetting'));
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
        
        $affiliatesetting = AffiliateSetting::findOrFail($id);
        $affiliatesetting->update($requestData);

        return redirect('affiliate-settings')->with('flash_message', 'AffiliateSetting updated!');
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
        AffiliateSetting::destroy($id);

        return redirect('affiliate-settings')->with('flash_message', 'AffiliateSetting deleted!');
    }
}
