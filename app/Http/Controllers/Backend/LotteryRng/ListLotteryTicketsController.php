<?php

namespace App\Http\Controllers\Backend\LotteryRng;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ListLotteryTicket;
use Illuminate\Http\Request;

class ListLotteryTicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.Lottery-rng.list-lottery-tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\Lottery-rng.list-lottery-tickets.create');
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

        ListLotteryTicket::create($requestData);

        return redirect('list-lottery-tickets')->with('flash_message', 'ListLotteryTicket added!');
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
        $listlotteryticket = ListLotteryTicket::findOrFail($id);

        return view('backend\Lottery-rng.list-lottery-tickets.show', compact('listlotteryticket'));
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
        $listlotteryticket = ListLotteryTicket::findOrFail($id);

        return view('backend\Lottery-rng.list-lottery-tickets.edit', compact('listlotteryticket'));
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

        $listlotteryticket = ListLotteryTicket::findOrFail($id);
        $listlotteryticket->update($requestData);

        return redirect('list-lottery-tickets')->with('flash_message', 'ListLotteryTicket updated!');
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
        ListLotteryTicket::destroy($id);

        return redirect('list-lottery-tickets')->with('flash_message', 'ListLotteryTicket deleted!');
    }
}
