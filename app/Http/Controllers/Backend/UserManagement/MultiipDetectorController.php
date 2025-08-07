<?php

namespace App\Http\Controllers\Backend\UserManagement;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\MultiipDetector;
use Illuminate\Http\Request;

class MultiipDetectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.user-management.multiip-detector.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.user-management.multiip-detector.create');
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
        
        MultiipDetector::create($requestData);

        return redirect('multiip-detector')->with('flash_message', 'MultiipDetector added!');
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
        $multiipdetector = MultiipDetector::findOrFail($id);

        return view('backend.user-management.multiip-detector.show', compact('multiipdetector'));
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
        $multiipdetector = MultiipDetector::findOrFail($id);

        return view('backend.user-management.multiip-detector.edit', compact('multiipdetector'));
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
        
        $multiipdetector = MultiipDetector::findOrFail($id);
        $multiipdetector->update($requestData);

        return redirect('multiip-detector')->with('flash_message', 'MultiipDetector updated!');
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
        MultiipDetector::destroy($id);

        return redirect('multiip-detector')->with('flash_message', 'MultiipDetector deleted!');
    }
}
