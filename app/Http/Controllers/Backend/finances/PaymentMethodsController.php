<?php

namespace App\Http\Controllers\Backend\finances;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('backend.finances.payment-methods.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\finances.payment-methods.create');
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

        PaymentMethod::create($requestData);

        return redirect('payment-methods')->with('flash_message', 'PaymentMethod added!');
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
        $paymentmethod = PaymentMethod::findOrFail($id);

        return view('backend\finances.payment-methods.show', compact('paymentmethod'));
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
        $paymentmethod = PaymentMethod::findOrFail($id);

        return view('backend\finances.payment-methods.edit', compact('paymentmethod'));
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

        $paymentmethod = PaymentMethod::findOrFail($id);
        $paymentmethod->update($requestData);

        return redirect('payment-methods')->with('flash_message', 'PaymentMethod updated!');
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
        PaymentMethod::destroy($id);

        return redirect('payment-methods')->with('flash_message', 'PaymentMethod deleted!');
    }
}
