<?php

namespace App\Models;

class TextToken extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
