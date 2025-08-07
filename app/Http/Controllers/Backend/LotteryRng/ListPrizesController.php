<?php

namespace App\Http\Controllers\Backend\LotteryRng;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ListPrize;
use Illuminate\Http\Request;

class ListPrizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.Lottery-rng.list-prizes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\Lottery-rng.list-prizes.create');
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

        ListPrize::create($requestData);

        return redirect('list-prizes')->with('flash_message', 'ListPrize added!');
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
        $listprize = ListPrize::findOrFail($id);

        return view('backend\Lottery-rng.list-prizes.show', compact('listprize'));
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
        $listprize = ListPrize::findOrFail($id);

        return view('backend\Lottery-rng.list-prizes.edit', compact('listprize'));
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

        $listprize = ListPrize::findOrFail($id);
        $listprize->update($requestData);

        return redirect('list-prizes')->with('flash_message', 'ListPrize updated!');
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
        ListPrize::destroy($id);

        return redirect('list-prizes')->with('flash_message', 'ListPrize deleted!');
    }
}
