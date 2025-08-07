<?php

namespace App\Http\Controllers\Backend\casinoSetting;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SystemLimit;
use Illuminate\Http\Request;

class SystemLimitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {


        return view('backend.casino-setting.system-limits.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\casino-setting.system-limits.create');
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

        SystemLimit::create($requestData);

        return redirect('system-limits')->with('flash_message', 'SystemLimit added!');
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
        $systemlimit = SystemLimit::findOrFail($id);

        return view('backend\casino-setting.system-limits.show', compact('systemlimit'));
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
        $systemlimit = SystemLimit::findOrFail($id);

        return view('backend\casino-setting.system-limits.edit', compact('systemlimit'));
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

        $systemlimit = SystemLimit::findOrFail($id);
        $systemlimit->update($requestData);

        return redirect('system-limits')->with('flash_message', 'SystemLimit updated!');
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
        SystemLimit::destroy($id);

        return redirect('system-limits')->with('flash_message', 'SystemLimit deleted!');
    }
}
