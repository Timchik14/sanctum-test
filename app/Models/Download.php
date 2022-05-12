<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Download extends Model
{
    public function getDownloads()
    {
        return Download::select('file_id', DB::raw('count(*) as total'))
            ->groupBy('file_id')
            ->get();
    }

    public function log(File $file)
    {
        Download::create([
            'user_id' => auth()->id(),
            'path' => $file->path,
            'group_id' => $file->group_id,
            'file_id' => $file->id,
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
