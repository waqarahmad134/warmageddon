<?php

namespace App\Http\Controllers\Backend\affiliate;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CompletedPayment;
use Illuminate\Http\Request;

class CompletedPaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('backend.affiliate.completed-payments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\affiliate.completed-payments.create');
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
        
        CompletedPayment::create($requestData);

        return redirect('completed-payments')->with('flash_message', 'CompletedPayment added!');
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
        $completedpayment = CompletedPayment::findOrFail($id);

        return view('backend\affiliate.completed-payments.show', compact('completedpayment'));
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
        $completedpayment = CompletedPayment::findOrFail($id);

        return view('backend\affiliate.completed-payments.edit', compact('completedpayment'));
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
        
        $completedpayment = CompletedPayment::findOrFail($id);
        $completedpayment->update($requestData);

        return redirect('completed-payments')->with('flash_message', 'CompletedPayment updated!');
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
        CompletedPayment::destroy($id);

        return redirect('completed-payments')->with('flash_message', 'CompletedPayment deleted!');
    }
}
