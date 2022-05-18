<?php

namespace App\Http\Controllers;

use App\Services\ModeratorService;
use Illuminate\Http\Request;
use App\Models\File;

class ModeratorController extends Controller
{
    public function index(File $file, ModeratorService $service, Request $request)
    {
        $files = $service->getFiles($file, $request);
        return view('moderation.index', compact('files'));
    }

    public function moderate(File $file, Request $request, ModeratorService $service)
    {
        return $service->updateFileInfo($file, $request);
    }
}
