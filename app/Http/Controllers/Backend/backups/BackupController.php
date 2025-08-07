<?php

namespace App\Http\Controllers\Backend\backups;

use App\BackupDatabase;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Spatie\DbDumper\Databases\MySql;

class BackupController extends Controller
{
    public function index()
    {
        $backups                  = BackupDatabase::all();

        return view('backend.backups.index',compact('backups'));
    }
    public function backup()
    {

        $last_backup              = BackupDatabase::orderBy('id','desc')->first();
        if ($last_backup!=null)
        {
            $last_id          = $last_backup->id;
        }
        else
        {
            $last_id          = 1;
        }
        MySql::create()
            ->setDbName(\config('database.connections.mysql.database'))
            ->setUserName(\config('database.connections.mysql.username'))
            ->setPassword(\config('database.connections.mysql.password'))
            ->dumpToFile('public/backup'.$last_id.'.sql');
        $backup                  = new BackupDatabase();
        $backup->name            = date('Y-m-d')."_Backup_".$last_id;
        $backup->src             = 'public/backup'.$last_id.'.sql';
        $backup->save();
        return redirect('dash-panel/backup-list');
    }
    public function restore($id)
    {
        $backup                  = BackupDatabase::where('id',$id)->first();
        DB::unprepared(file_get_contents($backup->src));
        Toastr::success('Backup restored successfully');
        return redirect()->back();
    }
}
