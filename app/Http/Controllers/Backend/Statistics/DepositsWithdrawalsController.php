<?php

namespace App\Http\Controllers\Backend\Statistics;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DepositsWithdrawal;
use Illuminate\Http\Request;

class DepositsWithdrawalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.statistics.deposits-withdrawals.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.statistics.deposits-withdrawals.create');
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
        
        DepositsWithdrawal::create($requestData);

        return redirect('deposits-withdrawals')->with('flash_message', 'DepositsWithdrawal added!');
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
        $depositswithdrawal = DepositsWithdrawal::findOrFail($id);

        return view('backend.statistics.deposits-withdrawals.show', compact('depositswithdrawal'));
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
        $depositswithdrawal = DepositsWithdrawal::findOrFail($id);

        return view('backend.statistics.deposits-withdrawals.edit', compact('depositswithdrawal'));
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
        
        $depositswithdrawal = DepositsWithdrawal::findOrFail($id);
        $depositswithdrawal->update($requestData);

        return redirect('deposits-withdrawals')->with('flash_message', 'DepositsWithdrawal updated!');
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
        DepositsWithdrawal::destroy($id);

        return redirect('deposits-withdrawals')->with('flash_message', 'DepositsWithdrawal deleted!');
    }
}
