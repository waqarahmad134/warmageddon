<?php

namespace App\Http\Controllers\Backend\Maintenance;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\BackupDatabase;
use Illuminate\Http\Request;

class BackupDatabasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('backend.maintenance.backup-databases.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('backend\maintenance.backup-databases.create');
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

        BackupDatabase::create($requestData);

        return redirect('backup-databases')->with('flash_message', 'BackupDatabase added!');
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
        $backupdatabase = BackupDatabase::findOrFail($id);

        return view('backend\maintenance.backup-databases.show', compact('backupdatabase'));
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
        $backupdatabase = BackupDatabase::findOrFail($id);

        return view('backend\maintenance.backup-databases.edit', compact('backupdatabase'));
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

        $backupdatabase = BackupDatabase::findOrFail($id);
        $backupdatabase->update($requestData);

        return redirect('backup-databases')->with('flash_message', 'BackupDatabase updated!');
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
        BackupDatabase::destroy($id);

        return redirect('backup-databases')->with('flash_message', 'BackupDatabase deleted!');
    }
}
