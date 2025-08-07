<?php

namespace App\Http\Controllers\Backend\UserManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ListMessage;
use Illuminate\Http\Request;

class ListMessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.user-management.list-messages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.user-management.list-messages.create');
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
        
        ListMessage::create($requestData);

        return redirect('list-messages')->with('flash_message', 'ListMessage added!');
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
        $listmessage = ListMessage::findOrFail($id);

        return view('backend.user-management.list-messages.show', compact('listmessage'));
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
        $listmessage = ListMessage::findOrFail($id);

        return view('backend.user-management.list-messages.edit', compact('listmessage'));
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
        
        $listmessage = ListMessage::findOrFail($id);
        $listmessage->update($requestData);

        return redirect('list-messages')->with('flash_message', 'ListMessage updated!');
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
        ListMessage::destroy($id);

        return redirect('list-messages')->with('flash_message', 'ListMessage deleted!');
    }
}
