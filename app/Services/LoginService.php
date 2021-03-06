<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginService
{
    public function loginCheck(LoginRequest $loginRequest)
    {
        if (Auth::attempt($loginRequest->validated())) {
            $loginRequest->session()->regenerate();
            return new JsonResponse(['token' => (auth()->user()->textToken()->first()->token)], 200);
        }

        return new JsonResponse([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
