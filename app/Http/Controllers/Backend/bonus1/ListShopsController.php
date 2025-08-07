<?php

namespace App\Http\Controllers\Backend\bonus1;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ListShop;
use App\AddShop;
use Illuminate\Http\Request;

class ListShopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
         $Addshop=AddShop::latest()->get();
         return view('backend.bonus.list-shops.index',compact('Addshop'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\bonus.list-shops.create');
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

        ListShop::create($requestData);

        return redirect('list-shops')->with('flash_message', 'ListShop added!');
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
        $listshop = ListShop::findOrFail($id);

        return view('backend\bonus.list-shops.show', compact('listshop'));
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
        $listshop = ListShop::findOrFail($id);

        return view('backend\bonus.list-shops.edit', compact('listshop'));
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

        $listshop = ListShop::findOrFail($id);
        $listshop->update($requestData);

        return redirect('list-shops')->with('flash_message', 'ListShop updated!');
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
        ListShop::destroy($id);

        return redirect('list-shops')->with('flash_message', 'ListShop deleted!');
    }
}
