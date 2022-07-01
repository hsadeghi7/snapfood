<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Http\Requests\ApiSetDefaultAddressRequest;
use App\Http\Requests\ApiUpdateDefaultAddressRequest;

class AddressController extends Controller
{
    public function addresses()
    {
        $user = auth()->user();
        $profile = $user->profile;
        return response()->json(['addresses' => AddressResource::collection($profile->addresses)]);
    }
    public function addAddress(ApiSetDefaultAddressRequest $request)
    {
        $profile = Profile::where('user_id', auth()->id())->get()->first();
        $profile->addresses()->create([
            'title' => $request->title,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        return response()->json(['message' => 'Address added successfully']);
    }

    public function updateAddress(ApiUpdateDefaultAddressRequest $request)
    {
        $profile = Profile::find(auth()->id());
        $address = $profile->addresses()->find($request->address_id);
        $address->update([
            'title' => $request->title,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        return response()->json(['message' => 'Address updated successfully']);
    }


    public function setDefaultAddress(Address $address)
    {
        $user = auth()->user();
        $profile = $user->profile;
        $addresses = $profile->addresses;

        $addresses->each(function ($address) {
            $address->is_default = false;
            $address->save();
        });

        $address->is_default = true;
        $address->save();

        return response()->json(['message' => 'Address set as default successfully']);
    }

    public function deleteAddress(Address $address)
    {
        $address->delete();
        return response()->json(['message' => 'Address deleted successfully']);
    }
}