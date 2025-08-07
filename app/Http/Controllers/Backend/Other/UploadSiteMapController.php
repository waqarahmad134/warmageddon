<?php

namespace App\Http\Controllers\Backend\Other;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\UploadSiteMap;
use Illuminate\Http\Request;

class UploadSiteMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.other.upload-site-map.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.other.upload-site-map.create');
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
        
        UploadSiteMap::create($requestData);

        return redirect('upload-site-map')->with('flash_message', 'UploadSiteMap added!');
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
        $uploadsitemap = UploadSiteMap::findOrFail($id);

        return view('backend.other.upload-site-map.show', compact('uploadsitemap'));
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
        $uploadsitemap = UploadSiteMap::findOrFail($id);

        return view('backend.other.upload-site-map.edit', compact('uploadsitemap'));
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
        
        $uploadsitemap = UploadSiteMap::findOrFail($id);
        $uploadsitemap->update($requestData);

        return redirect('upload-site-map')->with('flash_message', 'UploadSiteMap updated!');
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
        UploadSiteMap::destroy($id);

        return redirect('upload-site-map')->with('flash_message', 'UploadSiteMap deleted!');
    }
}
