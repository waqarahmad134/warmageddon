<?php

namespace App\Http\Controllers\Backend\StaffManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ListOperator;
use Illuminate\Http\Request;

class ListOperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $listOperator=\App\CreateOperator::latest()->get();
        return view('backend.staff-management.list-operator.index',compact('listOperator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.staff-management.list-operator.create');
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
        
        ListOperator::create($requestData);

        return redirect('list-operator')->with('flash_message', 'ListOperator added!');
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
        $listoperator = ListOperator::findOrFail($id);

        return view('backend.staff-management.list-operator.show', compact('listoperator'));
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
        $listoperator = ListOperator::findOrFail($id);

        return view('backend.staff-management.list-operator.edit', compact('listoperator'));
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
        
        $listoperator = ListOperator::findOrFail($id);
        $listoperator->update($requestData);

        return redirect('list-operator')->with('flash_message', 'ListOperator updated!');
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
        ListOperator::destroy($id);

        return redirect('list-operator')->with('flash_message', 'ListOperator deleted!');
    }
}
