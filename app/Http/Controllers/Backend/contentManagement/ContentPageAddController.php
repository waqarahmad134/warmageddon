<?php

namespace App\Http\Controllers\Backend\contentManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ContentPageAdd;
use Illuminate\Http\Request;

class ContentPageAddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('backend.content-management.content-page-add.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\content-management.content-page-add.create');
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

        ContentPageAdd::create($requestData);

        return redirect('content-page-add')->with('flash_message', 'ContentPageAdd added!');
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
        $contentpageadd = ContentPageAdd::findOrFail($id);

        return view('backend\content-management.content-page-add.show', compact('contentpageadd'));
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
        $contentpageadd = ContentPageAdd::findOrFail($id);

        return view('backend\content-management.content-page-add.edit', compact('contentpageadd'));
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

        $contentpageadd = ContentPageAdd::findOrFail($id);
        $contentpageadd->update($requestData);

        return redirect('content-page-add')->with('flash_message', 'ContentPageAdd updated!');
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
        ContentPageAdd::destroy($id);

        return redirect('content-page-add')->with('flash_message', 'ContentPageAdd deleted!');
    }
}
