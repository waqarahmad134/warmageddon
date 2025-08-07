<?php

namespace App\Http\Controllers\Backend\Statistics;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\DisabledUser;
use Illuminate\Http\Request;

class DisabledUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.statistics.disabled-users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.statistics.disabled-users.create');
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
        
        DisabledUser::create($requestData);

        return redirect('disabled-users')->with('flash_message', 'DisabledUser added!');
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
        $disableduser = DisabledUser::findOrFail($id);

        return view('backend.statistics.disabled-users.show', compact('disableduser'));
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
        $disableduser = DisabledUser::findOrFail($id);

        return view('backend.statistics.disabled-users.edit', compact('disableduser'));
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
        
        $disableduser = DisabledUser::findOrFail($id);
        $disableduser->update($requestData);

        return redirect('disabled-users')->with('flash_message', 'DisabledUser updated!');
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
        DisabledUser::destroy($id);

        return redirect('disabled-users')->with('flash_message', 'DisabledUser deleted!');
    }
}
