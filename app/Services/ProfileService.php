<?php

namespace App\Services;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;

class ProfileService
{
    public function updateUserData(Profile $profile, ProfileRequest $request)
    {
        auth()->user()->update(['name' => $request->name ?? auth()->user()->name]);
        $validated = $request->validated();
        $profile->update($validated);

        return new JsonResponse(['changes' => 'success'], 200);;
    }
}
