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

class AuthController extends Controller
{
    public function register(User $user, RegisterRequest $registerRequest)
    {
        $newUser = $user->createNew($registerRequest);
        Auth::login($newUser, true);

        $token = $newUser
            ->createToken($registerRequest->name)
            ->plainTextToken;

        $newUser->saveTextToken(new TextToken(['token' => $token]));

        return new JsonResponse(['token' => $token], 200);
    }

    public function login(LoginService $loginService, LoginRequest $loginRequest)
    {
        return $loginService->loginCheck($loginRequest);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('login-form'));
    }
}
