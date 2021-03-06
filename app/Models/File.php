<?php

namespace App\Models;

use App\Http\Requests\FileRequest;
use App\Services\FileService;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    public function createNew(FileRequest $fileRequest)
    {
        return FileService::save($fileRequest);
    }

    public function scopeUnmoderated($query)
    {
        return $query->where('is_moderated', false);
    }

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
}
