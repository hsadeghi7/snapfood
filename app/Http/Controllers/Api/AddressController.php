<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResource;
use App\Http\Requests\ApiSetDefaultAddressRequest;

class AddressController extends Controller
{
    public function addresses()
    {
        $user_addresses = auth()->user()->addresses;

        return response()->json(['addresses' => AddressResource::collection($user_addresses)]);
    }
    public function addAddress(ApiSetDefaultAddressRequest $request)
    {
        $user = auth()->user();
        $user->addresses()->create([
            'title' => $request->title,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);
        return response()->json(['message' => 'Address added successfully']);
    }

    public function setDefaultAddress(Address $address)
    {
        $user = auth()->user();
        $addresses = $user->addresses;

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
