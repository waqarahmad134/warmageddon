<?php

namespace App\Http\Controllers\Backend\Security;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\BanIP;
use Illuminate\Http\Request;

class BanIPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $ip_list =\App\BanIP::latest()->get();
        return view('backend.security.ban-i-p.index',compact('ip_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.security.ban-i-p.create');
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
        $request->validate([
            'client_ip' => 'required|unique:ban_i_ps',
            'duration_minutes' => 'required|max:255',
            'ban_start_date' => 'required|min:6',
            'type' => 'required|string',
        ]);
        $user_profile = BanIP::create([
            'user_id' => \Auth::user()->id,
            'client_ip' => $request['client_ip'],
            'duration_minutes'=> $request['duration_minutes'],
            'ban_start_date' => $request['ban_start_date'],
            'type' => $request['type'],
        ]);
        Toastr::success('IP banned successfully!','Success');
        return redirect()->back();

        return redirect('ban-ip')->with('flash_message', 'BanIP added!');
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
        $banip = BanIP::findOrFail($id);

        return view('backend.security.ban-i-p.show', compact('banip'));
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
        $banip = BanIP::findOrFail($id);

        return view('backend.security.ban-i-p.edit', compact('banip'));
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

        $banip = BanIP::findOrFail($id);
        $banip->update($requestData);

        return redirect('ban-ip')->with('flash_message', 'BanIP updated!');
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
        BanIP::destroy($id);

        return redirect('ban-ip')->with('flash_message', 'BanIP deleted!');
    }
}
