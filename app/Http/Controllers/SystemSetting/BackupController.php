<?php

namespace App\Http\Controllers\SystemSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Jobs\ProcessBackup;
use App\Jobs\ProcessBackupClean;

class BackupController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:system/backups,view', ['only' => 'getIndex']);
        $this->middleware('permission:system/backups,create', ['only' => ['postCreate', 'getDownload']]);
        $this->middleware('permission:system/backups,delete', ['only' => ['postDelete', 'postRemoveFile']]);
    }

    public function getIndex()
    {
        $files = [];
        foreach (glob(storage_path()."/app/" .config('app.name'). "/*.zip") as $filename) {
            $file = [];
            $lastPosIndex = strrpos(basename($filename), '-');
            $file['backup_date'] = substr(basename($filename), 0 , 10);
            $file['file_name'] =  basename($filename);
            $file['size'] =  filesize($filename);
            $files[] = $file;
        }
                
        return view('system-settings.backup.index', compact('files'));
    }

    public function postCreate()
    {
        ProcessBackup::dispatch();
        return redirect('system/backups')->with('msg_success', 'Backup files was successfully created');
    }

    public function postDelete()
    {
        ProcessBackupClean::dispatch();
        return redirect('system/backups')->with('msg_success', 'All data before a week was successfully cleared');
    }

    public function postRemoveFile()
    {
        $file = storage_path().'/app/' . config('app.name') . '/'.$fileName;
        if (unlink($file))
        {
            return redirect('system/backups')->with('msg_success', 'File has been successfully deleted');
        }
        return redirect('system/backups')->with('msg_error', 'Error deleting the file');
    }

    public function getDownload()
    {
        $headers = ['Content-Type', 'octet-stream'];    
        return response()->file(storage_path()."/app/" . config('app.name') . "/".$file, $headers);
    }
}
