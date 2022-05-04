<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Services\MainService;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class MainController extends Controller
{

    public function uploads()
    {
        return view('uploads');
    }

    public function register()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        return view('logout');
    }

    public function protected(MainService $mainService)
    {
        return $mainService->can('server:update', auth()->user());
    }

    public function second(MainService $mainService)
    {
        return $mainService->can('place-orders', auth()->user());
    }

    public function upload(File $file, FileRequest $fileRequest)
    {
        //store возвращает путь к файлу
        $file->createNew($fileRequest->file('file')->store('files'));
    }
}
