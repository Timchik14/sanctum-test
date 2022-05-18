<?php

namespace App\Http\Controllers;

use App\Models\File;

class ModeratorController extends Controller
{
    public function index(File $file)
    {
        $files = auth()->user()->files()->with(['user', 'group', 'count'])->get();
        $files = $file->prepare($files);
        return view('moderation.index', compact('files'));
    }
}
