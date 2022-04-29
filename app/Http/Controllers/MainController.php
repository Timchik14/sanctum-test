<?php

namespace App\Http\Controllers;

use App\Services\MainService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class MainController extends Controller
{
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
}
