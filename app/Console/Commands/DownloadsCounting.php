<?php

namespace App\Console\Commands;

use App\Models\DownloadCount;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
        $downloads = DB::table('downloads')
            ->select('file_id', DB::raw('count(*) as total'))
            ->groupBy('file_id')
            ->get();

        foreach ($downloads as $download) {
            $count = DownloadCount::firstOrNew([
                'file_id' => $download->file_id,
            ]);
            $count->count = $download->total;
            $count->save();
        }
    }
}
