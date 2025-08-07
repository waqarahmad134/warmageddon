<?php

namespace App\Http\Controllers\Backend\affiliate;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SendPayment;
use Illuminate\Http\Request;

class SendPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
         $aff_payment=\App\ListAffiliate::latest()->get();
        return view('backend.affiliate.send-payments.index',compact('aff_payment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\affiliate.send-payments.create');
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
        
        SendPayment::create($requestData);

        return redirect('send-payments')->with('flash_message', 'SendPayment added!');
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

        //$sendpayment = SendPayment::findOrFail($id);

        return view('backend.affiliate.send-payments.show');
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
        $sendpayment = SendPayment::findOrFail($id);

        return view('backend\affiliate.send-payments.edit', compact('sendpayment'));
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
        
        $sendpayment = SendPayment::findOrFail($id);
        $sendpayment->update($requestData);

        return redirect('send-payments')->with('flash_message', 'SendPayment updated!');
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
        SendPayment::destroy($id);

        return redirect('send-payments')->with('flash_message', 'SendPayment deleted!');
    }
}
