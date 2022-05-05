<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Download;

class FilesListController extends Controller
{
    public function index(File $file)
    {
        $files = $file->getWithUser();
        return view('files.index', compact('files'));
    }

    public function download(File $file, Download $download)
    {
        $download->log($file);
        return response()->download(public_path('storage/') . $file->path);
    }

    public function show(File $file)
    {
        $downloads = $file->prepare(Download::with('user')->get());
        return view('files.show', compact('downloads'));
    }
}
