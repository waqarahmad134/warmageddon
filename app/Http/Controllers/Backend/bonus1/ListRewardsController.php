<?php

namespace App\Http\Controllers\Backend\bonus1;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AddReward;
use App\ListReward;
use Illuminate\Http\Request;

class ListRewardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $reward=AddReward::latest()->get();
        return view('backend.bonus.list-rewards.index',compact('reward'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\bonus.list-rewards.create');
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

        ListReward::create($requestData);

        return redirect('list-rewards')->with('flash_message', 'ListReward added!');
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
        $listreward = ListReward::findOrFail($id);

        return view('backend\bonus.list-rewards.show', compact('listreward'));
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
        $listreward = ListReward::findOrFail($id);

        return view('backend\bonus.list-rewards.edit', compact('listreward'));
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

        $listreward = ListReward::findOrFail($id);
        $listreward->update($requestData);

        return redirect('list-rewards')->with('flash_message', 'ListReward updated!');
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
        ListReward::destroy($id);

        return redirect('list-rewards')->with('flash_message', 'ListReward deleted!');
    }
}
