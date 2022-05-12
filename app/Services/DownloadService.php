<?php

namespace App\Services;

use App\Models\DownloadCount;
use Illuminate\Database\Eloquent\Collection;

class DownloadService
{
    public function save($downloads)
    {
        $data = [];
        foreach ($downloads as $count) {
            $data[] = [
                'file_id' => $count->file_id,
                'count' => $count->total,
            ];
        }

        DownloadCount::upsert($data, ['file_id'], ['count']);
    }

    public static function prepare(Collection $collection)
    {
        foreach ($collection as $item) {
            $path = $item->path;
            $item['format'] = substr($path, -3, 3);
            $from = strripos($path, '/') + 1;
            $item['name'] = substr($path, $from, strlen($path) - $from - 4);
            $item['group_name'] = $item->group->name ?? null;
            $item['count'] = $item->count->count ?? null;
        }
        return $collection;
    }
}
