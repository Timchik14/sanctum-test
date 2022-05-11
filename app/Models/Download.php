<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    use HasFactory;

    protected $guarded = [

    ];

    public function log(File $file)
    {
        Download::create([
            'user_id' => auth()->id(),
            'path' => $file->path,
            'group_id' => $file->group_id,
            'file_id' => $file->id,
        ]);
    }

    public function prepare(Collection $collection)
    {
        foreach ($collection as $item) {
            $path = $item->path;
            $item['format'] = substr($path, -3, 3);
            $from = strripos($path, '/') + 1;
            $item['name'] = substr($path, $from, strlen($path) - $from - 4);
            $item['group_name'] = $item->group->name;
        }
        return $collection;
    }

    public function getWithRelations()
    {
        $data = Download::with(['user', 'group'])->get();
        return $this->prepare($data);
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
