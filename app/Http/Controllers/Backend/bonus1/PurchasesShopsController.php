<?php

namespace App\Http\Controllers\Backend\bonus1;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\PurchasesShop;
use Illuminate\Http\Request;

class PurchasesShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.bonus.purchases-shops.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\bonus.purchases-shops.create');
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

        PurchasesShop::create($requestData);

        return redirect('purchases-shops')->with('flash_message', 'PurchasesShop added!');
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
        $purchasesshop = PurchasesShop::findOrFail($id);

        return view('backend\bonus.purchases-shops.show', compact('purchasesshop'));
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
        $purchasesshop = PurchasesShop::findOrFail($id);

        return view('backend\bonus.purchases-shops.edit', compact('purchasesshop'));
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

        $purchasesshop = PurchasesShop::findOrFail($id);
        $purchasesshop->update($requestData);

        return redirect('purchases-shops')->with('flash_message', 'PurchasesShop updated!');
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
        PurchasesShop::destroy($id);

        return redirect('purchases-shops')->with('flash_message', 'PurchasesShop deleted!');
    }
}
