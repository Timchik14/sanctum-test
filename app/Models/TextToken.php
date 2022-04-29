<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TextToken extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
