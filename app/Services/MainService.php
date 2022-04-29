<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;
use App\Models\User;

class MainService
{
    public function can($ability, User $user)
    {
        if ($user->tokenCan($ability)) {
            return new JsonResponse(['success' => true], 200);
        }

        return new JsonResponse(['success' => false], 200);
    }
}
