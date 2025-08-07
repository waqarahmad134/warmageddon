<?php

namespace App\Http\Controllers\Backend\contentManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\LinkManager;
use Illuminate\Http\Request;

class LinkManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {


        return view('backend.content-management.link-manager.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\content-management.link-manager.create');
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

        LinkManager::create($requestData);

        return redirect('link-manager')->with('flash_message', 'LinkManager added!');
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
        $linkmanager = LinkManager::findOrFail($id);

        return view('backend\content-management.link-manager.show', compact('linkmanager'));
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
        $linkmanager = LinkManager::findOrFail($id);

        return view('backend\content-management.link-manager.edit', compact('linkmanager'));
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

        $linkmanager = LinkManager::findOrFail($id);
        $linkmanager->update($requestData);

        return redirect('link-manager')->with('flash_message', 'LinkManager updated!');
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
        LinkManager::destroy($id);

        return redirect('link-manager')->with('flash_message', 'LinkManager deleted!');
    }
}
