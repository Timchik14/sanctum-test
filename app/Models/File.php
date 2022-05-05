<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

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

    public function getWithUser()
    {
        $data =  File::with('user')->get();
        return $this->prepare($data);
    }

    public function prepare(Collection $collection)
    {
        foreach ($collection as $item) {
            $path = $item->path;
            $item['format'] = substr($path, -3, 3);
            $from = strripos($path, '/') + 1;
            $item['name'] = substr($path, $from, strlen($path) - $from - 4);
        }
        return $collection;
    }

    public function createNew($files)
    {
        $data = [];
        $userId = auth()->id();

        foreach ($files as $file) {
            $data[] = [
                'path' => $file->store('images'),
                'user_id' => $userId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        File::insert($data);
    }
}
