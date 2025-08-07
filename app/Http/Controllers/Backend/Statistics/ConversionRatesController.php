<?php

namespace App\Http\Controllers\Backend\Statistics;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ConversionRate;
use Illuminate\Http\Request;

class ConversionRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.statistics.conversion-rates.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend.statistics.conversion-rates.create');
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
        
        ConversionRate::create($requestData);

        return redirect('conversion-rates')->with('flash_message', 'ConversionRate added!');
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
        $conversionrate = ConversionRate::findOrFail($id);

        return view('backend.statistics.conversion-rates.show', compact('conversionrate'));
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
        $conversionrate = ConversionRate::findOrFail($id);

        return view('backend.statistics.conversion-rates.edit', compact('conversionrate'));
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
        
        $conversionrate = ConversionRate::findOrFail($id);
        $conversionrate->update($requestData);

        return redirect('conversion-rates')->with('flash_message', 'ConversionRate updated!');
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
        ConversionRate::destroy($id);

        return redirect('conversion-rates')->with('flash_message', 'ConversionRate deleted!');
    }
}
