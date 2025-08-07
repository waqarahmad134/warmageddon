<?php

namespace App\Http\Controllers\Backend\Security;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\BanedipList;
use Illuminate\Http\Request;

class BanedipListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $ip_list =\App\BanIP::latest()->get();
        return view('backend.security.banedip-list.index',compact('ip_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.security.banedip-list.create');
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
        
        BanedipList::create($requestData);

        return redirect('banedip-list')->with('flash_message', 'BanedipList added!');
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
        $banediplist = BanedipList::findOrFail($id);

        return view('backend.security.banedip-list.show', compact('banediplist'));
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
        $banediplist = BanedipList::findOrFail($id);

        return view('backend.security.banedip-list.edit', compact('banediplist'));
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
        
        $banediplist = BanedipList::findOrFail($id);
        $banediplist->update($requestData);

        return redirect('banedip-list')->with('flash_message', 'BanedipList updated!');
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
        BanedipList::destroy($id);

        return redirect('banedip-list')->with('flash_message', 'BanedipList deleted!');
    }
}
