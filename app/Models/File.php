<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'path',
        'user_id',
    ];

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
