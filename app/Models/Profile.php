<?php

namespace App\Models;

use App\Http\Requests\ProfileRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\JsonResponse;

class Profile extends Model
{
    use HasFactory;

    public function updateUserData(Profile $profile, ProfileRequest $request)
    {
        auth()->user()->update(['name' => $request->name ?? auth()->user()->name]);
        $validated = $request->validated();
        $profile->update($validated);

        return new JsonResponse(['changes' => 'success'], 200);;
    }
}
