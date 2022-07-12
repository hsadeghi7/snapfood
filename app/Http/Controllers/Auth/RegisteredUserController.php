<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Spatie\Permission\Models\Permission;
use App\Notifications\RegisterNotification;
use Illuminate\Support\Facades\Notification;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!Role::where('name', 'seller')->first()) {
            Role::create(
                [
                    'name' => 'seller',
                    'guard_name' => 'web',
                ]
            );
        }
        
        if (!Permission::where('name', 'sellerPermission')->first()) {
            Permission::create(['name' => 'sellerPermission']);
        }

        $user->assignRole('seller');

        event(new Registered($user));

        Notification::send($user, new RegisterNotification($user));
        Auth::login($user);


        return redirect(RouteServiceProvider::HOME);
    }
}
