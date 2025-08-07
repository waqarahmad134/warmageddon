<?php

namespace App\Http\Controllers\Backend\contentManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\EmailTemplatesList;
use Illuminate\Http\Request;

class EmailTemplatesListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.content-management.email-templates-list.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\content-management.email-templates-list.create');
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

        EmailTemplatesList::create($requestData);

        return redirect('email-templates-list')->with('flash_message', 'EmailTemplatesList added!');
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
        $emailtemplateslist = EmailTemplatesList::findOrFail($id);

        return view('backend\content-management.email-templates-list.show', compact('emailtemplateslist'));
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
        $emailtemplateslist = EmailTemplatesList::findOrFail($id);

        return view('backend\content-management.email-templates-list.edit', compact('emailtemplateslist'));
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

        $emailtemplateslist = EmailTemplatesList::findOrFail($id);
        $emailtemplateslist->update($requestData);

        return redirect('email-templates-list')->with('flash_message', 'EmailTemplatesList updated!');
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
        EmailTemplatesList::destroy($id);

        return redirect('email-templates-list')->with('flash_message', 'EmailTemplatesList deleted!');
    }
}
