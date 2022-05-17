<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Models\Profile;
use App\Models\User;

class UserService
{
    public function createNew(RegisterRequest $registerRequest)
    {
        $registerService = new RegisterService();
        $user = User::create($registerService->dataPrepare($registerRequest));
        $profile = new Profile();
        $user->profile()->save($profile);
        return $user;
    }
}
