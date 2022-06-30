<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApiProfileCreateRequest;
use App\Http\Requests\ApiProfileUpdateRequest;

class ProfileController extends Controller
{


    public function createProfile(ApiProfileCreateRequest $request)
    {
        $profile = Profile::create([
            'user_id' => auth()->id(),
            'phone' => $request->phone,
            'account_number' => $request->account_number,
        ]);

        return response()->json(['message' => 'Profile create successfully']);
    }

    public function updateProfile(ApiProfileUpdateRequest $request, Profile $profile)
    {

        $profile->update([
            'phone' => $request->phone,
            'account_number' => $request->account_number,
        ]);

        return response()->json(['message' => 'Profile update successfully']);
    }


}
