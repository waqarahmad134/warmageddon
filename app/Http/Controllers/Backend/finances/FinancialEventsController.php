<?php

namespace App\Http\Controllers\Backend\finances;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\FinancialEvent;
use App\User;
use Illuminate\Http\Request;

class FinancialEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $f_event=User::latest()->get();
        return view('backend.finances.financial-events.index',compact('f_event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\finances.financial-events.create');
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

        FinancialEvent::create($requestData);

        return redirect('financial-events')->with('flash_message', 'FinancialEvent added!');
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
        $financialevent = FinancialEvent::findOrFail($id);

        return view('backend\finances.financial-events.show', compact('financialevent'));
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
        $financialevent = FinancialEvent::findOrFail($id);

        return view('backend\finances.financial-events.edit', compact('financialevent'));
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

        $financialevent = FinancialEvent::findOrFail($id);
        $financialevent->update($requestData);

        return redirect('financial-events')->with('flash_message', 'FinancialEvent updated!');
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
        FinancialEvent::destroy($id);

        return redirect('financial-events')->with('flash_message', 'FinancialEvent deleted!');
    }
}
