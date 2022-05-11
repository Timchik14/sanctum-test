<?php

namespace App\Models;

use App\Http\Requests\FileRequest;
use App\Services\GroupsSynchronizer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Redirect;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'path',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function count()
    {
        return $this->hasOne(DownloadCount::class);
    }

    public function getWithRelations()
    {
        $data =  File::with(['user', 'group', 'count'])->get();
        return $this->prepare($data);
    }

    public function prepare(Collection $collection)
    {
        foreach ($collection as $item) {
            $path = $item->path;
            $item['format'] = substr($path, -3, 3);
            $from = strripos($path, '/') + 1;
            $item['name'] = substr($path, $from, strlen($path) - $from - 4);
            $item['group_name'] = $item->group->name;
            $item['count'] = $item->count->count;
        }
        return $collection;
    }

    public function createNew(FileRequest $fileRequest, GroupsSynchronizer $groupsSynchronizer)
    {
        $data = [];
        $files = $fileRequest->file('files');
        $userId = auth()->id();

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
}
