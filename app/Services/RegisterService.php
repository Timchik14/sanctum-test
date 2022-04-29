<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class RegisterService
{
    public function dataPrepare(RegisterRequest $registerRequest)
    {
        $validated = $registerRequest->validated();
        $validated['password'] = Hash::make($validated['password']);
        return $validated;
    }
}
