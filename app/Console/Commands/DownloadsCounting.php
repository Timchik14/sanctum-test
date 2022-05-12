<?php

namespace App\Console\Commands;

use App\Models\Download;
use App\Services\DownloadService;
use Illuminate\Console\Command;

class DownloadsCounting extends Command
{
    protected $signature = 'app:count';

    protected $description = 'Count and logs downloads count';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(Download $download, DownloadService $downloadService)
    {
        // получаем загрузки сгруппированные по файлу с количеством
        $downloads = $download->getDownloads();
        // сохраняем в бд количество загрузок
        $downloadService->save($downloads);
    }
}
