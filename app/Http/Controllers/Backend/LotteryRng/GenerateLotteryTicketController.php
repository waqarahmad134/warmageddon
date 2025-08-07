<?php

namespace App\Http\Controllers\Backend\LotteryRng;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\GenerateLotteryTicket;
use Illuminate\Http\Request;

class GenerateLotteryTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.Lottery-rng.generate-lottery-ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\Lottery-rng.generate-lottery-ticket.create');
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
            'username' => 'required|string',
            'nr_of_tickts' => 'required',
        ]);
        $requestData = $request->all();       
        GenerateLotteryTicket::create($requestData);
        Toastr::success('GenerateLotteryTicket added!','Success');
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
        $generatelotteryticket = GenerateLotteryTicket::findOrFail($id);

        return view('backend\Lottery-rng.generate-lottery-ticket.show', compact('generatelotteryticket'));
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
        $generatelotteryticket = GenerateLotteryTicket::findOrFail($id);

        return view('backend\Lottery-rng.generate-lottery-ticket.edit', compact('generatelotteryticket'));
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

        $generatelotteryticket = GenerateLotteryTicket::findOrFail($id);
        $generatelotteryticket->update($requestData);

        return redirect('generate-lottery-ticket')->with('flash_message', 'GenerateLotteryTicket updated!');
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
        GenerateLotteryTicket::destroy($id);

        return redirect('generate-lottery-ticket')->with('flash_message', 'GenerateLotteryTicket deleted!');
    }
}
