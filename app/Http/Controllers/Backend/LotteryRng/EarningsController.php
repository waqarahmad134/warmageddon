<?php

namespace App\Http\Controllers\Backend\LotteryRng;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Earning;
use Illuminate\Http\Request;

class EarningsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {

        return view('backend.Lottery-rng.earnings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\Lottery-rng.earnings.create');
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

        Earning::create($requestData);

        return redirect('earnings')->with('flash_message', 'Earning added!');
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
        $earning = Earning::findOrFail($id);

        return view('backend\Lottery-rng.earnings.show', compact('earning'));
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
        $earning = Earning::findOrFail($id);

        return view('backend\Lottery-rng.earnings.edit', compact('earning'));
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

        $earning = Earning::findOrFail($id);
        $earning->update($requestData);

        return redirect('earnings')->with('flash_message', 'Earning updated!');
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
        Earning::destroy($id);

        return redirect('earnings')->with('flash_message', 'Earning deleted!');
    }
}
