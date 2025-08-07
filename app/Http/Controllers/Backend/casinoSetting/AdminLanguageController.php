<?php

namespace App\Http\Controllers\Backend\casinoSetting;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AdminLanguage;
use Illuminate\Http\Request;

class AdminLanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('backend.casino-setting.admin-language.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\casino-setting.admin-language.create');
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
        
        AdminLanguage::create($requestData);

        return redirect('admin-language')->with('flash_message', 'AdminLanguage added!');
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
        $adminlanguage = AdminLanguage::findOrFail($id);

        return view('backend\casino-setting.admin-language.show', compact('adminlanguage'));
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
        $adminlanguage = AdminLanguage::findOrFail($id);

        return view('backend\casino-setting.admin-language.edit', compact('adminlanguage'));
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
        
        $adminlanguage = AdminLanguage::findOrFail($id);
        $adminlanguage->update($requestData);

        return redirect('admin-language')->with('flash_message', 'AdminLanguage updated!');
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
        AdminLanguage::destroy($id);

        return redirect('admin-language')->with('flash_message', 'AdminLanguage deleted!');
    }
}
