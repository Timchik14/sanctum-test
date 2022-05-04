<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'path',
    ];

    public function createNew($path)
    {
        $data['path'] = $path;
        File::create($data);
    }
}
