<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;

class FilesController extends Controller
{
    public function uploads()
    {
        return view('uploads');
    }

    public function upload(File $file, FileRequest $fileRequest)
    {
        //store возвращает путь к файлу
        $file->createNew($fileRequest->file('file')->store('images'));
    }
}
