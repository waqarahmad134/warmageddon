<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DormantAccount;
use Illuminate\Http\Request;

class DormantAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.reports.dormant-account.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.reports.dormant-account.create');
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
        
        DormantAccount::create($requestData);

        return redirect('dormant-account')->with('flash_message', 'DormantAccount added!');
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
        $dormantaccount = DormantAccount::findOrFail($id);

        return view('backend.reports.dormant-account.show', compact('dormantaccount'));
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
        $dormantaccount = DormantAccount::findOrFail($id);

        return view('backend.reports.dormant-account.edit', compact('dormantaccount'));
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
        
        $dormantaccount = DormantAccount::findOrFail($id);
        $dormantaccount->update($requestData);

        return redirect('dormant-account')->with('flash_message', 'DormantAccount updated!');
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
        DormantAccount::destroy($id);

        return redirect('dormant-account')->with('flash_message', 'DormantAccount deleted!');
    }
}
