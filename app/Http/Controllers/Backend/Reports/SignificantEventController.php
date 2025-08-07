<?php

namespace App\Http\Controllers\Backend\Reports;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SignificantEvent;
use Illuminate\Http\Request;

class SignificantEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.reports.significant-event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.reports.significant-event.create');
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
        
        SignificantEvent::create($requestData);

        return redirect('significant-event')->with('flash_message', 'SignificantEvent added!');
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
        $significantevent = SignificantEvent::findOrFail($id);

        return view('backend.reports.significant-event.show', compact('significantevent'));
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
        $significantevent = SignificantEvent::findOrFail($id);

        return view('backend.reports.significant-event.edit', compact('significantevent'));
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
        
        $significantevent = SignificantEvent::findOrFail($id);
        $significantevent->update($requestData);

        return redirect('significant-event')->with('flash_message', 'SignificantEvent updated!');
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
        SignificantEvent::destroy($id);

        return redirect('significant-event')->with('flash_message', 'SignificantEvent deleted!');
    }
}
