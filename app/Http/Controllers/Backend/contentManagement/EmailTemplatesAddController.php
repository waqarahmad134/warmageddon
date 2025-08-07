<?php

namespace App\Http\Controllers\Backend\contentManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\EmailTemplatesAdd;
use Illuminate\Http\Request;

class EmailTemplatesAddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.content-management.email-templates-add.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\content-management.email-templates-add.create');
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

        EmailTemplatesAdd::create($requestData);

        return redirect('email-templates-add')->with('flash_message', 'EmailTemplatesAdd added!');
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
        $emailtemplatesadd = EmailTemplatesAdd::findOrFail($id);

        return view('backend\content-management.email-templates-add.show', compact('emailtemplatesadd'));
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
        $emailtemplatesadd = EmailTemplatesAdd::findOrFail($id);

        return view('backend\content-management.email-templates-add.edit', compact('emailtemplatesadd'));
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

        $emailtemplatesadd = EmailTemplatesAdd::findOrFail($id);
        $emailtemplatesadd->update($requestData);

        return redirect('email-templates-add')->with('flash_message', 'EmailTemplatesAdd updated!');
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
        EmailTemplatesAdd::destroy($id);

        return redirect('email-templates-add')->with('flash_message', 'EmailTemplatesAdd deleted!');
    }
}
