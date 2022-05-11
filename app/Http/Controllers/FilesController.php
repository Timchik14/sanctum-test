<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Models\Group;
use App\Services\GroupsSynchronizer;
use Illuminate\Http\Request;

class FilesController extends Controller
{
    public function uploads()
    {
        $groups = Group::all();
        return view('uploads', compact('groups'));
    }

    public function upload(File $file, FileRequest $fileRequest, GroupsSynchronizer $groupsSynchronizer)
    {
        return $file->createNew($fileRequest, $groupsSynchronizer);
    }
}
