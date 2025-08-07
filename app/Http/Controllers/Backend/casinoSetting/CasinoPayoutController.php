<?php

namespace App\Http\Controllers\Backend\casinoSetting;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CasinoPayout;
use Illuminate\Http\Request;

class CasinoPayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.casino-setting.casino-payout.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\casino-setting.casino-payout.create');
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

        CasinoPayout::create($requestData);

        return redirect('casino-payout')->with('flash_message', 'CasinoPayout added!');
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
        $casinopayout = CasinoPayout::findOrFail($id);

        return view('backend\casino-setting.casino-payout.show', compact('casinopayout'));
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
        $casinopayout = CasinoPayout::findOrFail($id);

        return view('backend\casino-setting.casino-payout.edit', compact('casinopayout'));
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

        $casinopayout = CasinoPayout::findOrFail($id);
        $casinopayout->update($requestData);

        return redirect('casino-payout')->with('flash_message', 'CasinoPayout updated!');
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
        CasinoPayout::destroy($id);

        return redirect('casino-payout')->with('flash_message', 'CasinoPayout deleted!');
    }
}
