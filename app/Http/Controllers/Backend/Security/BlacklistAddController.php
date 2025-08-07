<?php

namespace App\Http\Controllers\Backend\Security;

use App\User;
use App\BlacklistAdd;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class BlacklistAddController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user =  User::role('User')->get();
        return view('backend.security.blacklist-add.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.security.blacklist-add.create');
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
        $user_profile = BlacklistAdd::create([
            'user_id' => \Auth::user()->id,
            'type' => $request['type'],
            'value'=> $request['value'],
            'reason' => $request['reason'],
        ]); 
        Toastr::success('BlacklistAdd added!','Success');
        return redirect()->back();
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
        $blacklistadd = BlacklistAdd::findOrFail($id);

        return view('backend.security.blacklist-add.show', compact('blacklistadd'));
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
        $blacklistadd = BlacklistAdd::findOrFail($id);

        return view('backend.security.blacklist-add.edit', compact('blacklistadd'));
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
        
        $blacklistadd = BlacklistAdd::findOrFail($id);
        $blacklistadd->update($requestData);

        return redirect('blacklist-add')->with('flash_message', 'BlacklistAdd updated!');
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
        BlacklistAdd::destroy($id);

        return redirect('blacklist-add')->with('flash_message', 'BlacklistAdd deleted!');
    }
}
