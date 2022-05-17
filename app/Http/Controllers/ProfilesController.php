<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Services\ProfileService;

class ProfilesController extends Controller
{

    public function show()
    {
        $user = auth()->user()->getUserData();
        return view('profiles.index', compact('user'));
    }

    public function edit(Profile $profile)
    {
        // защита от других пользователей
        $this->authorize('update', $profile);

        return view('profiles.edit', compact('profile'));
    }

    public function update(Profile $profile, ProfileRequest $request, ProfileService $service)
    {
        return $service->updateUserData($profile, $request);
    }
}
