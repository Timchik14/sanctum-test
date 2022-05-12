<?php

namespace App\Services;

use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class FileService
{
    public static function save($fileRequest)
    {
        $data = [];
        $files = $fileRequest->file('files');
        $userId = auth()->id();

        $groupsSynchronizer = new GroupsSynchronizer();

        $groupName = $groupsSynchronizer->getName($fileRequest);
        if (! $groupName) {
            return redirect()->back()->withErrors('Не выбрана группа');
        }
        $groupId = $groupsSynchronizer->getId($groupName);

        if ($files) {
            foreach ($files as $file) {
                $data[] = [
                    'path' => $file->store($groupName),
                    'user_id' => $userId,
                    'group_id' => $groupId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
            File::insert($data);
            return new JsonResponse(['upload' => 'success'], 200);
        }
        return new JsonResponse(['upload' => 'error'], 200);
    }

    public function delete($file)
    {
        Storage::delete($file->path);
    }
}
