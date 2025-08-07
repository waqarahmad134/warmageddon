<?php

namespace App\Http\Controllers\Backend\contentManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TemplateMap;
use Illuminate\Http\Request;

class TemplateMapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.content-management.template-map.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\content-management.template-map.create');
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

        TemplateMap::create($requestData);

        return redirect('template-map')->with('flash_message', 'TemplateMap added!');
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
        $templatemap = TemplateMap::findOrFail($id);

        return view('backend\content-management.template-map.show', compact('templatemap'));
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
        $templatemap = TemplateMap::findOrFail($id);

        return view('backend\content-management.template-map.edit', compact('templatemap'));
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

        $templatemap = TemplateMap::findOrFail($id);
        $templatemap->update($requestData);

        return redirect('template-map')->with('flash_message', 'TemplateMap updated!');
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
        TemplateMap::destroy($id);

        return redirect('template-map')->with('flash_message', 'TemplateMap deleted!');
    }
}
