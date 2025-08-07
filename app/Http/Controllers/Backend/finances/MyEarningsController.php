<?php

namespace App\Http\Controllers\Backend\finances;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MyEarning;
use App\User;
use Illuminate\Http\Request;

class MyEarningsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $earn=User::latest()->get();
        return view('backend.finances.my-earnings.index',compact('earn'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\finances.my-earnings.create');
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

        MyEarning::create($requestData);

        return redirect('my-earnings')->with('flash_message', 'MyEarning added!');
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
        $myearning = MyEarning::findOrFail($id);

        return view('backend\finances.my-earnings.show', compact('myearning'));
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
        $myearning = MyEarning::findOrFail($id);

        return view('backend\finances.my-earnings.edit', compact('myearning'));
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

        $myearning = MyEarning::findOrFail($id);
        $myearning->update($requestData);

        return redirect('my-earnings')->with('flash_message', 'MyEarning updated!');
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
        MyEarning::destroy($id);

        return redirect('my-earnings')->with('flash_message', 'MyEarning deleted!');
    }
}
