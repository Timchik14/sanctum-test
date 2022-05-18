<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Download;
use App\Services\FileService;

class FilesListController extends Controller
{
    public function index(File $file)
    {
        $files = auth()->user()->files()->with(['user', 'group', 'count'])->get();
        $files = $file->prepare($files);
        return view('files.index', compact('files'));
    }

    public function download(File $file, Download $download)
    {
        $download->log($file);
        return response()->download(public_path('/storage/app/') . $file->path);
    }

    public function show(Download $download)
    {
        $downloads = $download->with(['user', 'group'])->get();
        $downloads = $download->prepare($downloads);
        return view('files.show', compact('downloads'));
    }

    public function destroy(File $file, FileService $service)
    {
        // удаляем файл
        return $service->delete($file);
    }
}
