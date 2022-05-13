<?php

namespace App\Models;

use App\Services\DownloadService;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Model extends \Illuminate\Database\Eloquent\Model

{
    use HasFactory;

    protected $guarded = [

    ];

    public function prepare($data)
    {
        return DownloadService::prepare($data);
    }
}
