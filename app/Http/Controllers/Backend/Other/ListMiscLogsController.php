<?php

namespace App\Http\Controllers\Backend\Other;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ListMiscLog;
use Illuminate\Http\Request;

class ListMiscLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.other.list-misc-logs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.other.list-misc-logs.create');
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
        
        ListMiscLog::create($requestData);

        return redirect('list-misc-logs')->with('flash_message', 'ListMiscLog added!');
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
        $listmisclog = ListMiscLog::findOrFail($id);

        return view('backend.other.list-misc-logs.show', compact('listmisclog'));
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
        $listmisclog = ListMiscLog::findOrFail($id);

        return view('backend.other.list-misc-logs.edit', compact('listmisclog'));
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
        
        $listmisclog = ListMiscLog::findOrFail($id);
        $listmisclog->update($requestData);

        return redirect('list-misc-logs')->with('flash_message', 'ListMiscLog updated!');
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
        ListMiscLog::destroy($id);

        return redirect('list-misc-logs')->with('flash_message', 'ListMiscLog deleted!');
    }
}
