<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\TextToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\LoginService;
use App\Services\RegisterService;

class AuthController extends Controller
{
    public function register(RegisterService $registerService, Request $request, RegisterRequest $registerRequest)
    {
        $user = User::create($registerService->dataPrepare($registerRequest));
        $user->addToAuth();

        $token = $user
            ->createToken($request->name, ['server:update'])
            ->plainTextToken;

        $user->saveTextToken(new TextToken(['token' => $token]));

        return new JsonResponse(['token' => $token], 200);
    }

    public function login(LoginService $loginService, Request $request, LoginRequest $loginRequest)
    {
        return $loginService->loginCheck($request, $loginRequest);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login-form'));
    }
}
