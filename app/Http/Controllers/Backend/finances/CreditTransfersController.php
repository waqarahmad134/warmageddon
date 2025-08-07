<?php

namespace App\Http\Controllers\Backend\finances;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\User;
use App\CreditTransfer;
use Illuminate\Http\Request;

class CreditTransfersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $credit=User::latest()->get();
        return view('backend.finances.credit-transfers.index',compact('credit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\finances.credit-transfers.create');
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
            'transaction_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'comparisson_sign' => 'required',
            'amount' => 'required|integer',
            'player_username' => 'required',
            'agent_username' => 'sometimes|nullable',
            'credit_received' => 'sometimes|nullable',
            'credit_sent' => 'sometimes|nullable',
            'payments_for_affiliates' => 'sometimes|nullable',
            'refunded_gameplays' => 'sometimes|nullable',
            'exceeding_amount' => 'sometimes|nullable|string',
        ]);
        $credit_transfer =new  CreditTransfer();
        $credit_transfer->transaction_id=$request->transaction_id;
        $credit_transfer->start_date=$request->start_date;
        $credit_transfer->end_date=$request->end_date;
        $credit_transfer->comparisson_sign=$request->comparisson_sign;
        $credit_transfer->amount=$request->amount;
        $credit_transfer->player_username=$request->player_username;
        $credit_transfer->agent_username=$request->agent_username;
        $credit_transfer->credit_received=$request->credit_received;
        $credit_transfer->credit_sent=$request->credit_sent;
        $credit_transfer->payments_for_affiliates=$request->payments_for_affiliates;
        $credit_transfer->refunded_gameplays=$request->refunded_gameplays;
        $credit_transfer->exceeding_amount=$request->exceeding_amount;
        $credit_transfer->save();
        Toastr::success('Credit transfer added!','Success');
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
        $credittransfer = CreditTransfer::findOrFail($id);

        return view('backend\finances.credit-transfers.show', compact('credittransfer'));
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
        $credittransfer = CreditTransfer::findOrFail($id);

        return view('backend\finances.credit-transfers.edit', compact('credittransfer'));
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

        $credittransfer = CreditTransfer::findOrFail($id);
        $credittransfer->update($requestData);

        return redirect('credit-transfers')->with('flash_message', 'CreditTransfer updated!');
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
        CreditTransfer::destroy($id);

        return redirect('credit-transfers')->with('flash_message', 'CreditTransfer deleted!');
    }
}
