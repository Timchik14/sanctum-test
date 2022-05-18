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
                    'is_moderated' => false,
                    'is_approved' => false,
                ];
            }
            File::insert($data);
            return new JsonResponse(['upload' => 'success'], 200);
        }
        return new JsonResponse(['upload' => 'error'], 200);
    }

    public function delete($file)
    {
        // проверяем на админа
        if (auth()->user()->isAdmin()) {
            // удаляем из бд
            $file->forceDelete();
            // проверяем удален ли из бд
            if (! File::find($file->id)) {
                // удаляем файл
                Storage::delete($file->path);
                return new JsonResponse(['delete' => 'success'], 200);
            }
        } else {
            // soft delete
            $file->delete();
            return new JsonResponse(['delete' => 'success'], 200);
        }
        return new JsonResponse(['delete' => 'error'], 200);
    }
}
