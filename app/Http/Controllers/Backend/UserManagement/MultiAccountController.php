<?php

namespace App\Http\Controllers\Backend\UserManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MultiAccount;
use Illuminate\Http\Request;

class MultiAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user=\App\User::latest()->get();
        $ip = \DB::table('users')->select('ip_address')
              ->selectRaw('count(`ip_address`) as `occurences`')
              ->groupBy('ip_address')
              ->having('occurences', '>', 1)
              ->get();
        return view('backend.user-management.multi-account.index',compact('user','ip'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.user-management.multi-account.create');
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
        
        MultiAccount::create($requestData);

        return redirect('multi-account')->with('flash_message', 'MultiAccount added!');
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
        $multiaccount = MultiAccount::findOrFail($id);

        return view('backend.user-management.multi-account.show', compact('multiaccount'));
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
        $multiaccount = MultiAccount::findOrFail($id);

        return view('backend.user-management.multi-account.edit', compact('multiaccount'));
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
        
        $multiaccount = MultiAccount::findOrFail($id);
        $multiaccount->update($requestData);

        return redirect('multi-account')->with('flash_message', 'MultiAccount updated!');
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
        MultiAccount::destroy($id);

        return redirect('multi-account')->with('flash_message', 'MultiAccount deleted!');
    }
}
