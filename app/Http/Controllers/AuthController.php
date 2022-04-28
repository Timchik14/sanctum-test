<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request, RegisterRequest $registerRequest)
    {
        $validated = $registerRequest->validated();

        $user = User::create($validated);

        $token = $user->createToken($request->name)->plainTextToken;

        return new JsonResponse(['token' => $token], 200);
    }

    public function login(Request $request, LoginRequest $loginRequest)
    {
        $loginRequest->validated();

        $user = User::where('email', $request->email)->first();

        if (!$user || !($request->password == $user->password)) {
            return 'Неверное имя пользователя или пароль';
        }

        return new JsonResponse(['token' => $user->createToken($user->name)->plainTextToken], 200);
    }
}
