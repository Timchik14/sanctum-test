<?php

namespace App\Console\Commands;

use App\Models\Download;
use Illuminate\Console\Command;

class DownloadsCounting extends Command
{
    protected $signature = 'app:count';

    protected $description = 'Count and logs downloads count';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $count = Download::count();
        Download::latest()->first()->update(['common_count' => $count]);
    }
}
