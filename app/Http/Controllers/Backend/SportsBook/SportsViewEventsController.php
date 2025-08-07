<?php

namespace App\Http\Controllers\Backend\SportsBook;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SportsViewEvent;
use Illuminate\Http\Request;

class SportsViewEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.sports-book.sports-view-events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.sports-book.sports-view-events.create');
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
        
        SportsViewEvent::create($requestData);

        return redirect('sports-view-events')->with('flash_message', 'SportsViewEvent added!');
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
        $sportsviewevent = SportsViewEvent::findOrFail($id);

        return view('backend.sports-book.sports-view-events.show', compact('sportsviewevent'));
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
        $sportsviewevent = SportsViewEvent::findOrFail($id);

        return view('backend.sports-book.sports-view-events.edit', compact('sportsviewevent'));
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
        
        $sportsviewevent = SportsViewEvent::findOrFail($id);
        $sportsviewevent->update($requestData);

        return redirect('sports-view-events')->with('flash_message', 'SportsViewEvent updated!');
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
        SportsViewEvent::destroy($id);

        return redirect('sports-view-events')->with('flash_message', 'SportsViewEvent deleted!');
    }
}
