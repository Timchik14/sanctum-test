<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Models\Group;

class FilesController extends Controller
{
    public function uploads(Group $group)
    {
        $groups = $group->getAll();
        return view('uploads', compact('groups'));
    }

    public function upload(File $file, FileRequest $fileRequest)
    {
        return $file->createNew($fileRequest);
    }
}
