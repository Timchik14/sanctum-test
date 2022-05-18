<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\File;

class ModeratorService
{
    public function updateFileInfo(File $file, Request $request)
    {
        $isApproved = (bool)$request->approved;
        $file->update(['is_moderated' => true, 'is_approved' => $isApproved]);

        return new JsonResponse(['update' => 'success'], 200);

    }

    public function getFiles(File $file, Request $request)
    {
        $files = auth()->user()->files()->unmoderated()->with(['user', 'group', 'count'])->get();
        $files = $file->prepare($files);
        return $files;
    }
}
