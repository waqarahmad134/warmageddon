<?php

namespace App\Http\Controllers\Backend\affiliate;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ListAffiliate;
use Illuminate\Http\Request;

class ListAffiliatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $listaffiliate=ListAffiliate::latest()->get();
        return view('backend.affiliate.list-affiliates.index',compact('listaffiliate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\affiliate.list-affiliates.create');
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
        
        ListAffiliate::create($requestData);

        return redirect('list-affiliates')->with('flash_message', 'ListAffiliate added!');
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
        $listaffiliate = ListAffiliate::findOrFail($id);

        return view('backend\affiliate.list-affiliates.show', compact('listaffiliate'));
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
        $listaffiliate = ListAffiliate::findOrFail($id);

        return view('backend\affiliate.list-affiliates.edit', compact('listaffiliate'));
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
        
        $listaffiliate = ListAffiliate::findOrFail($id);
        $listaffiliate->update($requestData);

        return redirect('list-affiliates')->with('flash_message', 'ListAffiliate updated!');
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
        ListAffiliate::destroy($id);

        return redirect('list-affiliates')->with('flash_message', 'ListAffiliate deleted!');
    }
}
