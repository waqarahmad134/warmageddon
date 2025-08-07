<?php

namespace App\Http\Controllers\Backend\contentManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ContentPageList;
use Illuminate\Http\Request;

class ContentPageListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {


        return view('backend.content-management.content-page-list.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\content-management.content-page-list.create');
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

        ContentPageList::create($requestData);

        return redirect('content-page-list')->with('flash_message', 'ContentPageList added!');
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
        $contentpagelist = ContentPageList::findOrFail($id);

        return view('backend\content-management.content-page-list.show', compact('contentpagelist'));
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
        $contentpagelist = ContentPageList::findOrFail($id);

        return view('backend\content-management.content-page-list.edit', compact('contentpagelist'));
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

        $contentpagelist = ContentPageList::findOrFail($id);
        $contentpagelist->update($requestData);

        return redirect('content-page-list')->with('flash_message', 'ContentPageList updated!');
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
        ContentPageList::destroy($id);

        return redirect('content-page-list')->with('flash_message', 'ContentPageList deleted!');
    }
}
