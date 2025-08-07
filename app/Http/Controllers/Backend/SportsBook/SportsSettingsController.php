<?php

namespace App\Http\Controllers\Backend\SportsBook;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SportsSetting;
use Illuminate\Http\Request;

class SportsSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.sports-book.sports-settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.sports-book.sports-settings.create');
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
        
        SportsSetting::create($requestData);

        return redirect('sports-settings')->with('flash_message', 'SportsSetting added!');
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
        $sportssetting = SportsSetting::findOrFail($id);

        return view('backend.sports-book.sports-settings.show', compact('sportssetting'));
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
        $sportssetting = SportsSetting::findOrFail($id);

        return view('backend.sports-book.sports-settings.edit', compact('sportssetting'));
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
        
        $sportssetting = SportsSetting::findOrFail($id);
        $sportssetting->update($requestData);

        return redirect('sports-settings')->with('flash_message', 'SportsSetting updated!');
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
        SportsSetting::destroy($id);

        return redirect('sports-settings')->with('flash_message', 'SportsSetting deleted!');
    }
}
