<?php

namespace App\Http\Controllers\Backend\StaffManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SearchStaff;
use Illuminate\Http\Request;

class SearchStaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.staff-management.search-staff.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.staff-management.search-staff.create');
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
        
        SearchStaff::create($requestData);

        return redirect('search-staff')->with('flash_message', 'SearchStaff added!');
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
        $searchstaff = SearchStaff::findOrFail($id);

        return view('backend.staff-management.search-staff.show', compact('searchstaff'));
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
        $searchstaff = SearchStaff::findOrFail($id);

        return view('backend.staff-management.search-staff.edit', compact('searchstaff'));
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
        
        $searchstaff = SearchStaff::findOrFail($id);
        $searchstaff->update($requestData);

        return redirect('search-staff')->with('flash_message', 'SearchStaff updated!');
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
        SearchStaff::destroy($id);

        return redirect('search-staff')->with('flash_message', 'SearchStaff deleted!');
    }
}
