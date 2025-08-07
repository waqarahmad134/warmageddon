<?php

namespace App\Http\Controllers\Backend\SportsBook;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ConfigureFeed;
use Illuminate\Http\Request;

class ConfigureFeedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.sports-book.configure-feed.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.sports-book.configure-feed.create');
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
        
        ConfigureFeed::create($requestData);

        return redirect('configure-feed')->with('flash_message', 'ConfigureFeed added!');
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
        $configurefeed = ConfigureFeed::findOrFail($id);

        return view('backend.sports-book.configure-feed.show', compact('configurefeed'));
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
        $configurefeed = ConfigureFeed::findOrFail($id);

        return view('backend.sports-book.configure-feed.edit', compact('configurefeed'));
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
        
        $configurefeed = ConfigureFeed::findOrFail($id);
        $configurefeed->update($requestData);

        return redirect('configure-feed')->with('flash_message', 'ConfigureFeed updated!');
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
        ConfigureFeed::destroy($id);

        return redirect('configure-feed')->with('flash_message', 'ConfigureFeed deleted!');
    }
}
