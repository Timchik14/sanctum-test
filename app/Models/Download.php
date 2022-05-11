<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    public function log(File $file)
    {
        $commonCount = Download::count() + 1;
        Download::create([
            'user_id' => auth()->id(),
            'path' => $file->path,
            'group_id' => $file->group_id,
            'common_count' => $commonCount,
        ]);
    }

    public function getWithUser()
    {
        $data = Download::with(['user', 'group'])->get();
        $file = new File();
        return $file->prepare($data);
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
