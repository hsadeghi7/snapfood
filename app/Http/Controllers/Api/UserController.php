<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\ApiUserLoginRequest;
use App\Http\Requests\ApiUserRegisterRequest;

class UserController extends Controller
{
    public function register(ApiUserRegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!Role::where('name', 'buyer')->first()) {
            Role::create(
                [
                    'name' => 'buyer',
                    'guard_name' => 'web',
                ]
            );
        }

        if (!Permission::where('name', 'buyerPermission')->first()) {
            Permission::create(['name' => 'buyerPermission']);
        }

        $user->assignRole('buyer');

        $token = $user->createToken('user_token')->plainTextToken;

        return response()->json([
            'message' => 'User created successfully',
            'data' => $user,
            'user_token' => $token
        ], 201);
    }

    public function login(ApiUserLoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Invalid input'
            ], 401);
        }

        $token = $user->createToken('user_token')->plainTextToken;

        return response()->json([
            'user_token' => $token
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens('user_token')->delete();

        return response()->json([
            'message' => 'LogOut successfully',
        ]);
    }
}
