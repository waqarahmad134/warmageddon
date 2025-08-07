<?php

namespace App\Http\Controllers\Backend\Other;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SendNewsletter;
use Illuminate\Http\Request;

class SendNewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.other.send-newsletter.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.other.send-newsletter.create');
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
        
        SendNewsletter::create($requestData);

        return redirect('send-newsletter')->with('flash_message', 'SendNewsletter added!');
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
        $sendnewsletter = SendNewsletter::findOrFail($id);

        return view('backend.other.send-newsletter.show', compact('sendnewsletter'));
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
        $sendnewsletter = SendNewsletter::findOrFail($id);

        return view('backend.other.send-newsletter.edit', compact('sendnewsletter'));
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
        
        $sendnewsletter = SendNewsletter::findOrFail($id);
        $sendnewsletter->update($requestData);

        return redirect('send-newsletter')->with('flash_message', 'SendNewsletter updated!');
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
        SendNewsletter::destroy($id);

        return redirect('send-newsletter')->with('flash_message', 'SendNewsletter deleted!');
    }
}
