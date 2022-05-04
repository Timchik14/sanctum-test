<?php

namespace App\Http\Controllers;

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

    public function upload(Request $request)
    {
        $path = $request->file('file')->store('files');
        $data = $request->all();
        $data['path'] = $path;
        File::create($data);
    }
}
