<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class AdminController extends Controller
{
    public function index(File $file)
    {
        $files = File::with(['user', 'group', 'count'])->get();
        $files = $file->prepare($files);
        return view('files.index', compact('files'));
    }
}
