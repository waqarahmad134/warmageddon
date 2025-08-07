<?php

namespace App\Http\Controllers\Backend\Maintenance;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FileIntegrityList;
use Illuminate\Http\Request;

class FileIntegrityListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.maintenance.file-integrity-lists.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.maintenance.file-integrity-lists.create');
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

        FileIntegrityList::create($requestData);

        return redirect('file-integrity-lists')->with('flash_message', 'FileIntegrityList added!');
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
        $fileintegritylist = FileIntegrityList::findOrFail($id);

        return view('backend.maintenance.file-integrity-lists.show', compact('fileintegritylist'));
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
        $fileintegritylist = FileIntegrityList::findOrFail($id);

        return view('backend.maintenance.file-integrity-lists.edit', compact('fileintegritylist'));
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

        $fileintegritylist = FileIntegrityList::findOrFail($id);
        $fileintegritylist->update($requestData);

        return redirect('file-integrity-lists')->with('flash_message', 'FileIntegrityList updated!');
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
        FileIntegrityList::destroy($id);

        return redirect('file-integrity-lists')->with('flash_message', 'FileIntegrityList deleted!');
    }
}
