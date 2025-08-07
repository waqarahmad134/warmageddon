<?php

namespace App\Http\Controllers\Backend\casinoSetting;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ResponsibleGaming;
use Illuminate\Http\Request;

class ResponsibleGamingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('backend.casino-setting.responsible-gaming.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\casino-setting.responsible-gaming.create');
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

        ResponsibleGaming::create($requestData);

        return redirect('responsible-gaming')->with('flash_message', 'ResponsibleGaming added!');
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
        $responsiblegaming = ResponsibleGaming::findOrFail($id);

        return view('backend\casino-setting.responsible-gaming.show', compact('responsiblegaming'));
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
        $responsiblegaming = ResponsibleGaming::findOrFail($id);

        return view('backend\casino-setting.responsible-gaming.edit', compact('responsiblegaming'));
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

        $responsiblegaming = ResponsibleGaming::findOrFail($id);
        $responsiblegaming->update($requestData);

        return redirect('responsible-gaming')->with('flash_message', 'ResponsibleGaming updated!');
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
        ResponsibleGaming::destroy($id);

        return redirect('responsible-gaming')->with('flash_message', 'ResponsibleGaming deleted!');
    }
}
