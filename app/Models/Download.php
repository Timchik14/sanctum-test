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
        Download::create(['user_id' => auth()->id(), 'path' => $file->path]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
