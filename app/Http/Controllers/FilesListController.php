<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Download;
use App\Models\User;

class FilesListController extends Controller
{
    public function index(File $file)
    {
        $files = $file->getWithRelations();
        return view('files.index', compact('files'));
    }

    public function download(File $file, Download $download)
    {
        $download->log($file);
        return response()->download(public_path('/storage/app/') . $file->path);
    }

    public function show(Download $download)
    {
        $downloads = $download->getWithRelations();
        return view('files.show', compact('downloads'));
    }
}
