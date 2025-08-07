<?php

namespace App\Http\Controllers\Backend\LotteryRng;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PrizesGrantPrize;
use Illuminate\Http\Request;

class PrizesGrantPrizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.Lottery-rng.prizes-grant-prize.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\Lottery-rng.prizes-grant-prize.create');
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

        PrizesGrantPrize::create($requestData);

        return redirect('prizes-grant-prize')->with('flash_message', 'PrizesGrantPrize added!');
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
        $prizesgrantprize = PrizesGrantPrize::findOrFail($id);

        return view('backend\Lottery-rng.prizes-grant-prize.show', compact('prizesgrantprize'));
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
        $prizesgrantprize = PrizesGrantPrize::findOrFail($id);

        return view('backend\Lottery-rng.prizes-grant-prize.edit', compact('prizesgrantprize'));
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

        $prizesgrantprize = PrizesGrantPrize::findOrFail($id);
        $prizesgrantprize->update($requestData);

        return redirect('prizes-grant-prize')->with('flash_message', 'PrizesGrantPrize updated!');
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
        PrizesGrantPrize::destroy($id);

        return redirect('prizes-grant-prize')->with('flash_message', 'PrizesGrantPrize deleted!');
    }
}
