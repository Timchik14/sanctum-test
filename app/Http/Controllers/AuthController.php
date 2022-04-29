<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\TextToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request, RegisterRequest $registerRequest)
    {
        $validated = $registerRequest->validated();

        $user = User::create($validated);
        Auth::login($user);

        $token = $user
            ->createToken($request->name, ['place-orders'])
            ->plainTextToken;

        $textToken = new TextToken(['token' => $token,]);
        $user->textToken()->save($textToken);


        return new JsonResponse(['token' => $token], 200);
    }

    public function login(Request $request, LoginRequest $loginRequest)
    {
        $loginRequest->validated();

        $user = User::where('email', $request->email)->first();
        Auth::login($user);

        if (! $user || ! ($request->password == $user->password)) {
            return 'Неверное имя пользователя или пароль';
        }
        return new JsonResponse(['token' => ($user->textToken()->first()->token)], 200);
    }
}
